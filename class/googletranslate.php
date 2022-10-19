<?php

class googleTranslate
{

    public function __construct()
    {
    }


    public function getLanguages()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://text-translator2.p.rapidapi.com/getLanguages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: text-translator2.p.rapidapi.com",
                "X-RapidAPI-Key: " . RAPID_API_KEY
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            return $data['data']['languages'];
        }
    }

    public function detect($subject)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2/detect",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "q=$subject",
            CURLOPT_HTTPHEADER => [
                "Accept-Encoding: application/gzip",
                "X-RapidAPI-Host: google-translate1.p.rapidapi.com",
                "X-RapidAPI-Key: ".RAPID_API_KEY,
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            return $data['data']['detections'][0][0]['language'];
        }
    }

    public function translate($languageSource, $languageTarget, $subject)
    {


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "source=$languageSource&target=$languageTarget&q=$subject",
            CURLOPT_HTTPHEADER => [
                "Accept-Encoding: application/gzip",
                "X-RapidAPI-Host: google-translate1.p.rapidapi.com",
                "X-RapidAPI-Key: " . RAPID_API_KEY,
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            return $data;
        }
    }
}
