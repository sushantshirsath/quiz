<body>
  <?php 
  $user_data = $this->session->userdata('userdata');
  ?>
  <div class="container quiz-begin display-res">
    <p><a href="<?php base_url();?>logout">Logout</a></p>
    <h1>Hi <?php echo $user_data['name']; ?></h1>
    <strong>All Users Score</strong>
    <table cellpadding="10">
      <tbody>
        <tr>
          <th>Email-id</th>
          <th>Name</th>
          <th>Total marks</th>
          <th>Time taken</th>
        </tr>

        <?php foreach ($users_final_score as $value) { ?>
          <tr>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->obtained_mark."/".$value->total_mark; ?></td>
            <td><?php 
              $datetime1 = $value->created_date;
              $datetime2 = $value->updated_date;

              $diff = abs(strtotime($datetime2) - strtotime($datetime1)); 

              $years   = floor($diff / (365*60*60*24)); 
              $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
              $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

              $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

              $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

              $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

              echo $hours."hours ".$minuts."minuts ".$seconds."seconds";

              ?>

            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </body>
