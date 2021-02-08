<?php

//recaptcha method 
function reCaptcha()
{
    if (isset($_POST['g-recaptcha'])) {
        $secretkey = "6LeUkUEaAAAAAI4_m3ONcFqPWEp0mHpr8ttqyoMp";
        $responsekey = $_POST['g-recaptcha-response'];
        $remoteIP = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secretKey=$secretkey&response=$responsekey&remoteip=$remoteIP";
        $response = file_get_contents($url);
        $response = json_decode($response, true);

        return ($response['success']) ? $response['success'] : false;
    }
    return false;
}
