<?php

namespace leadmark\Console\Commands;

use Illuminate\Console\Command;
use leadmark\Models\messages;
use leadmark\Models\queues;
use leadmark\Models\Activities;
use leadmark\Models\Notifications;
use leadmark\Classes\Sms;

class SendQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:queues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS That are saved to the Queue';

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
        $msg = new Sms();
        $now = time();
        $queues = queues::where('sending_date_time','<',$now)->where('status','not sent')->get();


        foreach($queues as $queue){
//            Send the msg
            $subject = $queue->subject;
            $content = $queue->content;
            $recipients = $queue->recipients;

            $result = $msg->ProcessSMS($queue->user_id,$queue->campaign_id,time(),'schedule',true,$subject,$recipients,$content,false);
            if(!$result->ifError){
                $units = $result->unitCharged;
                $note = new Notifications();

                $note->user_id = $queue->user_id;
                $note->message = 'Your SMS message that was scheduled has just been successfully sent. '.$units.' Units Used.';
                $note->type = "success";
                $note->save();
                $queue->delete();
            }else{
                $units = $result->unitCharged;
                $note = new Notifications();

                $note->user_id = $queue->user_id;
                $note->message = 'Your SMS message that was scheduled failed to send. The error was '.$result->getError();
                $note->type = "error";
                $note->save();
                $queue->status = 'failed';
                $queue->save();
            }

        }


    }
}
