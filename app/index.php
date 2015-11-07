<html>
<head>
    <meta charset="utf-8">
    <script>
        <?php

        session_start();

        if (!isset($_SESSION['user_no'])) {
            include_once "./app/Client.php";
            $otpUser = \Parichya\Client::authenticate(array(
                "otp:publicKey" => "ANNAM-PUB-KEY",
                "otp:privateKey" => "ANNAM-PRI-KEY"
            ));
            if(isset($otpUser->success) && $otpUser->success){
                $_SESSION['user_no'] = $otpUser->{"otp:mobileNumber"};
            }
        } else {
           ?> console.log("Hurray Logged in"); <?php
        }
        ?>
        </script>
    <?php

    function clean_url($path){
        return  str_replace('\\', '/', $path);
    }

    $SCRIPT_NAME = clean_url($_SERVER ['SCRIPT_NAME']);
    $SCRIPT_FILENAME = clean_url($_SERVER ['SCRIPT_FILENAME']);

    $BASE_DIR = clean_url (dirname( $SCRIPT_FILENAME ));
    ; // Absolute path to your installation, ex: /var/www/mywebsite
    $DOC_ROOT = str_replace ( $SCRIPT_NAME, '', $SCRIPT_FILENAME); // ex: /var/www
    $BASE_URL = str_replace ( $DOC_ROOT, '', $BASE_DIR ); // ex: '' or '/mywebsite'


    define("CONTEXT_PATH", $BASE_URL . "/");

    $version = isset($_GET["_"]) ? $_GET["_"] : "";

    define("RELOAD_VERSION", $version);

    $nextversion = RELOAD_VERSION;
    if ($version == null || $version == "") {
        $nextversion = 0;
    } else {
        $nextversion++;
    }
    $cdnServer = "http://cdn.annamapp.com/"
    ?>
    <script src="<?= $cdnServer ?>dist/bootloader_bundled/webmodules.bootloader.js">
        window.bootloader({
            debug: false,
            version: ("<?=RELOAD_VERSION?>"),
            appContext: '<?=CONTEXT_PATH?>',
            resourceDir: '',
            resourceUrl: '<?=$cdnServer?>',
            resourceJson: "dist/resource.json",
            indexBundle: "annam/app",
            debugBundles: [],
            apiUrl : "http://staging.api.hotiff.in/"
        });
        var CONTEXT_PATH = "<?=CONTEXT_PATH?>";
        var RELOAD_VERSION = ("<?=RELOAD_VERSION?>");
    </script>
</head>
<body>

</body>
</html>