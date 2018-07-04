<?php
class Quiz_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	function insertUserTime($uid)
	{
		$data = array(
			'user_id'=>$uid,
			);

		$query = $this->db->query("select user_id from quiz_details where user_id=".'"'.$uid.'"');
		$check_uid = $query->result_array();

		if (isset($check_uid[0]) && count($check_uid[0])==1) {
			return FALSE;
		}else{
			$this->db->insert('quiz_details',$data);
			return TRUE;
		}	

	}	

}