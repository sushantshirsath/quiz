<body>
  <?php 
  $user_data = $this->session->userdata('userdata');
  ?>
  <div class="container quiz-begin display-res">
    <p><a href="<?php base_url();?>logout">Logout</a></p>
    <h1>Hi <?php echo $user_data['name']; ?></h1>
    <p>You have got <strong><?php echo $user_data['final_res']; ?> / 5 </strong></p>

    <p>Kindly check your mail</p>
    <p><a href="<?php base_url();?>get_all_users_score">all users score</a></p>
  </div>
</body>
