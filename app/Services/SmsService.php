<?php

namespace App\Services;

// use Illuminate\Support\Collection;
// use Illuminate\Session\SessionManager;

class SmsService {

    private $server_url;
    private $username;
    private $password;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->server_url = env('SMS_SERVER_URL');
//        $this->username = env('SMS_USERNAME');
//        $this->password = env('SMS_PASSWORD');
        
        $this->server_url = 'http://66.45.237.70/api.php';
        $this->username = '01818737845';
        $this->password = 'BlackAzad';
    }

    public function smsFire($number, $message)
    {

    
        $url = $this->generatingSmsFiringUrl($number, $message);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Sample cURL Request');
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function generatingSmsFiringUrl($number, $message){
        $url = $this->server_url.'?username='.$this->username.'&password='.$this->password.'&number='.$number.'&message='.urlencode($message);  
        return $url;
    }





    // $message = urlencode($message);
    // $url = "http://66.45.237.70/api.php?username=01941204060&password=22882532@&number=$mobile_no&message=$message";
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($curl, CURLOPT_USERAGENT, 'Sample cURL Request');
    // $response = curl_exec($curl);
    // curl_close($curl);
    // return $response;
    // https://bulksmsbd.com/

}