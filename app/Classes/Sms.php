<?php
/**
 * Created by PhpStorm.
 * User: Afolabi mayowa
 * Date: 04/08/2016
 * Time: 11:52
 */

namespace leadmark\Classes;
use leadmark\Models\config;
use leadmark\Models\users_assets;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use leadmark\Models\message_history;
use leadmark\Models\messages;
use leadmark\Models\phone_no;
use leadmark\Models\queues;
use leadmark\Models\User;


class Sms {
    public $ifError=false,$unitCharged;
    private $AppSmsUnit,$client,$config,$errorContent;

    public function __construct(){
        $this->config = new config();

        $this->AppSmsUnit = $this->config->getAppUnit();
        return $this;
    }

    public function getUserSmsUnit($user_id){
        $asset = new users_assets();
        $values = $asset::all()->where('user_id',$user_id)->first();
        $unit = $values->sms_unit;
        return $unit;
    }
//    public function removeAppUnit($value){
//        $check = $this->AppSmsUnit-$value;
//        if($check > 1){
//            $this->config->changeAppUnit($check);
//            return true;
//        }else{
//            return false;
//        }
//
//    }
//'http://www.estoresms.com/smsapi.php',array('username'=>"$username",
//'password'=>"$password",'sender'=>$sender,'recipient'=>$recipient,
//'message'=>$message
    public function processSchedule($user_id,$campaign_id,$type='schedule',$sendTime=array(),$subject,$recipient,$message){
        $page_no = ceil(strlen($message)/160);
        $last_id = $this->addMessage($user_id,$campaign_id,$type,$sendTime,'not sent',$page_no,$subject,$message,$recipient);
        foreach($sendTime as $time){
            $queues = new queues();
            $queues->user_id = $user_id;
            $queues->campaign_id = $campaign_id;
            $queues->message_id = $last_id;
            $queues->sending_date_time = $time;
        }

        return true;
    }

    public function ProcessSMS($user_id,$campaign_id,$sendTime,$type,$schedule,$subject,$recipient,$message,$saveMsg=true){
        $no_of_pages = ceil(strlen($message)/160);
        $cost = $this->smsUnitCost($recipient,$no_of_pages);
        $status = "Not Sent";
//        check the units of the user if it will be enough to send the message
//        save message
//        echo "$cost";
        if($this->checkSmsSender($cost,$user_id) == false){

            $this->ifError = true;
            $this->errorContent =  "Your Sms unit is not enough to send this message.";
//            return false;
        }else {

            $result = $this->sendSms($subject, $recipient, $message);
            $check = explode(' ', $result);
            $status = 'Failed';
            if($check[0] != 'OK'){
                $this->addSmsHistory($user_id, $campaign_id, $sendTime, $status, '0', $subject, $recipient, $message);
            }

            if ($check[0] == 'OK') {
//            success
                $unitUsed = $check[1];
                $this->unitCharged = $unitUsed;
                $this->subtractUserSmsUnit($user_id, $unitUsed);
                $status = "Sent";
                $this->addSmsHistory($user_id, $campaign_id, $sendTime, $status, $unitUsed, $subject, $recipient, $message);
            } elseif ($result == '-2904') {
//            error from api server
                $this->ifError = true;
                $this->errorContent = "SMS Sending Failed.Please Try Again Later.";

            } elseif ($result == '-2906') {
//            api unit exsausted
                $this->ifError = true;
                $this->errorContent = "SMS Sending Failed.Please Try Again Later.";
            } elseif ($result == '-2907') {
//            gateway not available
                $this->ifError = true;
                $this->errorContent = "SMS Gateway Unavailable.Please Try Again Later.";
            } elseif ($result == '-2916') {
                $this->ifError = true;
                $this->errorContent = "Your Message Content Is Blocked";
            } elseif ($result == '-2917') {
                $this->ifError = true;
                $this->errorContent = "Your Sender Id Or Subject Is Blocked";
            }else{
                $this->ifError = true;
                $this->errorContent = "SMS Sending Failed.Please Try Again Later.";
            }

        }
        if($saveMsg) {
            $this->addMessage($user_id, $campaign_id, $type, $sendTime, $status, $no_of_pages, $subject, $message, $recipient);
        }
    return $this;
    }
    public function addMessage($user_id,$campaign_id,$type,$sendtime,$status,$pagesNo,$subject,$messageContent,$recipients){
        $message = new messages();
        $message->user_id = $user_id;
        $message->campaign_id = $campaign_id;
        $message->subject = $subject;
        $message->content = $messageContent;
        $message->recipients = $recipients;
        $message->type = $type;
        $message->send_date_time = $sendtime;
        $message->status = $status;
        $message->message_pages = $pagesNo;
        $message->message_characters = '0';
        $message->save();
        return $message->id;
    }
    public function addSmsHistory($user_id,$campaign_id,$sendtime,$status,$unitsUsed,$subject,$recipient,$message){
        $history = new message_history();
        $history->user_id = $user_id;
        $history->campaign_id = $campaign_id;
        $history->subject = $subject;
        $history->content = $message;
        $history->unitsUsed = $unitsUsed;
        $history->recipients = $recipient;
        $history->status = $status;
        $history->date_time_sent = $sendtime;
        $history->save();
        return true;
    }
    public function smsUnitCost($recipients,$no_of_pages)
    {
        $cost = 0;
        $recipients = explode(',', $recipients);

        foreach ($recipients as $number) {
            $numb1 = substr($number, 0, 4);
            $numb2 = substr($number, 0, 5);
            $numb3 = substr($number, 0, 6);
            $numb4 = substr($number, 0, 7);

//            for glo
            if ($numb1 == '0705' || $numb1 == '0805' || $numb1 == '0807' || $numb1 == '0811' || $numb1 == '0815' || $numb1 == '0905' || $numb3 == '234705' || $numb3 == '234805' || $numb3 == '234807' || $numb3 == '234811' || $numb3 == '234815' || $numb3 == '234905') {
                $cost += (1.8*$no_of_pages);
//            for mtn
            } elseif ($numb1 == '0703' || $numb1 == '0706' || $numb1 == '0803' || $numb1 == '0806' || $numb1 == '0810' || $numb1 == '0813'|| $numb1 == '0814'|| $numb1 == '0816'|| $numb1 == '0903' || $numb3 == '234703' || $numb3 == '234706' || $numb3 == '234803' || $numb3 == '234806' || $numb3 == '234810' || $numb3 == '234813' || $numb3 == '234814' || $numb3 == '234816' || $numb3 == '234903'){
                $cost += (1.65*$no_of_pages);
//             for cdma
            } elseif ($numb2 == '07025' || $numb2 == '07026' || $numb2 == '07027' || $numb2 == '07028' || $numb2 == '07029' || $numb1 == '0704' || $numb1 == '0707' || $numb1 == '0709'|| $numb1 == '0804' || $numb1 == '0819' || $numb2 == '07025' || $numb2 == '07026' || $numb2 == '07027' || $numb4 == '2347028' || $numb4 == '2347029' || $numb3 == '234704' || $numb3 == '234707' || $numb3 == '234709'|| $numb3 == '234804' || $numb3 == '234819') {
                $cost += (3.00*$no_of_pages);
//             for all other gsm lines
            }else{
                $cost += (1.45*$no_of_pages);
            }

        }
        return $cost;
    }
    public function getError(){
        return $this->errorContent;
    }

    public function sendSms($subject,$recipient,$message){
        $client = new Client();
//        $RecArray = $this->recipientBreaker($recipient,10);
//        $count = count($RecArray);
//        if($count > 1){
//            $requests = [];
//            foreach($RecArray as $recString){
//                $sRequest = $client->request('GET', 'http://www.estoresms.com/smsapi.php', [
//                    'query' => [
//                        'username' => $this->config->getSms_Username(),
//                        'password' => $this->config->getSms_Password(),
//                        'sender' => $subject,
//                        'recipient' => $recString,
//                        'message' => $message]
//                ]);
//                $requests[] = $sRequest;
//            }
//            $results = Pool::batch($client,$requests);
//            function not complete. We need to take the results and prosess the total unit or if error,
//            send error
//
//        }else {
        $body = "";
        try {
            $result = $client->request('GET', 'http://www.estoresms.com/smsapi.php', [
                'query' => [
                    'username' => $this->config->getSms_Username(),
                    'password' => $this->config->getSms_Password(),
                    'sender' => $subject,
                    'recipient' => $recipient,
                    'message' => $message]
            ]);
            $body = $result->getBody();
        }catch (ClientException $e) {
            Psr7\str($e->getRequest());
            $body = Psr7\str($e->getResponse());
//            $body = $e->getResponse();
        }catch (RequestException $e) {
           Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                $body = Psr7\str($e->getResponse());
//                $body = $e->getResponse();
            }
        }



            return $body;
//        }
    }
    /**
    This function takes in stings and pass out ann array of broken strings by comma
     * @recipient
     **/
    public function recipientBreaker($recipient,$no=100){
        $RecArray = explode(',',$recipient);
        $chunkArray = array_chunk($RecArray,$no);
        $returnArray = [];
        foreach($chunkArray as $array){
            $numbers = implode(',',$array);
            $returnArray[] = $numbers;
        }

        return $returnArray;
    }

    public function checkSmsSender($unit_cost,$user_id){
        $user_unit = $this->getUserSmsUnit($user_id);
        $remainder = $user_unit-$unit_cost;
        if($remainder > 0){
            return true;
        }else{
            return false;
        }
    }
    public function addUserSmsUnit($user_id,$add=0){
//        get Current unit balance
        $cUnit = $this->getUserSmsUnit($user_id);
        $newUnit = $cUnit + $add;
        $asset = new users_assets();
        $values = $asset::all()->where('user_id',$user_id)->first();
        $values->sms_unit = $newUnit;
        $values->save();
        return true;
    }
    public function subtractUserSmsUnit($user_id,$subtract=0){
//        get Current unit balance
        $cUnit = $this->getUserSmsUnit($user_id);
        $newUnit = $cUnit - $subtract;
        $asset = new users_assets();
        $values = $asset::all()->where('user_id',$user_id)->first();
        $values->sms_unit = $newUnit;
        $values->save();
        return true;
    }

}