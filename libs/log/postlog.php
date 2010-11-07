<?php

class Postlog {
	
	private $url = 'http://www.errorstack.com/submit';
	private $key = null;

	public function __construct ($options = array()) {
		$this->key = $options['key'];
	}
	
	public function write ($type, $message) {
		App::import('Core', 'HttpSocket');
		$HttpSocket = new HttpSocket();
		$data = array(
			'_s' => $this->key,
			'_r' => 'json',
			'type' => $type,
			'message' => $message,
			'postingIP' => getenv('REMOTE_ADDR'),
			'createdDate' => date('r'),
			'UserAgent' => getenv('HTTP_USER_AGENT'),
			'error' => json_encode(error_get_last())
		);
		$HttpSocket->post($this->url, $data);
	}

}

?>