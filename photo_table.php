<?php 
    
    
    include 'db/db.php';
    include 'db/function.php';
    include 'vendor/autoload.php';


    $collection=$db->post_photo;
	$object=$collection->find();
 
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

    </tr>
  </thead>
  <tbody>
  
  <?php foreach ($object as $doc): ?>

    <tr>
      
      <td><?php echo $doc["post_photo"]; ?></td>
      <td><?php echo $doc["user_id"]; ?></td>
      <td><?php echo $doc["upload_at"]; ?></td>
      <td><img src="assets/img/user_post/<?php echo $doc["post_photo"]; ?>" style="width:60px;" alt=""></td>

    </tr>
<?php  endforeach; ?>
  </tbody>
</table>
</div>



</body>
</html>