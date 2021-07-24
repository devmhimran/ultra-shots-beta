<!-- DELETE PART -->
<?php
	
	include('db/db.php');
	
	$id = $_GET['id'];

	 $sql ="DELETE FROM user_data WHERE id='$id'" ;
	 $conn -> query($sql);
	header('location:log-in.php');


?>