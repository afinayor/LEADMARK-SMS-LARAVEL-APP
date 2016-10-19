<?php
namespace leadmark\Classes;
require_once'vendor/autoload.php';
use Mailgun\Mailgun;
use Guzzle\Http\Exception;
class Mymail{


    public $mailgunoptin,$mailgunValidate,$mailgun,$mailgun_key,$mailgun_pubkey,$mailgun_domain,$mailgun_list,$mailgun_secret,$error;


    public function __construct(){
        $this->mailgun_key = 'key-a4dae7e1c0552912d726c99df5ba4247';
        $this->mailgun_pubkey = 'pubkey-ba831b7b78de6b4500732daf02ca657b';

        $this->mailgun_domain = 'nairarent.com';
        $this->mailgun_list = 'signups@sandboxfa6783d8aa85470faf1763dd5a1e835a.mailgun.org';
        $this->mailgun_secret = 'mayowa1995';
//        $client = new \Http\Adapter\Guzzle6\Client();
        $this->mailgun = new Mailgun($this->mailgun_key);
        $this->mailgunValidate = new  Mailgun($this->mailgun_pubkey);
        $this->mailgunoptin = $this->mailgun->OptInHandler();

//        parent::__construct();


    }
    public function sendEmail($from,$maillist,$subject,$body){

        $body .= "<br><br><br><br>";
        $body .= "Sent from <b>MAYOWA</b><small> No1 Property listing website in Nigeria</small>. Visit www.nairarent.com for property listings.";
        try {
            $this->mailgun->sendMessage($this->mailgun_domain, [
                'from' => "Nairarent <$from>",
                'to' => $maillist,
                'subject' => $subject,
                'html' => $body
            ]);

       }catch (Exception\CurlException $e){
            $this->error = $e->getError();
            return FALSE;
        }

        return TRUE;
    }
    public function checkemail($email){
        $validate = $this->mailgunValidate->get('address/validate',['address'=>$email])->http_response_body;

        if($validate->is_valid){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function suscribe($email){
        //generate a hash to send to the users email as a confirm suscription link
        $hash = $this->mailgunoptin->generateHash($this->mailgun_list,$this->mailgun_secret,$email);


//        send the email to mailgun maillist
        $suscribed = $this->mailgun->post('lists/'.$this->mailgun_list.'/members',[
            'name' => 'No Name',
            'address' => $email,
            'subscribed' => 'no'
        ]);

//        remember to check if the mail was sent and the the mail was suscribed
        if($suscribed){
            //sending the email
            $sent = $this->mailgun->sendMessage($this->mailgun_domain,[
                'from' =>  $this->CI->settingsmodel->email,
                'to' => $email,
                'subject' => "Please Confirm Your Suscription",
                "html" => "Hello, <br><br> You signed up to our mailing list. Please confirm below<br><br>
<a href='".site_url('addnewsletter/confirm/'.$hash)."'>Link</a>"]);
//print_r($this->CI->settingsmodel->email);
            return TRUE;
        }else{
            return FALSE;
        }


    }
public function checkSuscribed($Vemail){
        $check = $this->mailgun->get('lists/'.$this->mailgun_list.'/members');

         $list = $check->http_response_body->items;
        foreach($list as $email){
            if($email->address == "$Vemail"){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function confirmSuscription($hash){
        $reverthash = $this->mailgunoptin->validateHash($this->mailgun_secret,$hash);
        if($reverthash){
            $list = $this->mailgun_list;
            $email = $reverthash['recipientAddress'];

            $ifConfirmed = $this->mailgun->put('lists/'.$this->mailgun_list.'/members/'.$email,[
               'subscribed' => 'yes'
            ]);
            if($ifConfirmed){
                $this->mailgun->sendMessage($this->mailgun_domain,[
                    'from' =>  $this->CI->settingsmodel->email,
                    'to' => $email,
                    'subject' => "You Have Suscribed",
                    "html" => "Hello, <br><br> Thanks for confirming, you are suscribed."]);
            //print_r($ifConfirmed);
                return TRUE;
            }
        }
    }
    public function getListNo(){
        $getNo = $this->mailgun->get('lists/'.$this->mailgun_list.'/members');
        return $getNo->http_response_body->total_count;
    }
}