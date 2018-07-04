<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');

    $this->load->library('restclient');
    $this->load->library('session');

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'sushant.shirsath@gmail.com',
      'smtp_pass' => 'xxxxxxx',
      'mailtype'  => 'html', 
      'charset'   => 'iso-8859-1'
      );
    $this->load->library('email', $config);

    $this->load->model('quiz_model');
  }

  function save_user_form() {
    $this->load->view("header");
    $this->load->view("save_user");
    $this->load->view("footer");
  }

  function save_user(){
    $params = array(
      'name' => $this->input->post('name'),
      'email' => $this->input->post('email')
      );
    $user_res = $this->restclient->post(json_encode($params));

    if ($user_res=="false") {
     $this->session->set_flashdata('error','This email-id is already exist.'); 
     redirect('quiz/save-user-form', 'refresh');
   }else{
    redirect('quiz/login', 'refresh');
  }
}

function login(){
 $this->load->view("header");
 $this->load->view("login_user");
 $this->load->view("footer");
}

function logout(){
  $this->session->sess_destroy();
  redirect('quiz/login', 'refresh');
}

function login_user(){
  $newdata = array();
  $params = array(
    'name' => $this->input->post('name'),
    'email' => $this->input->post('email')
    );
  $user_res = $this->restclient->get_user(json_encode($params));

  if (json_decode($user_res)=="done") {
    $this->session->set_flashdata('error','You have already given quiz.'); 
    redirect('quiz/login', 'refresh');
  }else
  if (count(json_decode($user_res))==0) {
   $this->session->set_flashdata('error','Invalid email-id.'); 
   redirect('quiz/login', 'refresh');
 }else{
  $user_id = $user_res;
  $newdata = array(
    'user_id' => $user_id,
    'name'  =>  $this->input->post('name'),
    'email' =>  $this->input->post('email'),
    'logged_in' => TRUE
    );

  $this->session->set_userdata('userdata', $newdata);
  redirect('quiz/quiz-begin', 'refresh');
}
}

function quiz_begin(){
  $user_data = $this->session->userdata('userdata');

  if ($user_data['email']!=NULL) {
    $this->load->view("header");
    $this->load->view("begin_quiz");
    $this->load->view("footer");   
  }else{
    $this->session->sess_destroy();
    redirect('quiz/login', 'refresh');
  }
}

function complete_quiz(){  
  $data = array();
  $data['uid'] = $this->input->post('uid');
  $insert_res = $this->quiz_model->insertUserTime($this->input->post('uid'));

  $params = array(
    'uid' => $this->input->post('uid')
    );
  $question_res = $this->restclient->get_question(json_encode($params));

  $data['question_res'] = json_decode($question_res);

  $this->load->view("header");
  $this->load->view("question_paper",$data);
  $this->load->view("footer"); 
}

function check_answer(){
 $params = array(
  'uid' => $this->input->post('uid'),
  'qid' => $this->input->post('qid'),
  'ans' => $this->input->post('ans')
  );

 $answer_res = $this->restclient->post_answer(json_encode($params));

 if ($this->input->post('qid') < 5 && count($answer_res)>0) {
   $data['question_res'] = json_decode($answer_res);
   $this->load->view("header");
   $this->load->view("question_paper",$data);
   $this->load->view("footer");
 }else
 if (strpos(json_decode($answer_res), 'done') !== false) {
  $final_res = substr(json_decode($answer_res), 0, 1);

  $data               = $this->session->userdata('userdata');
  $data['final_res']  = $final_res;
  $this->session->set_userdata('userdata', $data);

  redirect('quiz/get_total_score', 'refresh');
}
}

function get_total_score(){
  $this->email->from('sushant.shirsath@gmail.com', 'Sushant');
  $this->email->to('sushant.shirsath@gmail.com');

  $this->email->subject('Quiz Result');
  $this->email->message('Congratulations!');
  $this->email->send();

  $this->load->view("header");
  $this->load->view("final_result");
  $this->load->view("footer");
}

function get_all_users_score(){

  $user_res = $this->restclient->get_all_users_score();

  $data['users_final_score'] = json_decode($user_res);

  $this->load->view("header");
  $this->load->view("users_final_score",$data);
  $this->load->view("footer");
}


}
