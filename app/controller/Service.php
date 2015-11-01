<?php
/**
 * Created by IntelliJ IDEA.
 * User: lalittanwar
 * Date: 31/10/15
 * Time: 3:56 PM
 */

namespace app\controller {

    use \RedBeanPHP\R;

    class Service
    {

        public static $CONNECTED = false;

        public static function DBSetup()
        {
            if(!self::$CONNECTED){
                R::setup('mysql:host=localhost;dbname=comics', 'comics', 'comics');
                self::$CONNECTED = true;
            }
        }

    }
}


