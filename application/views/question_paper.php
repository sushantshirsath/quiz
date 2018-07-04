<body>
  <?php
  $attributes = array('id' => 'quizform');
  echo form_open('quiz/check-answer', $attributes);
  ?>
  <div class="container quiz-begin">
    <?php 
    $user_data = $this->session->userdata('userdata');
    ?>
    <h1>Hi <?php echo $user_data['name']; ?></h1>
    <div class="question">
      <p><?php echo $question_res[0]->question; ?></p>
      <div class="answers">
        <input type="hidden" name="uid" value='<?php echo trim($user_data['user_id'],'"');?>' />
        <input type="hidden" name="qid" value='<?php echo $question_res[0]->id; ?>' />
        <label>Yes</label><input type="radio" name="ans" value="<?php echo $question_res[0]->answer_1; ?>">       
        <label>No</label><input type="radio" name="ans" value="<?php echo $question_res[0]->answer_2; ?>">
      </div>
      <div>
        <?php if ($question_res[0]->id != '5') { ?>
          <button type="submit" class="nextbtn" id="next">Next</button>
          <?php }else{ ?>
            <button type="submit" class="nextbtn" id="next">Submit</button>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
      echo form_close();
      ?>
    </body>
