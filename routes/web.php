<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');
Route::get('/about_us', 'WelcomeController@about_us');
Route::get('/faq', 'WelcomeController@faq');
Route::get('/testimonial', 'WelcomeController@testimonial');
Route::get('/privacy_policy', 'WelcomeController@privacy_policy');
Route::get('/contact_us', 'WelcomeController@contact_us');


Route::group(['middleware' => 'auth'], function ($router) {

    $router->get('/home', 'MailServiceController@index');
    $router->get('/mail-service', 'MailServiceController@index');

    $router->get('/template', 'TemplateController@index');
    $router->get('/template/add/{id?}', 'TemplateController@template_add');
    $router->get('/template/delete/{id}', 'TemplateController@template_delete');
    $router->get('template/set_default/{id}', 'TemplateController@set_default');
    $router->get('template/set_admin_default/{id}', 'TemplateController@set_admin_default');
    $router->post('save_template','TemplateController@save_template')->name('save_template');

    $router->get('/smtp-configure', 'SMTPConfigureController@index');
    $router->get('/extra-mail-field', 'TemplateController@extra_mail_field');
    $router->post('/save-extra-field-frm', 'TemplateController@save_extra_mail_field');
    $router->post('/delete-extra-field-frm', 'TemplateController@delete_extra_mail_field');
    $router->post('/sorted-extra-field-frm', 'TemplateController@sorted_extra_field_frm');
    $router->get('/company-info', 'CompanyInfoController@index');
    $router->post('save_company_info','CompanyInfoController@save_company_info')->name('save_company_info');
    $router->get('send_ticket_mail','MailServiceController@send_ticket_mail')->name('send_ticket_mail');
    $router->post('save_mail_service','MailServiceController@save_mail_service')->name('save_mail_service');
    $router->post('save_smpt_settings','SMTPConfigureController@save_smpt_settings')->name('save_smpt_settings');
    $router->get('/oauth/gmail', 'SMTPConfigureController@gmail_login');
    $router->get('remove-google-account', 'SMTPConfigureController@remove_google_account');
    $router->get('/oauth/gmail/callback', 'SMTPConfigureController@save_googlesmtp_settings');
    $router->get('/google-inbox', 'SMTPConfigureController@google_inbox');
    $router->get('/g-send-mail', 'MailServiceController@g_sent_mails');
    $router->get('/g-send-mail-search', 'MailServiceController@g_sent_mails_search')->name('g-send-mail-search');
    $router->get('/statistics', 'StatisticsController@index')->middleware('admin');
    $router->post('/ajax_email_sent', 'StatisticsController@ajax_email_sent');
    $router->post('/ajax_revenue_graphs', 'StatisticsController@ajax_revenue_graphs');
    $router->post('/ajax_customer_conversation', 'StatisticsController@ajax_customer_conversation');
    $router->post('/ajax_popular_origin', 'StatisticsController@ajax_popular_origin');
    $router->post('/ajax_popular_destination', 'StatisticsController@ajax_popular_destination');
    $router->post('/ajax_avg_cost_per_pound', 'StatisticsController@ajax_avg_cost_per_pound');
    

    $router->post('/mail_reply', 'MailServiceController@mail_reply');
    $router->post('/update_send_mail_status', 'MailServiceController@update_send_mail_status');
    $router->get('/google/mail/details/{id}/{title}', 'SMTPConfigureController@gmail_mail_detail');
    $router->get('/g-sent-mail-details/{id}', 'MailServiceController@g_sent_mail_details');


});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear'); 
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});


Route::get('storage-link', function(){
	$target = storage_path('app/public');
	$link = public_path('storage');
	symlink($target, $link);
	echo 'success';
});

