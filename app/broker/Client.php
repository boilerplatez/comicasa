<?php

namespace Parichya {
    class Client
    {
        public static $OTP_SERVER = "http://otp.parichya.com/";
        public static $OTP_SESSION_DATA = null;
        public static $RETURN_URL;
        public static $OTP_AUTH_INFO = "otp:authData";
        public static $OTP_AUTH_TOKEN = "otp:authToken";
        public static $OTP_RETURN_URL_KEY = "otp:returnUrl";


        public static function authenticate($options = array("otp:serverUrl" => "http://otp.parichya.com/",
            "otp:publicKey" => NULL, "otp:privateKey" => NULL)) {

            self::$OTP_SERVER = isset($options["otp:serverUrl"]) ? $options["otp:serverUrl"] : self::$OTP_SERVER;

            self::$OTP_SESSION_DATA = isset($_SESSION[self::$OTP_AUTH_INFO]) ? $_SESSION[self::$OTP_AUTH_INFO] : false;
            if (self::$OTP_SESSION_DATA && !isset(self::$OTP_SESSION_DATA[self::$OTP_AUTH_TOKEN])) {
                self::$OTP_SESSION_DATA = false;
            }

            if (!self::$OTP_SESSION_DATA) {
                if (!isset($_REQUEST[self::$OTP_AUTH_TOKEN])) {
                    $otpAuthOptions = array(
                        "otp:publicKey" => $options["otp:publicKey"]
                    );
                    if (!isset($options[self::$OTP_RETURN_URL_KEY])) {
                        self::$RETURN_URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $otpAuthOptions[self::$OTP_RETURN_URL_KEY] = self::$RETURN_URL;
                    } else {
                        $otpAuthOptions[self::$OTP_RETURN_URL_KEY] = $options[self::$OTP_RETURN_URL_KEY];
                    }
                    $_SESSION[self::$OTP_RETURN_URL_KEY] = self::$RETURN_URL;

                    header("Location: " . self::$OTP_SERVER . "/login?" . http_build_query($otpAuthOptions));
                    die();
                } else {
                    self::$OTP_SESSION_DATA = json_decode(self::api("POST", self::$OTP_SERVER . "/getdata", array(
                        "otp:publicKey" => $options["otp:publicKey"],
                        "otp:privateKey" => $options["otp:privateKey"],
                        "otp:authToken" => $_REQUEST[self::$OTP_AUTH_TOKEN]
                    )));
                    $_SESSION[self::$OTP_AUTH_INFO] = serialize(self::$OTP_SESSION_DATA);
                }
            } else {
                self::$OTP_SESSION_DATA = unserialize($_SESSION[self::$OTP_AUTH_INFO]);
            }
            return self::$OTP_SESSION_DATA;
        }

        public static function api($method, $url, $data = false)
        {
            $curl = curl_init();

            switch ($method) {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);

                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_PUT, 1);
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }

            // Optional Authentication:
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);
            curl_close($curl);

            return $result;
        }
    }
}


