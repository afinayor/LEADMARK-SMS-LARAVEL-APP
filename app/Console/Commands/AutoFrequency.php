<?php

namespace leadmark\Console\Commands;

use Illuminate\Console\Command;
use leadmark\Models\autoscheduler;
use leadmark\Models\messages;
use leadmark\Models\queues;
use DateTime;

class AutoFrequency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:Frequency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Autoscheduler Frequency Dates';

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
        $autoFreq = $autoscheduler::where('type','frequency')->where('status','active')->get();
        $today = date('Y/m/d');
        foreach($autoFreq as $freqValues){
            $user_id = $freqValues->user_id;
            $campaign_id = $freqValues->campaign_id;
            $msg = $freqValues->message_id;
            $msgValues = $messages::find($msg);
            $subject = $msgValues->subject;
            $content = $msgValues->content;
            $recipients = $msgValues->recipients;

            $Datelist = json_decode($freqValues->auto_frequency->date_list);
            $time = $freqValues->auto_frequency->time;
            $send_time = $today." ".$time;
            $createDate = DateTime::createFromFormat('Y/m/d H:i', $send_time);
            $timestamp = date_timestamp_get($createDate);
            if(in_array($today,$Datelist)){
                $queue = new queues();

                $queue->user_id = $user_id;
                $queue->campaign_id = $campaign_id;
                $queue->subject = $subject;
                $queue->content = $content;
                $queue->recipients = $recipients;
                $queue->sending_date_time = $timestamp;
                $queue->method = "frequency";
                $queue->status = "not sent";
                $queue->save();
            }
        }
    }
}
