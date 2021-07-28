<!-- DELETE PART -->
<?php
	
	include('db/db.php');
	
			$profile = $_GET['id'];
             $post_db=$db->profile;
             $obj=$post_db->deleteOne(
              ['user_username' => $profile],
          );


             $user_id = $_GET['id'];
             $post_db=$db->post_photo;
             $obj=$post_db->deleteOne(
              ['user_id' => $user_id],
          );


    // session_destroy();
	header('location: log-in.php');


?>