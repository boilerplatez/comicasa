<?php 

include_once (RUDRA .'/jquery-file-upload/UploadHandler.php');


class ImageUploader extends UploadHandler {

	function __construct($options = null, $initialize = true, $error_messages = null) {

		parent::__construct(array(
				"upload_dir" => "../static/pri/",
				'upload_url' => "static/pri/",
				'db_table' => 'files',
				'user_dirs' => true,
				'image_versions' => array(
						'' => array(
								'auto_orient' => true
						),
						'thumbnail' => array(
								'upload_dir' => "../static/pub/",
								'upload_url' => "../static/pub/",
								'crop' => true,
								'max_width' => 80,
								'max_height' => 80
						)
				)
		) + $options);
	}
	protected function initialize() {
		// 		$this->db = new mysqli(
		// 				$this->options['db_host'],
		// 				$this->options['db_user'],
		// 				$this->options['db_pass'],
		// 				$this->options['db_name']
		// 		);
		parent::initialize();
		//$this->db->close();
	}

	protected function get_user_id() {
		return $this->options['user_token'];
	}

	protected function handle_form_data($file, $index) {
		$file->title = @$_REQUEST['title'][$index];
		$file->description = @$_REQUEST['description'][$index];
	}

	protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
			$index = null, $content_range = null) {
		$file = parent::handle_file_upload(
				$uploaded_file, $name, $size, $type, $error, $index, $content_range
		);
		if (empty($file->error)) {
			$sql = "INSERT INTO `".$this->options['db_table']
			."` (`uid`,`name`, `size`, `type`, `title`, `description`,`file_path`)"
					." VALUES (%d,'%s', '%s', '%s', '%s', '%s','%s')";
			global $RDb;
			$RDb->update($sql,
					$this->get_user_id(),
					$file->name,
					$file->size,
					$file->type,
					$file->title,
					$file->description,
					str_replace($this->options['upload_dir'],"",$this->get_upload_path($file->name))
			);
			$file->id = $RDb->lastInsertId();
		}
		return $file;
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
	public function delete($print_response = true) {
		$response = parent::delete(false);
		global $RDb;
		foreach ($response as $name => $deleted) {
			if ($deleted) {
				$RDb->update("DELETE FROM `"
						.$this->options['db_table']."` WHERE `name`='%s'",
						$name
				);
			}
		}
		return $this->generate_response($response, $print_response);
	}

	public function delete_file($id,$file_name) {
		global $RDb;
		$file_path = $this->get_upload_path($file_name);
		$success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
		if ($success) {
			foreach($this->options['image_versions'] as $version => $options) {
				$RDb->update("DELETE FROM `"
						.$this->options['db_table']."` WHERE `id`=%d",
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

?>