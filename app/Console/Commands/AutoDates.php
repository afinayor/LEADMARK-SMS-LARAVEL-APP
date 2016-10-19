<?php

namespace leadmark\Console\Commands;

use Illuminate\Console\Command;
use leadmark\Models\autoscheduler;
use leadmark\Models\Contacts;
use leadmark\Models\messages;
use leadmark\Models\queues;
use DateTime;


class AutoDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:AutoDates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Autoscheduler for Special Dates';

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
        $messages = new messages();
        //      Getting all autoschedulers with type birthday
        $autoDates = $autoscheduler::where('type','dates')->where('status','active')->get();
        $today = date('Y/m/d');
        foreach($autoDates as $dateValues){
            $user_id = $dateValues->user_id;
            $campaign_id = $dateValues->campaign_id;
            $msg = $dateValues->message_id;
            $msgValues = $messages::find($msg);
            $subject = $msgValues->subject;
            $content = $msgValues->content;
            $recipients = $msgValues->recipients;

            $date = $dateValues->auto_date->date;
            $time = $dateValues->auto_date->time;
            $value = $date . " " . $time;
            $createDate = DateTime::createFromFormat('Y/m/d H:i', $value);
            $timestamp = date_timestamp_get($createDate);
            if($date == $today){
                $queue = new queues();

                $queue->user_id = $user_id;
                $queue->campaign_id = $campaign_id;
                $queue->subject = $subject;
                $queue->content = $content;
                $queue->recipients = $recipients;
                $queue->sending_date_time = $timestamp;
                $queue->method = "dates";
                $queue->status = "not sent";
                $queue->save();
            }
        }
    }
}
