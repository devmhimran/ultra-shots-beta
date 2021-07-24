<?php
  
  include 'db/db.php';

  include 'db/function.php';
  include 'vendor/autoload.php';

  session_start();
  if(!isset($_SESSION['id']) AND !isset($_SESSION['user_name']) AND !isset($_SESSION['user_username'])){
		header("location:log-in.php");
	  }

  if(isset($_GET['logout']) AND $_GET['logout'] == 'user-logout'){
    session_destroy();
    setcookie('user_re_log','',time() - (60*60*24*365));
    header("location:log-in.php");
  }



             $post_user = $_GET['id'];
             $post_user_db=$db->profile;
             $obj=$post_user_db->findOne(
              ['user_username' => $post_user],
          );
              
            
         

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

<?php echo $post_user; ?>
<h1><?php echo $obj['user_name']; ?></h1><br>
<p><?php echo $obj['user_bio']; ?></p>


</body>
</html>