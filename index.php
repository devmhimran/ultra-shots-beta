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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" shortcut icon" type="image/x-icon" href="assets/img/logo/favicon-ultra-shots.png">
    <title>Ultra Shots</title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index-style.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- <script>
    $(document).ready(function(){
      $("#search-box").click(function(){
        $("#search").slideToggle();
      });
    });
    </script> -->
    
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
                    <!-- <a class="notification" href="#"><i class="fas fa-bell"></i></a> -->
                    <a href="profile.php"><img class="profile-img" src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>"></a>
                    <a class="logout" id="dropdown" href="?logout=user-logout"><i class="fas fa-sign-out-alt"></i></a>
                    <a class="setting" href="#"><i class="fas fa-cog"></i></a>        
            </div>
        </div>
    </div>
    <!-- ====== NAV BAR END ====== -->
    <hr>

    <div class="container">
        <div class="row">
            <?php 

             $all_photos=$db->post_photo;
             $object=$all_photos->find();
              
            foreach($object as $db_all_photo):
            ?>

                <?php 

                    $post_user_id = $db_all_photo['user_id'];
                    $post_user=$db->profile;
                    $post_obj= $post_user->findOne(
                    ['_id' =>$post_user_id],
                );

                ?>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-image">
                        <a href="assets/img/user_post/<?php echo $db_all_photo['post_photo'];  ?>" data-lightbox="mygallary"><img src="assets/img/user_post/<?php echo $db_all_photo['post_photo'];  ?>"></a>
                    </div>
                    <div class="card-detail">
                        <img src="assets/img/user_img/<?php echo $post_obj['user_photo'];  ?>">
                        <a href="user.php?id=<?php echo $post_obj['user_username'] ?>">
                            <p class="user-name"><?php echo $post_obj['user_name']; ?></p></a>
                       <!--  <div class="react-num-cnt float-right">
                            <a class="react-icon" href="#"><i class="fas fa-heart"></i></a>
                            <p class="react-num text-muted ">20</p>
                        </div> -->
                   
                    </div>
                    </div>
                </div>
            




        <?php endforeach; ?>

           </div>                
        
                </div>
                <!-- ===== 2ND ROW ===== -->
            </div>
        </div>
    </div>

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
</body>
</html>