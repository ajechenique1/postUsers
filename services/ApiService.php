<?php
namespace Services;

use Illuminate\Http\Request;

class ApiService
{

    public function getDataApi($url, $method){
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
               "Content-Type: application/json",
               "cache-control: no-cache"
            ],
        ]);
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          $data = json_decode($response, true);

          return $data;
    }
    
}
