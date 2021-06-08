<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Model\CustomData;
use App\Model\MailServiceData;
use App\Model\CompanyInfoData;
use App\Model\EmailTemplate;
use App\Model\GoogleSMTP;
use App\Model\ExtraField;
use App\Model\MailExtraField;
use Auth;
use Illuminate\Support\Facades\DB;
use Config;
use Dacastro4\LaravelGmail\Services\Message\Mail;
use App\Common\AccessTokenManager;
use Illuminate\Support\Facades\Input;

class MailServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('subscribed');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     * (Home page for filling quotes)
     * @return Response
     */
    public function index()
    {
        $extra_fields = ExtraField::where('user_id', Auth::id())->orderBy('sorted', 'ASC')->get();
        return view('mail-service', ['extra_fields' => $extra_fields]);
    }

    /**
     * This function is used to fetch input values from various input fields and save data in to table mailservicedata
     * @param $input
     * @return MailServiceData
     */
    function persist_mail_service_data($input)
    {
        //Save all the filled inputs to mailservicedata table
        $mailServiceData = new MailServiceData();
        $mailServiceData->user_id = Auth::id();
        $mailServiceData->subject = $input['subject'];
        $mailServiceData->employeeName = $input['employeeName'];
        $mailServiceData->customerName = $input['customerName'];
        $mailServiceData->customerEmail = $input['customerEmail'];
        $mailServiceData->estimatedWeight = $input['estimatedWeight'];
        $mailServiceData->costPerPound = $input['costPerPound'];
        $mailServiceData->movingdate1 = $input['movingdate1'];
        $mailServiceData->movingdate2 = $input['movingdate2'];
        $mailServiceData->leadInfo = $input['leadInfo'];
        $mailServiceData->save();
        return $mailServiceData;
    }

    /**
     * This method gets called when user fills all the quote related answers in home page and click 'send' button.
     * @param Request $request
     * @return $this
     */
    function send_ticket_mail(Request $request)
    {
        $input = $request->all();

        //Validation rules array
        $rules = array(
            'subject' => 'required',
            'employeeName' => 'required',
            'customerName' => 'required',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required',
            'estimatedWeight' => 'required|integer|min:1',
            'costPerPound' => 'required|between:0,99.99',
            'movingdate1' => 'required',
        );

        $validator = \Validator::make($input, $rules, array());
        //Check if all validation passes or not
        if ($validator->passes()) {
            DB::beginTransaction();
            try {

                //Save all the filled inputs to mailservicedata table
                $mailServiceData = $this->persist_mail_service_data($input);

                $extraCharges = [];
                $totalExtraCharge = 0;

                //Check for any extra field added for customer via Extra Field Configuration option
                if (isset($input['extra']) && isset($input['extra']['key'])) {
                    foreach ($input['extra']['key'] as $key => $val) {

                        //Iterating through each extra field and save its value in table mailservice_extrafield
                        $obj = new MailExtraField();
                        $obj->mailservice_id = $mailServiceData->id;
                        $obj->field_name = $input['extra']['key'][$key];
                        $obj->field_type = $input['extra']['type'][$key];
                        $obj->field1_type = $input['extra']['type1'][$key];
                        $obj->field_value = $input['extra']['value'][$key];
                        if (array_key_exists('value1', $input['extra']) && count($input['extra']['value1']) > $key) {
                            $obj->field1_value = $input['extra']['value1'][$key];
                        }
                        $obj->save();

                        if ($input['extra']['type'][$key] == 'number') {
                            //Add value entered in numeric extra field to total amount
                            $totalExtraCharge += $input['extra']['value'][$key];
                            $extraCharges[$input['extra']['key'][$key]] = [];
                            array_push($extraCharges[$input['extra']['key'][$key]], '$' . number_format($input['extra']['value'][$key], 2));
                        } else {
                            $extraCharges[$input['extra']['key'][$key]] = [];
                            array_push($extraCharges[$input['extra']['key'][$key]], $input['extra']['value'][$key]);
                        }

                        if (array_key_exists('value1', $input['extra']) && count($input['extra']['value1']) > $key) {
                            if ($input['extra']['type1'][$key] == 'number') {
                                array_push($extraCharges[($input['extra']['key'][$key])], '$' . number_format($input['extra']['value1'][$key], 2));
                            } else {
                                array_push($extraCharges[$input['extra']['key'][$key]], $input['extra']['value1'][$key]);
                            }
                        }
                    }
                }

                //Business Logic
                //declare variables.
                $estimatedWeightCharges = 0;
                $first500 = ($input['estimatedWeight'] < 2000) ? 800 : 0;

                if ($input['estimatedWeight'] < 2000) {
                    if ($input['estimatedWeight'] > 500) {
                        $estimatedWeightCharges = ($input['estimatedWeight'] - 500) * $input['costPerPound'];
                    }
                } else {
                    $estimatedWeightCharges = $input['estimatedWeight'] * $input['costPerPound'];
                }

                $total = $estimatedWeightCharges
                    + $first500
                    + $totalExtraCharge;


                $mailServiceData->total = $total;
                $mailServiceData->save();

                //Create an array which will be passed to view (mail template).
                // This array will contain all the required data which will be shown on email.
                $displayData = array(
                    'name' => 'Cargo Movers Canada', //This field is no longer used, not removing it as it may be used for Cargo Movers Canada template
                    'customerName' => $input['customerName'],
                    'first500' => number_format($first500, '2'),
                    'estimatedWeight' => $input['estimatedWeight'],
                    'estimatedWeightCharges' => number_format($estimatedWeightCharges, '2'),
                    'costPerPound' => number_format($input['costPerPound'], '2'),
                    'movingdate1' => $input['movingdate1'],
                    'movingdate2' => $input['movingdate2'],
                    'leadInfo' => $input['leadInfo'],
                    'total' => number_format($total, '2'),
                    'leadsProInfo' => 'leadsProInfo',
                    'storageIncluded' => 0,
                    'employeeName' => $input['employeeName'],
                    'customerEmail' => $input['customerEmail'],
                    'customerPhone' => $input['customerPhone'],
                    'subject' => $input['subject'],
                    'extra_charges' => $extraCharges,
                );

                //Fetch company data from table companyinfodata
                $companyData = CompanyInfoData::where('user_id', Auth::id())->orWhereNull('user_id')->orderBy('user_id', 'DESC')->first();
                $displayData['compdata'] = $companyData;

                //send mail
                $this->contact_mail_send($input['customerEmail'], $input['subject'], $displayData);
                DB::commit();
                return redirect()->back()->with('success_message', 'Mail sent successfully');
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error_message', 'Sorry!!, mail failed, may be your smtp configuration is wrong.');
            }

        }
        //show errors is any of the validation rule gets failed
        return Redirect::back()->withErrors($validator)->withInput();
    }

    /**
     * This function will be used to send the mail to the passed email id with the passed subject and display data
     * @param $email
     * @param $subject
     * @param $displaydata
     * @return bool
     * @throws \Throwable
     */
    function contact_mail_send($email, $subject, $displaydata)
    {
        $accessTokenManager = new AccessTokenManager();
        $accessTokenManager->checkAndUpdateAccessToken();
        $googlesmtp = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($googlesmtp) {
            $subject = $subject;
            $email = $email;

            $compdata = CompanyInfoData::where('user_id', Auth::id())->orWhereNull('user_id')->orderBy('user_id', 'DESC')->first();
            $displaydata['compdata'] = $compdata;

            //Find active template for current user from email_template table
            $m_template = EmailTemplate::where(function ($query) {
                $query->where('user_id', Auth::id());
                //->orWhereNull('user_id');
            })->where('status', 'Active')->first();

            if ($m_template) {

                if (\View::exists('emails.user.' . Auth::user()->getCustomerNo() . '.' . $m_template->email_template_token)) {
                    $html = view('emails.user.' . Auth::user()->getCustomerNo() . '.' . $m_template->email_template_token, $displaydata);
                } else {
                    $html = view('emails.send_ticket_mail', $displaydata);
                }
            } else {
                $html = view('emails.send_ticket_mail', $displaydata);
            }
            $mail = new Mail;
            $mail->using($googlesmtp->access_token);
            $mail->to($email, $name = $displaydata['customerName']);
            $mail->from($googlesmtp->email, $name = Auth::user()->name);
            $mail->subject($subject);
            $mail->message($html->render());
            $mail->send();
            return true;
        } else {
            $smtpdata = CustomData::where('user_id', Auth::id())->first();
            if ($smtpdata) {
                $conf = [
                    'driver' => $smtpdata->driver,
                    'host' => $smtpdata->host,
                    'username' => $smtpdata->username,
                    'password' => $smtpdata->pwd,
                    'port' => $smtpdata->port,
                    'encryption' => $smtpdata->encryption,
                    'from' => [
                        'address' => $smtpdata->username,
                        'name' => $smtpdata->fromname,
                    ],
                ];
                Config::set('mail', $conf);
            }

            $subject = $subject;
            $email = $email;

            //Fetch company data from table companyinfodata
            $compdata = CompanyInfoData::where('user_id', Auth::id())->orWhereNull('user_id')->orderBy('user_id', 'DESC')->first();
            $displaydata['compdata'] = $compdata;

            //Find active template for current user from email_template table
            $m_template = EmailTemplate::where(function ($query) {
                $query->where('user_id', Auth::id())//->orWhereNull('user_id')
                ;
            })->where('status', 'Active')->orderBy('user_id', 'DESC')->orderBy('created_at', 'DESC')->first();

            if ($m_template) {
                if (\View::exists('emails.user.' . Auth::user()->getCustomerNo() . '.' . $m_template->email_template_token)) {
                    $ff_ls = 'emails.user.' . Auth::user()->getCustomerNo() . '.' . $m_template->email_template_token;
                } else {
                    $ff_ls = 'emails.send_ticket_mail';
                }
            } else {
                $ff_ls = 'emails.send_ticket_mail';
            }

            $response = \Mail::send($ff_ls, $displaydata, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
            return $response;
        }

    }

    function mail_reply(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'subject' => 'required',
            'message' => 'required',
            'email' => 'required',
        );
        $newnames = array();
        $messages = array();
        $validator = \Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($newnames);
        if ($validator->passes()) {
            try {
                $accessTokenManager = new AccessTokenManager();
                $accessTokenManager->checkAndUpdateAccessToken();
                $googlesmtp = GoogleSMTP::where('user_id', Auth::id())->first();
                if ($googlesmtp) {
                    $subject = $input['subject'];
                    $email = $input['email'];
                    $message = $input['message'];
                    $compdata = CompanyInfoData::where('user_id', Auth::id())->first();
                    $displayData['compdata'] = $compdata;
                    $displayData['customerName'] = 'Big Rewa';
                    $displayData['estimatedWeight'] = 100;

                    $template = $message;
                    $displayData['template'] = $template;
                    $html = view('emails.send_ticket_mail', $displayData);

                    $mail = new Mail;
                    $mail->using($googlesmtp->access_token);
                    $mail->to($email, $name = null);
                    $mail->from($googlesmtp->email, $name = 'Big rewa');
                    $mail->subject($subject);
                    $mail->message($html->render());
                    $mail->send();
                }
                return redirect()->back()->with('success_message', 'Mail sent successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error_message', 'Sorry!!, mail failed, maybe your smtp configration is wrong.');
            }
        }

        return Redirect::back()->withErrors($validator)->withInput();
    }

    /**
     * This function will be used to return the view showing list of all sent emails
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function g_sent_mails()
    {
        $mailObj = new MailServiceData();
        $data = $mailObj->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(9);
        return view('sendmail-list', ['data' => $data]);
    }

    function g_sent_mails_search(Request $request){
        $input = $request->all();
        $id = '';
        if(array_key_exists('id', $input)){
            $id = $input['id'];
        }
        $status = 'all';
        if(array_key_exists('status',$input)){
            $status = $input['status'];
        }
        $priceMin = 0;
        if(array_key_exists('price-min', $input)){
            $priceMin = $input['price-min'];
        }

        $priceMax = 10000;
        if(array_key_exists('price-max', $input)){
            $priceMax = $input['price-max'];
        }

        $mailObj = new MailServiceData();
        $data = $mailObj->where('user_id', Auth::id())
            ->where(function($query) use ($id){
                $query->where('customerEmail', 'like' , '%'.$id.'%')
                      ->orWhere('customerName', 'like' , '%'.$id.'%')
                      ->orWhere('subject', 'like' , '%'.$id.'%');
            });

        $data = $data->where(function($query) use ($priceMin, $priceMax){
            $query->where(function($query) use ($priceMin, $priceMax){
                $query
                    ->where('total','>=',$priceMin)
                    ->where('total','<=',$priceMax);
            })
                ->orWhere(function($query) use ($priceMin, $priceMax){
                    $query
                        ->where('status',2)
                        ->where('final_amount','>=',$priceMin)
                        ->where('final_amount','<=',$priceMax);
                });
        });

        if($status != 'all'){
            $data = $data->where('status', $status);
        }

        $data = $data
            ->orderBy('created_at', 'DESC')->paginate(9);
        session()->flashInput($request->input());
        return view('sendmail-list', ['data' => $data->appends(Input::except('page'))]);
    }


    /**
     * This function will be used to return the view for showing details of specific sent email
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function g_sent_mail_details($id)
    {
        $data = MailServiceData::where('id', $id)->first();
        if (!$data) {
            return redirect('g-send-mail');
        }
        return view('details-sent-mail')->with(['data' => $data]);
    }


    /**
     * This function is used to update the status of a sent mail
     * @param Request $request
     * @return $this
     */
    function update_send_mail_status(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'id' => 'required',
            'status' => 'required',
        );

        if ($input['status'] == 2) {
            $rules['final_amount'] = 'required';
        }
        $validator = \Validator::make($input, $rules, array());
        if ($validator->passes()) {
            $data = MailServiceData::where('id', $input['id'])->first();
            if ($data) {
                $data->status = $input['status'];
                if ($input['status'] == 2) {
                    $data->convert_date = date('Y-m-d');
                    $data->final_amount = $input['final_amount'];
                }
                $data->note = $input['note'];
                $data->save();
                return redirect()->back()->with('success_message', 'Status Updated successfully');
            }
            return redirect()->back()->with('error_message', 'Something went wrong');
        }
        return redirect()->back()->with('error_message', 'Something went wrong');
    }
}
