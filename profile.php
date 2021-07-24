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

    $log_in_user = $_SESSION['id'];
      $collection=$db->post_photo;
      $object=$collection->find(
      ['user_id' => $log_in_user],
      [
        'sort' => ['post_photo' => -1]
      ]
    );


?>

                           
            
         

<?php



if(isset($_POST['upload_photo'])){
    $user_id = $_SESSION['id'];
    // Photo validation + Upload DataBase
           // -----------------------------------
           $post_photo = photo_upload($_FILES['user_post'],'assets/img/user_post/');
           $photo_data = $post_photo['file_name'];
           $upload_at = date("Y-m-d");
           if ( $post_photo['status'] == 'yes' ) {

            $post_photo=$db->post_photo; //Here, data is the name of table and $db is variable of selected database.

            //Now, Creating a array document which will be inserted in database.
    
    
                    $insert_upload_photo =  $post_photo->insertOne(
                        [
                            "post_photo"=>$photo_data,
                            "user_id"=>$user_id,
                            "upload_at"=>$upload_at
                            
                        ]
                    );
            //    set_msg('Successfully Sign Up');
            $insert_upload_photo->getInsertedCount();
               header("location: profile.php");
           }
           else{
               $valid[] =  "<p class='alert alert-warning'>Invaild file format<button class='close' data-dissmiss='alert'>&times;</button></p>";
           } 
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" shortcut icon" type="image/x-icon" href="assets/img/logo/favicon-ultra-shots.png">
    <title><?php echo $_SESSION['user_name'] ?></title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <script>
    $(document).ready(function(){
      $("#search-box").click(function(){
        $("#search").slideToggle();
      });

      $(".dropdown").click(function(){
        $(".dropdown-content").hide();
      });
      
    });
 
    </script>
    
</head>
<body>
    
    <!-- ===== NAV BAR START ===== -->
    <div class="container">
        <div class="navbar">
            <div class="nav-logo">
                <a href="index.php"><img src="assets/img/logo/ultra-Shots-black.png" alt=""></a>
            </div>
            <div class="nav-items">               
                    <input id="search-box" class="search-box" type="text" placeholder="Search">
                    <!-- <a id="search" class="search-icon" href="#"><i  class="fas fa-search"></i></a>               -->
                    <a href="profile.php"><img class="profile-img" src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>"></a>
                    <a class="logout" id="dropdown" href="?logout=user-logout"><i class="fas fa-sign-out-alt"></i></a>
                    <a class="setting dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-cog"></i></a>   
                    <div class="dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <a href="update.php?id=<?php echo $_SESSION['id'] ;?>" class="dropdown-item" type="button">Update Account</a>
                      <a href="profile-delete.php?id=<?php echo $_SESSION['id'] ;?>" class="dropdown-item" type="button">Delete Account</a>
                    </div>
                </div>     
            </div>
        </div>
    </div>
    <!-- ====== NAV BAR END ====== -->
    <hr>
    <main>
        <div class="container">
            <div class="user_detail">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center user_image">
                                <img src="assets/img/user_img/<?php echo $_SESSION["user_photo"]; ?>" class="" alt="...">
                              </div>
                        </div>
                        <div class="col-md-8">
                            <div class="user_name">
                                <h4><?php echo $_SESSION['user_name']; ?></h4>
                            </div>
                            <div class="user_bio">
                                <p><?php echo $_SESSION['user_bio']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="user_post">
                <div class="row">
            
            <?php foreach($object as $db_photo): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-image">
                        <a href="assets/img/user_post/<?php echo $db_photo['post_photo'];  ?>" data-lightbox="mygallary"><img src="assets/img/user_post/<?php echo $db_photo['post_photo'];  ?>"></a>
                    </div>
                    <a class="logout mt-1 mb-1 w-25" href="delete.php?id=<?php echo $db_photo['post_photo']; ?>"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
            <?php endforeach; ?>     
            </div>
              

            
            









            <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST" enctype='multipart/form-data'>
      <div class="modal-body">
      <input type="file" name="user_post" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <input class="btn btn-outline-warning btn-sm" type="submit" name="upload_photo">
      </div>
      </form>
    </div>
  </div>
</div>











             <div class="upload-btn-wrapper" type="button" data-toggle="modal" data-target="#exampleModal">
             <button class="upload-btn"><i class="fas fa-cloud-upload-alt"></i></button>
             </div>

 
</div>

   
</main>


    <!-- ========================= FOOTER START ========================= -->
	<footer class="section-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="first-row text-light">
						<div class="container"> <span class=" main-footer-logo mb-3 "><a href="index.html"><img src="assets/img/logo/ultra-shots-white.png" alt=""></a></span>
							<p class="mt-3 text-left text-light">Some short text about company like You might remember the Dell computer commercials in which a youth reports this exciting news to his friends.</p>
							<div class="mb-3 text-left"> <a class="social-icon social-icon1 " title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a> <a class="social-icon social-icon1" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram"></i></a> <a class="social-icon social-icon1" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter"></i></a> </div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="second-row text-light">
						<h6 class="sr-title text-left ">About</h6>
						<ul class="list-unstyled text-left">
							<li> <a href="#">About us</a></li>
							<li> <a href="#">Services</a></li>
							<li> <a href="#">Rules and terms</a></li>
							<li> <a href="#">Blogs</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
                    


					<div class="third-row text-light">
						<h6 class="tr-title text-light">For users</h6>
						<ul class="list-unstyled text-left">
							<li> <a href="#"> User Login </a></li>
							<li> <a href="#"> User register </a></li>
							<li> <a href="#"> Account Setting </a></li>
							<li> <a href="#"> My Orders </a></li>
							<li> <a href="#"> My Wishlist </a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="third-row text-light">
						<h6 class="tr-title text-light">For users</h6>
						<ul class="list-unstyled text-left">
							<li> <a href="#"> User Login </a></li>
							<li> <a href="#"> User register </a></li>
							<li> <a href="#"> Account Setting </a></li>
							<li> <a href="#"> My Orders </a></li>
							<li> <a href="#"> My Wishlist </a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="fifth-row">
						<h6 class="title text-left">Our app</h6>
						<a href="#" class="d-block mb-2 text-left"><img src="assets/img/misc/appstore.png" height="40"></a>
						<a href="#" class="d-block mb-2 text-left"><img src="assets/img/misc/playmarket.png" height="40"></a>
					</div>
				</div>
			<hr>
			<section class="container footer-copyright">
				<p id="reserve" class="float-left text-muted">All Right Reserved</p>
				<p target="_blank" class="float-right text-muted"> Made with by Team **** <i class="fas fa-heart"></i> by Team **** </p>
			</section>
		</div>
	</footer>
	<!-- ========================= FOOTER END // ========================= -->
	<!-- =========================Mobile FOOTER ========================= -->
	<footer class="mobile-footer">
		<div class="container"> <span class=" footer-logo mb-3 "><a href="index.html"><img src="assets/img/logo/ultra-shots-white.png" alt=""></a></span>
			<div class="social-part mb-2"> <a class="social-icon social-icon1 " title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a> <a class="social-icon social-icon1" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram"></i></a> <a class="social-icon social-icon1" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter"></i></a> </div>
		</div>
		<hr>
		<section class="container footer-copyright">
			<p id="reserve" class="text-muted">All Right Reserved</p>
			<p target="_blank" class="text-muted"> Made with by Team **** <i class="fas fa-heart"><br></i> by Team **** </p>
		</section>
	</footer>
	<!-- =========================Mobile FOOTER END // ========================= -->



    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script>
        $('#search').click(function(){
            $('#search-box').toggle();
        });
    </script>





















<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>