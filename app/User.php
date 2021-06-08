<?php

namespace App;

use Laravel\Spark\User as SparkUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Request;
use Mail;
use App\Model\CustomData;
use App\Model\GoogleSMTP;
use Carbon\Carbon;
use Laravel\Spark\CanJoinTeams;
use URL;

class User extends SparkUser implements MustVerifyEmail
{
	
	use CanJoinTeams;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'two_factor_reset_code',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];


    public function sendPasswordResetNotification($token)
    {
        $input = Request::all();
        $url = url('password/reset/' . $token . '?email=' . $input['email']);
        Mail::send('emails.reset-password', [
            'reset_url' => $url,
        ], function ($message) use ($input) {
            $message->subject('Reset Password Request');
            $message->to($input['email']);
        });
    }

    function checkGoogleSMTP()
    {
        $data = GoogleSMTP::where('user_id', \Auth::id())->first();
        if ($data) {
            return $data;
        }
        return false;
    }


    function checkCustomSMTP()
    {
        $data = CustomData::where('user_id', \Auth::id())->first();
        if ($data) {
            return $data;
        }
        return false;
    }

    function getMailShortBody($string_arr)
    {
        $from_country = '';
        $from_state = '';
        $from_city = '';
        $from_zip = '';

        $to_country = '';
        $to_state = '';
        $to_city = '';
        $to_zip = '';

        $date = '';
        $size = '';

        foreach ($string_arr as $string) {
            if (strpos($string, 'Moving From Country') !== false) {
                $arr_val = explode(':', $string);
                $from_country = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From State') !== false) {
                $arr_val = explode(':', $string);
                $from_state = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From City') !== false) {
                $arr_val = explode(':', $string);
                $from_city = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From Zip') !== false) {
                $arr_val = explode(':', $string);
                $from_zip = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To Country') !== false) {
                $arr_val = explode(':', $string);
                $to_country = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To State') !== false) {
                $arr_val = explode(':', $string);
                $to_state = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To City') !== false) {
                $arr_val = explode(':', $string);
                $to_city = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To Zip') !== false) {
                $arr_val = explode(':', $string);
                $to_zip = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Move Date') !== false) {
                $arr_val = explode(':', $string);
                $date = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Move Size') !== false) {
                $arr_val = explode(':', $string);
                $size = (isset($arr_val[1])) ? $arr_val[1] : '---';
            }


        }

        $html = '<p> Moving Size : ' . $size . '</p>';
        $html .= '<p> Moving Date : ' . $date . '</p>';
        $html .= '<p> Moving From : ' . $from_city . ', ' . $from_state . ', ' . $from_country . ' ( ' . $from_zip . ' ) ' . '</p>';

        $html .= '<p> Moving To : ' . $to_city . ', ' . $to_state . ', ' . $to_country . ' ( ' . $to_zip . ' ) ' . '</p>';

        return $html;

    }


    function getCustomerNo()
    {
        return 'CUST-NO-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);

    }
}
