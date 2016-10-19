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
//route for the home page
Route::get('/',[
    'uses'  =>  '\leadmark\Http\Controllers\HomeController@index',
    'as'    =>  'home',]);

//route for the login page
Route::get('/signin',[
    'uses'  => '\leadmark\Http\Controllers\AuthController@getSignin',
    'as'    => 'signin',
    'middleware' => 'guest',
]);

Route::post('/signin',[
    'uses'  =>  '\leadmark\Http\Controllers\AuthController@postSignin',
    'middleware' => 'guest',
]);

//end route for signin

//route for the signup page
Route::get('/signup',[
    'uses'  =>  '\leadmark\Http\Controllers\AuthController@getSignup',
    'as'    =>  'signup',
    'middleware' => 'guest',
]);
Route::post('/signup',[
    'uses'  =>  '\leadmark\Http\Controllers\AuthController@postSignup',
    'middleware' => 'guest',
    ]);
//end route for the signup
//logout route
Route::get('/logout',[
    'uses'  =>  '\leadmark\Http\Controllers\AuthController@logout',
    'as'    =>  'signout',
]);
//route for profile
Route::get('/profile/{username}',[
    'uses'  =>  '\leadmark\Http\Controllers\ProfileController@index',
    'as'    =>  'profile',
]);
// route to update the profile
Route::get('/update_profile',[
     'uses'  =>  '\leadmark\Http\Controllers\ProfileController@update',
     'as'    =>  'update_profile',
    'middleware' => 'auth',
 ]);
 Route::post('update_profile',[
     'uses'  =>  '\leadmark\Http\Controllers\ProfileController@postupdate',
     'middleware' => 'auth',

 ]);
// route for changing password
 // route to update the profile
 Route::get('/change_password',[
     'uses'  =>  '\leadmark\Http\Controllers\ChangepasswordController@index',
     'as'    =>  'change_password',
     'middleware' => 'auth',
 ]);
 Route::post('/change_password',[
     'uses'  =>  '\leadmark\Http\Controllers\ChangepasswordController@update',
     'middleware' => 'auth',

 ]);
/**
    Starting route for the phone book.
**/
 Route::get('/phonebook',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@index',
     'as' => 'phonebook',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/list',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@getList',
     'as' => 'phonebook.list',
     'middleware' => 'auth',
 ]);
 Route::post('/phonebook/add',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@add_multiple',
     'as' => 'phonebook.add_multiple',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/genForm',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@genForm',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/updategroup/{group_id}',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@updategroup',
     'middleware' => 'auth',
 ]);
 Route::post('/phonebook/updategroup',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@update_group',
     'middleware' => 'auth',
     'as' => 'updategroup',
 ]);
 Route::post('/phonebook/creategroup',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@creategroup',
     'middleware' => 'auth',
     'as' => 'creategroup',
 ]);
 Route::get('/phonebook/creategroup',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@addgroup',
     'middleware' => 'auth',

 ]);
 Route::get('/phonebook/groups',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@groups',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/deletegroup/{group_id}',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@deletegroup',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/deletecontact/{contact_id}',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@deletecontact',
     'middleware' => 'auth',
 ]);
 Route::get('/phonebook/updatecontact/{contact_id}',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@updatecontact',
     'middleware' => 'auth',
 ]);
 Route::post('/phonebook/updatecontact',[
     'uses'  =>  '\leadmark\Http\Controllers\PhoneBookController@update_contact',
     'middleware' => 'auth',
     'as' => 'updatecontact',
 ]);
 /**
 End route for the phone book.
  **/


 /**
 Starting the SmS Routes
  **/
 Route::get('/sms',function(){
     return redirect()->route('compose');
 });
 Route::get('/sms/compose/{message_id?}',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@compose',
     'middleware' => 'auth',
     'as' => 'compose',
 ]);
 Route::post('/sms/draft',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@savedraft',
     'middleware' => 'auth',
     'as' => 'savedraft',
 ]);
  Route::post('/sms/saverecipients',[
      'uses'  =>  '\leadmark\Http\Controllers\SmsController@saverecipients',
      'middleware' => 'auth',
      'as' => 'saverecipients',
  ]);
 Route::post('/sms/send',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@sendSMS',
     'middleware' => 'auth',
     'as' => 'sendSMS',
 ]);
/*
 * Routes under sms
 * But for scheduling
 * */
 Route::post('/sms/scheduleSMS',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@scheduleSMS',
     'middleware' => 'auth',
     'as' => 'scheduleSMS',
 ]);
 Route::get('/sms/scheduler/{msg?}',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@scheduler',
     'middleware' => 'auth',
     'as' => 'scheduler',
 ]);
 Route::get('/sms/postSchedule',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@postSchedule',
     'middleware' => 'auth',
     'as' => 'postSchedule',
 ]);
Route::post('/sms/autoscheduler',[
    'uses'  =>  '\leadmark\Http\Controllers\SmsController@autoscheduler',
    'middleware' => 'auth',
    'as' => 'autoscheduler',
]);
 Route::get('/sms/autoscheduleSMS/{msg?}',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@autoscheduleSMS',
     'middleware' => 'auth',
     'as' => 'autoscheduleSMS',
 ]);
// route to get auto scheduler files
 Route::get('/sms/autoschduler/birthday',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@autogetBirthday',
     'middleware' => 'auth',
     'as' => 'birthday']);
 Route::get('/sms/autoschduler/dates',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@autogetDates',
     'middleware' => 'auth',
     'as' => 'dates']);
 Route::get('/sms/autoschduler/frequency',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@autogetFrequency',
     'middleware' => 'auth',
     'as' => 'frequency']);
 Route::get('/sms/auto/adddate',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@adddate',
     'middleware' => 'auth',
     'as' => 'adddate']);
 Route::get('/sms/auto/schedulebirthday',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@schedulebirthday',
     'middleware' => 'auth',
     'as' => 'schedulebirthday']);
Route::get('/sms/auto/schedulefrequency',[
    'uses'  =>  '\leadmark\Http\Controllers\SmsController@schedulefrequency',
    'middleware' => 'auth',
    'as' => 'schedulefrequency']);
 Route::get('/sms/auto/scheduledates',[
     'uses'  =>  '\leadmark\Http\Controllers\SmsController@scheduledates',
     'middleware' => 'auth',
     'as' => 'scheduledates']);
/**
 *   End of routing of scheduler
 **/

 Route::get('/sms/messages',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@messages',
     'middleware' => 'auth',
     'as' => 'smsmessages']);

 Route::get('sms/messages/list',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@getlist',
     'middleware' => 'auth',
     'as' => 'listSmsMessages']);
Route::get('sms/messages/delete',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@postMsgDel',
    'middleware' => 'auth',
    'as' => 'postMsgDel']);
 Route::get('sms/messages/details/{id}',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@details',
     'middleware' => 'auth',
     'as' => 'messageDetails']);
Route::get('sms/history',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@smshistory',
    'middleware' => 'auth',
    'as' => 'smshistory']);
Route::get('sms/history/list',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@listHistory',
    'middleware' => 'auth',
    'as' => 'listHistory']);
Route::get('sms/history/delete',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@postHistDel',
    'middleware' => 'auth',
    'as' => 'postHistDel']);
Route::get('sms/history/details/{id}',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@historyDetails',
    'middleware' => 'auth',
    'as' => 'historyDetails']);
 Route::get('sms/history/resend',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@resend',
     'middleware' => 'auth',
     'as' => 'resend']);
Route::get('sms/queues',[
    'uses' =>  '\leadmark\Http\Controllers\SmsDataController@smsqueues',
    'middleware' => 'auth',
    'as' => 'smsqueues']);
 Route::get('sms/queues/list',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@listQueues',
     'middleware' => 'auth',
     'as' => 'listQueues']);
 Route::get('sms/queues/delete',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@postQueuesDel',
     'middleware' => 'auth',
     'as' => 'postQueuesDel']);
 Route::get('sms/history/resendQueue',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@resendQueue',
     'middleware' => 'auth',
     'as' => 'resendQueue']);
 Route::get('sms/queues/details/{id}',[
     'uses' =>  '\leadmark\Http\Controllers\SmsDataController@queuesDetails',
     'middleware' => 'auth',
     'as' => 'queuesDetails']);
/**
 * Starting routes for Emailing
 **/

// Routes for Email Templates
 Route::get('email/templates',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@index',
     'middleware' => 'auth',
     'as' => 'emailTemplates'
 ]);
 Route::get('email/templates/list',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@listTemplates',
     'middleware' => 'auth',
     'as' => 'listTemplates'
 ]);
 Route::get('email/template/delete',[
     'uses' =>  '\leadmark\Http\Controllers\TemplatesController@postTempDel',
     'middleware' => 'auth',
     'as' => 'postTempDel']);
 Route::get('email/templates/create',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@newTemplate',
     'middleware' => 'auth',
     'as' => 'newTemplate'
 ]);
 Route::post('email/templates/create',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@postNewTemplate',
     'middleware' => 'auth',
     'as' => 'postNewTemplate'
 ]);
 Route::get('email/templates/edit/{template_id}',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@editTemplate',
     'middleware' => 'auth',
     'as' => 'editTemplate'
 ]);
 Route::post('email/templates/edit',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@posteditTemplate',
     'middleware' => 'auth',
     'as' => 'postEditTemplate'
     ]);
 Route::get('email/templates/detail/{template_id}',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@viewTemplate',
     'middleware' => 'auth',
     'as' => 'viewTemplate'
 ]);
 Route::get('email/templates/duplicate/{template_id}',[
     'uses' =>   '\leadmark\Http\Controllers\TemplatesController@duplicateTemplate',
     'middleware' => 'auth',
     'as' => 'duplicateTemplate'
 ]);

 /**
 Email list starting
  **/
 Route::get('email/lists',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@index',
     'middleware' => 'auth',
     'as' => 'emailLists'
 ]);

Route::get('email/lists/getlist',[
    'uses' =>   '\leadmark\Http\Controllers\ListController@getLists',
    'middleware' => 'auth',
    'as' => 'listEmailLists'
]);
 Route::get('email/lists/create',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@createList',
     'middleware' => 'auth',
     'as' => 'listEmailCreate'
 ]);
 Route::post('email/lists/create',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@postCreateList',
     'middleware' => 'auth',
     'as' => 'postNewList'
 ]);
 Route::get('email/list/delete',[
     'uses' =>  '\leadmark\Http\Controllers\ListController@postListDel',
     'middleware' => 'auth',
     'as' => 'postListDel']);
Route::get('email/list/duplicate/{list_id}',[
    'uses' =>   '\leadmark\Http\Controllers\ListController@duplicateList',
    'middleware' => 'auth',
    'as' => 'duplicateList'
]);

 Route::get('email/list/edit/{list_id}',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@editList',
     'middleware' => 'auth',
     'as' => 'editList'
 ]);
 Route::post('email/list/edit',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@posteditList',
     'middleware' => 'auth',
     'as' => 'postEditList'
 ]);
 Route::get('email/list/dashboard/{list_id}',[
     'uses' =>   '\leadmark\Http\Controllers\ListController@listDashboard',
     'middleware' => 'auth',
     'as' => 'listDashboard'
 ]);





































//this is route for just testing
 /**
 Right from this section, its all test functions. Dont use for serious work.
  **/
 use leadmark\Models\User;
 use leadmark\Models\config;
 use Illuminate\Support\Facades\Auth;
 use leadmark\Classes\Sms;
 use leadmark\Classes\Mymail;

// use Mailgun\Mailgun;
Route::get('/test', function(){
//    $users = new User();
//    $user = $users::find(6);
//    $user->password = bcrypt('mayowa1995');
//    $user->save();
//
////    $may = new Mymail();
//    $from = "innoshoppers@gmail.com";
//    $maillist = "afotrick2011@gmail.com";
//    $subject = "Running Diagnostics";
//    $body = "All FYN";
//    $v = $may->sendEmail($from,$maillist,$subject,$body);
//    var_dump($v);

//    $mg = new Mailgun("key-a4dae7e1c0552912d726c99df5ba4247");
//    $domain = "nairarent.com";

# Now, compose and send your message.
//    $mg->sendMessage($domain, array('from'    => 'afotrick2011@yahoo.com',
//        'to'      => 'afotrick2011@gmail.com',
//        'subject' => 'The PHP SDK is awesome!',
//        'text'    => 'It is so simple to send a message.'));
//
//    $start = date_create_from_format("Y/m/d","2016/06/23");
//    $end = date_create_from_format("Y/m/d","2017/10/29");
//    $num1 = (int)date_timestamp_get($start);//1466663133
//    $num2 = (int)date_timestamp_get($end);    //1469773533
//    echo $num2-$num1;
//    for($i = $num1;$i<=$num2;$i=($i+100000)){
//        echo $i."<br>";
//    }

//    date_timestamp_get(date_add($start,date_interval_create_from_date_string("10 days")));
//    echo date_format($start,"Y-m-d");
//    $value = [];
//    for($i = date_timestamp_get($start);$i<=date_timestamp_get($end);$i = date_timestamp_get(date_add($start,date_interval_create_from_date_string("2 months")))){
//        $value[] = date("Y/m/d",$i);
//    }
//
//    $p = json_encode($value);
//
//    print_r(json_decode($p));
//




//    $config = new Sms;
//    echo $config->addMessage('2','1','standard',time()+10000,'sent',3,'test','testing','');
//    $send = $config->sendSms('MTN','08174086809','This is test text.');
//    $no = $config->recipientBreaker('080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//                                     080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//                                     080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//                                     080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//                                     080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//                                     080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994');
//    echo "Running";
//    $res = $config->ProcessSMS(3,null,time(),'Standard',false,'MTN','08174086809','Webb App test 1 successfull. Moving to schedulling');
//
//    if($res->ifError){
//        echo $res->getError();
//    }
//    echo $config->smsUnitCost('08174086809,08023441665,2348023441665',1);
//    echo '<pre>',print_r($no),'</pre>';
//    echo $config->ProcessSMS('2','xx','232323232323','okokok080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//        080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//        080229939493,0292939292,2009495,29293939,38948499393,39394943940,93939393939,39393994994,9393939993,3939399393,93939393993,39993939393,329393993,39399399399393,39939393939,
//        080229939493,0292939292,2009495');
//    return Auth::User()->id;
//   return redirect()
//        ->route('home')
//        ->with('info','You have successfully Created An Account.');

});

use leadmark\Models\Contacts;
 use leadmark\Models\Contact_groups;
 Route::get('/test2', function(){
     $users = Contacts::all();

     foreach($users as $user){
//         print_r($user->contact_groups);
         echo $user->name." is in group ".$user->contact_groups->name."<br>";
//         echo $user->name." is in group ".Contact_groups::find($user->contact_group_id)->name."<br>";

     }


 });
 Route::get('/product',[
     'uses'  =>  '\leadmark\Http\Controllers\ProductController@getIndex',
     'as' => 'product'
 ]);

 Route::get('/product/list',[
     'uses'  =>  '\leadmark\Http\Controllers\ProductController@getList',
     'as' => 'product.list'
 ]);
 Route::get('/product/create',[
     'uses'  =>  '\leadmark\Http\Controllers\ProductController@getCreate',

 ]);