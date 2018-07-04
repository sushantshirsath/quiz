<body>
  <?php
  echo form_open('quiz/complete-quiz');
  ?>
  <div class="container quiz-begin">
    <h1>Welcome <?php echo $this->session->userdata('name'); ?></h1>
    <p>Please click on <strong>BEBIN</strong> button to start quiz.</p>

    <?php 
    $user_data = $this->session->userdata('userdata');
    $uid = $user_data['user_id'];
    ?>

    <input type="hidden" name="uid" value='<?php echo trim($uid,'"');?>' />

    <div class="begin">
      <button><strong>BEBIN</strong></button>
    </div>
  </div>
  <?php
  echo form_close();
  ?>
</body>

