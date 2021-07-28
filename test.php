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


     

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  


<form action="<?php $_SERVER['PHP_SELF']?>" method = "POST" enctype='multipart/form-data'>
  <select class="form-select" aria-label="Default select example" name="category">
      <option selected>Uncategorized</option>
        <option value="Wild Life">Wild Life</option>
        <option value="Nature">Nature</option>
        <option value="Sports / Action">Sports / Action</option>
        <option value="Landscape">Landscape</option>
      </select>
      <input class="btn btn-primary" type="submit" name="submit">
</form>


<?php
$client = new MongoDB\Client;
$companydb = $client->ultra_shots;
$empcollection = $companydb->post_photo;
if(isset($_POST['submit'])){

$category = $_POST['category'];

    }


$document = $empcollection->find(
    ['category' => $category ]);


    
?>
 
<style>
  img{
    padding: 100px 10px;
    width: 220px;
  }
</style>


<?php foreach($document as $object): ?>
<img  src="assets/img/user_post/<?php echo $object['post_photo'] ?>" alt="">


<?php

    endforeach;



?>
</body>
</html>