<?php 
    
    
    include 'db/db.php';
    include 'db/function.php';
    include 'vendor/autoload.php';


    $collection=$db->profile;
	$obj=$collection->find();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>
      <th scope="col">User Address</th>
      <th scope="col">User Bio</th>
      <th scope="col">User Password</th>
      <th scope="col">Photo</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  
  <?php foreach ($obj as $document): ?>

    <tr>
      
      <td><?php echo $document["user_name"]; ?></td>
      <td><?php echo $document["user_username"]; ?></td>
      <td><?php echo $document["user_email"]; ?></td>
      <td><?php echo $document["user_address"]; ?></td>
      <td><?php echo $document["user_bio"]; ?></td>
      <td><?php echo $document["user_password"]; ?></td>
      <td><img src="assets/img/user_img/<?php echo $document["user_photo"]; ?>" style="width:60px;" alt=""></td>
      <td><a class="btn btn-primary btn-sm" href="user.php?id=$doc['user_id'];">Delete</a></td>
    </tr>
<?php  endforeach; ?>
  </tbody>
</table>
</div>



</body>
</html>