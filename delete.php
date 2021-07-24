<!-- DELETE PART -->
<?php
	
	include('db/db.php');
	
			$photo_name = $_GET['id'];
             $post_db=$db->post_photo;
             $obj=$post_db->deleteOne(
              ['post_photo' => $photo_name],
          );

	header('location: profile.php');


?>