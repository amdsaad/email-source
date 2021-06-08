<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Model\CustomData;
use App\Model\GoogleSMTP;
use Auth;
use LaravelGmail;
use App\Model\ExtraField;
use Dacastro4\LaravelGmail\Services\Message\Mail;
use Config;
use Exception;
use App\Common\AccessTokenManager;

class SMTPConfigureController extends Controller
{
    /**
     * Create a new controller instance.
     *dfs
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
     *
     * @return Response
     */

    function save_smpt_settings(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'driver' => 'required',
            'host' => 'required',
            'pwd' => 'required',
            'username' => 'required|email',
            'port' => 'required|integer|min:1',
            'encryption' => 'required',
            'fromname' => 'required'
        );
        $customObj = new CustomData();
        $userId = Auth::user()->id;
        $data = $obj = $customObj->where('user_id', $userId)->first();
        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            if (empty($data)) {
                $obj = new CustomData();
                $obj->user_id = Auth::id();
            }
            $obj->driver = $input['driver'];
            $obj->host = $input['host'];
            $obj->username = $input['username'];
            $obj->pwd = $input['pwd'];
            $obj->port = $input['port'];
            $obj->encryption = $input['encryption'];
            $obj->fromname = $input['fromname'];
            $obj->save();
            if (empty($data)) {
                return redirect('/smtp-configure')->with('success_message', 'Saved successfully');
            } else {
                return redirect('/smtp-configure')->with('success_message', 'Updated successfully');
            }
        }
        return Redirect::back()->withErrors($v)->withInput();
    }

    public function index()
    {
        $customData = CustomData::where('user_id', \Auth::id())->first();
        return view('smtp-configure')->with(['customData' => $customData]);
    }

    function gmail_login()
    {
        $data = $obj = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($data) {
            return redirect('/');
        }
        if (LaravelGmail::check()) {
            LaravelGmail::logout();
        }
        return LaravelGmail::redirect();
    }

    function save_googlesmtp_settings()
    {
        $google_response = LaravelGmail::makeToken();
        $data = $obj = GoogleSMTP::where('user_id', Auth::id())->first();
        if (!$data) {
            $obj = new GoogleSMTP();
        }
        $obj->access_token = $google_response['access_token'];
        $obj->expires_in = time() + $google_response['expires_in'];
        $obj->scope = $google_response['scope'];
        $obj->token_type = $google_response['token_type'];
        $obj->created = $google_response['created'];
        $obj->refresh_token = $google_response['refresh_token'];
        $obj->email = $google_response['email'];
        $obj->user_id = Auth::id();
        $obj->save();
        return redirect('/smtp-configure')->with('success_message', 'Google SMTP added successfully');
    }


    function google_inbox(Request $request)
    {
        $checkGmail = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($checkGmail) {
            $accessTokenManager = new AccessTokenManager();
            $ccdata = $accessTokenManager->checkAndUpdateAccessToken();
            if ($ccdata) {
                $current_date = date('Y-m-d');
                $month = 1;
                $fltr_date = date("Y-m-d", strtotime("-" . $month . " months", strtotime($current_date)));
                $messages = LaravelGmail::message()->in($box = 'inbox')->after($fltr_date)->subject('New lead from Leads')->preload()->all();
                return view('google-mail-list')->with(['messages' => $messages]);
            }
        }

        return view('google-mail-list')->with(['messages' => []]);

    }


    function gmail_mail_detail($id)
    {
        $accessTokenManager = new AccessTokenManager();
        $check = $accessTokenManager->checkAndUpdateAccessToken();
        if ($check) {
            $message = LaravelGmail::message()->preload()->get($id);
            // echo "<pre>";print_r($message);die;
            if ($message) {
                $message->markAsRead();
                $extra_fields = ExtraField::where('user_id', Auth::id())->orderBy('sorted', 'ASC')->get();
                return view('single-mail')->with(['message' => $message, 'extra_fields' => $extra_fields]);
            }
        }
        return redirect('home');
    }

    function remove_google_account()
    {
        $googlesmtp = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($googlesmtp) {
            $googlesmtp->delete();
            return redirect('template')->with('success_message', 'Removed successfully');
        } else {
            return redirect('template')->with('error_message', 'Sorry!, something went wrong');
        }
    }
}
