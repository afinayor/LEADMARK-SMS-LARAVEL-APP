<?php

namespace leadmark\Console\Commands;

use Illuminate\Console\Command;
use leadmark\Models\autoscheduler;
use leadmark\Models\Contacts;
use leadmark\Models\queues;
use DateTime;


class AutoBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This send out Auto Scheduler Messages Scheduled Today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Africa/Lagos');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $autoscheduler = new autoscheduler();
        $contact = new Contacts();

//      Getting all autoschedulers with type birthday
        $autoBirthdays = $autoscheduler::where('type','birthday')->where('status','active')->get();
//        Getting todays date
        $today =  date("d/m");

//        loop through the Autoschedules that where queried
        foreach($autoBirthdays as $days){
//         Get the message details
            $msg = $days->message;
            $msgRecipients = $msg->recipients;
            $queueRecipients = [];
            $time = $days->auto_birthday->time;

            $recipientsArray = explode(',',$msgRecipients);
//            Get All the recipients that have a birthday from the contacts table.
//           Then check if the birthday set for them is today. if it is, add it to the array
            foreach($recipientsArray as $recipient){
                $contactValue = $contact::where('phone',$recipient)->get()->first();
                if(!empty($contactValue->birthday)) {
                    $contactBirthday = DateTime::createFromFormat("Y/m/d", $contactValue->birthday);

                    $birthdayDate = date_format($contactBirthday, "d/m");
                    if ($birthdayDate == $today) {
                        $queueRecipients[] = $recipient;
                    }
                }
            }

//            Now Send to queue
            $stringRecipients = implode(',',$queueRecipients);
            if(count($recipientsArray) > 0) {
                $queue = new queues();
                $queue->user_id = $days->user_id;
                $queue->campaign_id = $days->campaign_id;
                $queue->subject = $msg->subject;
                $queue->content = $msg->content;
                $queue->recipients = $stringRecipients;
                $value = date('Y/m/d') . " " . $time;
                $date_time = DateTime::createFromFormat('Y/m/d H:i', $value);
                $timestamp = date_timestamp_get($date_time);
                $queue->sending_date_time = $timestamp;
                $queue->method = "birthday";
                $queue->status = "not sent";
                $queue->save();
            }
        }
//        return $autoBirthdays;
//        $test = $autoscheduler::find(1);
//        return $test->auto_birthday->time;
    }
}

