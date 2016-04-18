<?php
class Message {
	public function __construct( $db ) {
		$this->db = $db;
		$this->type = $type;
		$this->data = $data;
	}	

	public function showMessage($type, $data) {
		//Error
		if($type == "error") {
			return "<span class=\"label label-danger\">".$data."</span>";
		}
		//Feedback
		elseif($type == "feedback") {
			return "<span class=\"label label-success\">".$data."</span>";

		}


	}

}
?>