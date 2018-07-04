<body>
  <?php
  echo form_open('quiz/save-user');
  ?>
  <div class="container">
    <h1>Sign up</h1>
    <p>Please register to access quiz.</p>
    <label for="name"><b>Name</b></label>
    <input type="text" class="uname" placeholder="Enter Name" name="name" required>
    
    <label for="email"><b>Email</b></label>
    <input type="text" class="uemail" id="reg-email" placeholder="Enter Email" name="email" required>
    <p class="err_msg">
      <?php if (($this->session->flashdata('error'))) 
      echo $this->session->flashdata('error'); ?>
    </p>

    <div>
      <button type="submit" class="signupbtn" id="signup">Sign Up</button>
    </div>
    <p class="registerd-user">If you are already registered user, Click <a href="<?php base_url();?>login">here</a> to login</p>
  </div>
  <?php
  echo form_close();
  ?>
</body>
</html>
