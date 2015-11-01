<?php

namespace app\model {


    //require_once(__DIR__.'/UploadHandler.php');

    use \RedBeanPHP\R;

    class ImageUploader extends UploadHandler
    {
        public $file = null;

        function __construct($options = null, $initialize = true, $error_messages = null)
        {

            parent::__construct(array(
                    "upload_dir" => __DIR__ . "/../../static/pri/",
                    'upload_url' => "static/pri/",
                    'path_salt' => (md5(microtime() . "-" .rand (0 , 1000))."-"),
                    'db_table' => 'files',
                    'user_dirs' => true,
                    'album_name' => "Default Album",
                    'image_versions' => array(
                        '' => array(
                            'auto_orient' => true
                        ),
                        'thumbnail' => array(
                            'upload_dir' => __DIR__ . "/../../static/pub/",
                            'path_salt' => (microtime(true)."-"),
                            'upload_url' => "static/pub/",
                            'crop' => true,
                            'max_width' => 80,
                            'max_height' => 80
                        )
                    )
                ) + $options);
        }

        protected function initialize()
        {
            // 		$this->db = new mysqli(
            // 				$this->options['db_host'],
            // 				$this->options['db_user'],
            // 				$this->options['db_pass'],
            // 				$this->options['db_name']
            // 		);
            parent::initialize();
            //$this->db->close();
        }

        protected function get_user_id()
        {
            return $this->options['user_token'];
        }

        protected function handle_form_data($file, $index)
        {
            $file->title = @$_REQUEST['title'][$index];
            $file->description = @$_REQUEST['description'][$index];
        }

        protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
                                              $index = null, $content_range = null)
        {
            $file = parent::handle_file_upload(
                $uploaded_file, $name, $size, $type, $error, $index, $content_range
            );
            if (empty($file->error)) {
                $file->path = str_replace($this->options['upload_dir'], "", $this->get_upload_path($file->name));
                $file->thumbnail = str_replace($this->options["image_versions"]["thumbnail"]['upload_dir'], "",
                    $this->get_upload_path($file->name,"thumbnail"));
                $file->id = 55;
                $this->file = $file;

               // $this->upload2picasa($file);
            }
            return $file;
        }

        function upload2picasa($file){
            $remoteConfig = \Config::getSection("REMOTE_IMAGE");
            $uploader = \ChipVN_ImageUploader_Manager::make('Picasa');

            echo $uploader->login($remoteConfig["google_user_name"], $remoteConfig["google_user_pass"]); // we don't need password here
            //$uploader->setApi($remoteConfig["google_client_id"]); // register in console.developers.google.com
            //$uploader->setSecret($remoteConfig["google_secret_key"]);
            // you can set upload to an albumId by array of albums or an album, system will get a random album to upload
            //$uploader->setAlbumId(array('51652569125195125', '515124156195725'));
            //$uploader->setAlbumId('51652569125195125');
            //echo("will echo noe");
            //print_r($remoteConfig);
            //echo $uploader->addAlbum('testing 1');

            //echo("ok on");
            //if (!$uploader->hasValidToken()) {
            //    $uploader->getOAuthToken('http://yourdomain.com/test.php');
            //}
            //print_r($file);
            //echo $uploader->upload(getcwd() . '/test.jpg');
            // this plugin does not support transload image
        }
        /*
         protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = 'SELECT `id`, `type`, `title`, `description` FROM `'
        .$this->options['db_table'].'` WHERE `name`=?';
        $query = $this->db->prepare($sql);
        $query->bind_param('s', $file->name);
        $query->execute();
        $query->bind_result(
                $id,
                $type,
                $title,
                $description
        );
        while ($query->fetch()) {
        $file->id = $id;
        $file->type = $type;
        $file->title = $title;
        $file->description = $description;
        }
        }
        }
        */
        public function delete($print_response = true)
        {
            $response = parent::delete(false);
            global $RDb;
            foreach ($response as $name => $deleted) {
                if ($deleted) {
                    $RDb->update("DELETE FROM `"
                        . $this->options['db_table'] . "` WHERE `name`='%s'",
                        $name
                    );
                }
            }
            return $this->generate_response($response, $print_response);
        }

        public function delete_file($id, $file_name)
        {
            global $RDb;
            $file_path = $this->get_upload_path($file_name);
            $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
            if ($success) {
                foreach ($this->options['image_versions'] as $version => $options) {
                    $RDb->update("DELETE FROM `"
                        . $this->options['db_table'] . "` WHERE `id`=%d",
                        $id
                    );
                    if (!empty($version)) {
                        $file = $this->get_upload_path($file_name, $version);
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                }
            }
        }

    }
}

?>