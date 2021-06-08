<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'javatutor59@gmail.com',
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {

        // Spark::promotion('coupon-code');
        // Spark::promotion('FreeMonthly');

        // ty removed it 
        // Spark::promotion('dqaw3TXy');
        // ty made change here and also dev mode 


        // Spark::freePlan()
        //     ->features([
        //         'First', 'Second', 'Third'
        // ]);

        // Spark::plan('Basic', 'monthly-basic')
        //     ->price(10)
        //     ->features([
        //         'Feature 1',
        //         'Feature 2',
        //         'Feature 3',
        // ]);
        
        Spark::useStripe()->noCardUpFront()->trialDays(7);

        Spark::plan('Monthly', 'monthly-pro1')
            ->price(30)
            ->features([
                'Fast Email With Beautiful Template',
                'See Your Business Statistics',
                'Very Affordable For Small & Medium Size Moving Companies',
        ]);

        Spark::plan('Yearly', 'yearly-pro')
            ->price(300)
            ->yearly()
            ->features([
                'Fast Email With Beautiful Template',
                'See Your Business Statistics',
                'Very Affordable For Small & Medium Size Moving Companies',
        ]);
    }

    function register(){
        Spark::ensureEmailIsVerified();
        // Mail::send('emails.singup-confirmation',$data,function($message) use($data){
        //     $message->to($data['email']);
        //     $message->subject('Registration Confirmation');
        // });

    }
}
