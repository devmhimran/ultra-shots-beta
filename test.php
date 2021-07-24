<?php
  
  // include 'db/db.php';

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



             $client = new MongoDB\Client;
$companydb = $client->ultra_shots;
$empcollection = $companydb->profile;
$document = $empcollection->findOne(
    ['_id' => '60f9cff7da3935bcd3edd9a4'],
    
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
  


<h1><?php echo $document['user_name']; ?></h1><br>
<p><?php echo $document['user_bio']; ?></p>


</body>
</html>