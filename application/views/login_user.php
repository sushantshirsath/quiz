<body>
  <?php
  echo form_open('quiz/login-user');
  ?>
  <div class="container">
    <h1>Login</h1>
    <p class="err_msg">
      <?php if (($this->session->flashdata('error'))) 
      echo $this->session->flashdata('error'); ?>
    </p>
    <label for="name"><b>Name</b></label>
    <input type="text" class="uname" placeholder="Enter Name" name="name" required>
    
    <label for="email"><b>Email</b></label>
    <input type="text" class="uemail" id="uemail" placeholder="Enter Email" name="email" required>

    <div>
      <button type="submit" id="user_login" class="signupbtn">Login</button>
      <p class="registerd-user">If you do not have an account, Click <a href="<?php base_url();?>save-user-form">here</a> to register</p>
    </div>
  </div>
  <?php
  echo form_close();
  ?>
</body>
</html>
