<?php
class Api_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function insertUser($insert_data){
		$email = $insert_data['email'];
		
		$query = $this->db->query("select * from user_details where email=".'"'.$email.'"');
		$check_email = $query->result_array();

		if (count($check_email)==1) {
			return FALSE;
		}else{
			$this->db->insert('user_details', $insert_data);
			return TRUE;
		}	
	}

	public function checkUser($check_data){
		$email = $check_data['email'];
		
		$query = $this->db->query("select id from user_details where email=".'"'.$email.'"');
		$check_email = $query->result_array();
		$uid = $check_email[0]['id'];

		$query = $this->db->query("select user_id from quiz_details where user_id=".'"'.$uid.'"');
		$check_user = $query->result_array();

		if (count($check_user)==1) {
			return "done";
		}else
		if (count($check_email)==1) {
			return $check_email[0]['id'];
		}else{
			return FALSE;
		}	
	}

	function getQuestion($check_uid){
		$uid =	$check_uid['uid'];
		$query = $this->db->query("select q.id, q.question, an.answer_1, an.answer_2 from questions q 
			JOIN user_attempt ua 
			ON q.id!=ua.question_id 
			JOIN answers an
			ON an.question_id = q.id
			WHERE ua.user_id = ".'"'.$uid.'" LIMIT 1');
		$question_res = $query->result_array();

		if (count($question_res)==0) {
			$query = $this->db->query("select q.id, q.question, an.answer_1, an.answer_2 from questions q 
				JOIN answers an
				ON an.question_id = q.id LIMIT 1");
			$question_res = $query->result_array();
		}
		return $question_res;
	}

	public function insertAnswer($insert_data){
		$uid = $insert_data['user_id'];
		$qid = $insert_data['question_id'];

		$query = $this->db->query("select id from user_attempt where user_id='".$uid."' AND question_id='".$qid."' ");
		$check_row = $query->result_array();
		if(count($check_row)!=0){
			$query = $this->db->query("select q.id, q.question, an.answer_1, an.answer_2 
				from answers an JOIN questions q 
				ON an.question_id=q.id 
				WHERE q.id NOT IN (SELECT question_id FROM user_attempt WHERE user_id = '".$uid."' ) LIMIT 1");
			$question_res = $query->result_array();
			return $question_res;
		}else
		if (count($check_row)==0) {
			$insert_res = $this->db->insert('user_attempt', $insert_data);
		}
		// else{

		if($qid == 5) {
			$query = $this->db->query("select SUM(attempted) AS attempted from user_attempt WHERE user_id='".$uid."' GROUP BY user_id");
			$total_result = $query->result_array();

			$obtained_mark = $total_result[0]['attempted'];

			$value=array('obtained_mark'=>$obtained_mark);
			$this->db->where('user_id', $uid);
			$this->db->update('quiz_details', $value);

			return $obtained_mark."|"."done";
		}else
		if (count($insert_res)>0) {
			$query = $this->db->query("select q.id, q.question, an.answer_1, an.answer_2 
				from answers an JOIN questions q 
				ON an.question_id=q.id 
				WHERE q.id NOT IN (SELECT question_id FROM user_attempt WHERE user_id = '".$uid."' ) LIMIT 1");
			$question_res = $query->result_array();
			return $question_res;
		}
		// }

	}

	public function getAllUsersSore(){
		
		$query = $this->db->query("SELECT ud.name, ud.email, qd.total_mark,
			qd.obtained_mark, qd.created_date, qd.updated_date 
			FROM user_details ud INNER JOIN quiz_details qd 
			ON ud.id = qd.user_id ORDER BY qd.obtained_mark DESC");

		$all_users_score = $query->result_array();

		return $all_users_score;	
	}


}