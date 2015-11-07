<?php

namespace app\model {

    use \Parichya\Client;
    /**
     * Class User
     * @Model("sessionUser")
     */
    class User extends AbstractUser
    {

        public function auth($username, $passowrd)
        {
            if(($this->authuser->success) && $this->authuser->success){
                $this->uname = $this->authuser->{"otp:user_name"};
                $this->uid = $this->authuser->{"otp:user_id"};
                $this->role = "USER";
                $this->setValid();
                return TRUE;
            }
            return FALSE;
        }

        public function basicAuth(){

            $config = \Config::getSection("OAUTH_CONFIG");

            $this->authuser = Client::authenticate(array(
                "otp:serverUrl" => $config["SERVER"],
                "otp:publicKey" => $config["BROKER_ID"],
                "otp:privateKey" => $config["BROKER_SECRET"]
            ));

            $this->auth(null, null);
        }

        public function unauth()
        {
            $this->setInValid();
        }
    }
}
