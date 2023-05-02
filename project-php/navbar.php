<ul>

  
<?php 
  if(!empty($_SESSION["user-data"])):
?>
<li><a class="active" href="home.php">Welcome To <span style='color: yellow;font-size:20px'><?php
   echo $_SESSION["user-data"]["Username"] ?></span></a></li>

<?php endif ?>
  <li><a class="active" href="home.php">Home</a></li>
  <li><a href="user.php">User</a></li>
  <li><a href="act.php">Actos</a></li>
  <li><a href="calendar.php">Calendar</a></li>
  <?php

  if(!empty($_SESSION["user-data"])):
   ?>
  <li><a href="db.php?action=logout">Logout</a></li>
<?php endif ?>


  <?php

  if(empty($_SESSION["user-data"])):
   ?>
  <li><a href="login.php">Login</a></li>
<?php endif ?>

</ul>