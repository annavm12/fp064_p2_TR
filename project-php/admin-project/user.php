<?php 

include "db.php";

if(empty($_SESSION["user-data"]))
{
  header("Location:login.php");
}

?>


<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>


<?php

if(empty($_SESSION['user-data']))
{
  header("Location:login.php");
}

$id = $_SESSION['user-data']['Id_usuario'];
$password = $_SESSION['user-data']['Password'];
$where = "Id_usuario =$id";

$user = getList("usuarios",$where);
if(!empty($user))
{
  $user = current($user);
}


?>
<form method="POST" action="db.php" style="border:1px solid #ccc">
  <div class="container">
    <h1>User Info</h1>
    <hr>

    <?php 

      $isTure = $_REQUEST["isTrue"] ?? 'NULL';
      if($isTure == 1)
      {
        echo "<p style='color:green'>User Data updated successfully!</p>";
      }
    ?>
     <input type="hidden" name="action" value="user-update"/>
    <input type="hidden" name="id" value="<?php echo $user['Id_usuario']; ?>"/>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" value="<?php echo $user['email'] ?>" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" value="<?php echo $user['Password'] ?>" name="password" required>

    <label for="psw-repeat"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" value="<?php echo $user['Username'] ?>" required>
    
    <div class="clearfix">
      <button type="submit" class="signupbtn">Update</button>
    </div>
  </div>
</form>

</body>
</html>