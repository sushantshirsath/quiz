<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restclient{
  var $API ="";
  function __construct() {
    $this->API="http://localhost/userquiz/index.php/api";
  }

  function post($jsonParams)
  {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API."/userInsert");
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $jsonParams);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }

  function get_user($jsonParams)
  {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API."/userCheck");
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $jsonParams);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }

  function get_question($jsonParams)
  {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API."/getQuestion");
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $jsonParams);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }

  function post_answer($jsonParams)
  {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API."/answerInsert");
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $jsonParams);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }

  function get_all_users_score($param = null)
  {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API."/allUsersSore");
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }

}