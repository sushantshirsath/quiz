<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('api_model');
	}

	public function userInsert_post(){
		$data = file_get_contents(('php://input'));
		$json_data = json_decode($data);

		$insert_data = array('name' => $json_data->name,
			'email' => $json_data->email,
			);
		
		$insert_res = $this->api_model->insertUser($insert_data);

		echo $this->set_response($insert_res, REST_Controller::HTTP_CREATED);
	}

	public function userCheck_post(){
		$data = file_get_contents(('php://input'));
		$json_data = json_decode($data);

		$check_data = array(
			'email' => $json_data->email,
			);
		
		$check_res = $this->api_model->checkUser($check_data);

		echo $this->set_response($check_res, REST_Controller::HTTP_CREATED);
	}

	public function getQuestion_post(){
		$question_res = array();
		$data = file_get_contents(('php://input'));
		$json_data = json_decode($data);

		$check_uid = array(
			'uid' => $json_data->uid,
			);
		
		$question_res = $this->api_model->getQuestion($check_uid);

		echo $this->set_response($question_res, REST_Controller::HTTP_CREATED);
	}

	public function answerInsert_post(){
		$data = file_get_contents(('php://input'));
		$json_data = json_decode($data);

		$insert_data = array('user_id' => $json_data->uid,
			'question_id' => $json_data->qid,
			'attempted' => $json_data->ans,
			);
		
		$answer_res = $this->api_model->insertAnswer($insert_data);

		echo $this->set_response($answer_res, REST_Controller::HTTP_CREATED);
	}

	public function allUsersSore_get(){
		
		$all_users_res = $this->api_model->getAllUsersSore();

		echo $this->set_response($all_users_res, REST_Controller::HTTP_CREATED);
	}

}