<?php

    include 'db/db.php';
    include 'db/function.php';
    $id = $_GET['id'];
    session_start();
    if(!isset($_SESSION['id']) AND !isset($_SESSION['user1_name']) AND !isset($_SESSION['user_username'])){
          header("location:log-in.php");
        }
    
    if(isset($_GET['logout']) AND $_GET['logout'] == 'user-logout'){
      session_destroy();
      setcookie('user_re_log','',time() - (60*60*24*365));
      header("location:log-in.php");
    }





    $valid[] ='';
    if(isset($_POST['submit'])){

$user_name             = $_POST['user_name'];
$user_username         = $_POST['user_username'];
$user_email             = $_POST['user_email'];
$user_address          = $_POST['user_address'];
$user_bio              = $_POST['user_bio'];


      if(empty($user_name)){
        $valid_name =  "<p class='invailed-msg'>Enter Your Name</p>";
      }
      if(empty($user_username)){
        $valid_username =  "<p class='invailed-msg'>Enter Username</p>";
      }
      if(empty($user_email)){
        $valid_email =  "<p class='invailed-msg'>Enter Your Email</p>";
      }
      if(empty($user_address)){
        $valid_address = "<p class='invailed-msg'>Enter Your Address</p>";
      }
      if(empty($user_bio)){
          $valid_bio = "<p class='invailed-msg'>Enter Your Bio</p>";
      }
 



    

     // form-validation
     // -------------------------------
     if(empty($user_name )  || empty( $user_username) || empty($user_email) || empty($user_address) || empty($user_bio) ){
         $valid[] =  "<p class='alert alert-danger'>All fields are required<button class='close' data-dissmiss='alert'>&times;</button></p>";
         }else{

        
            // Photo validation + Upload DataBase
           // -----------------------------------
            $data = photo_upload($_FILES['user_photo'],'assets/img/user_img/');
            $photo_data = $data['file_name'];

            if ( $data['status'] == 'yes' ) {

                 $sql = "UPDATE user_data  SET user1_name = '$user_name', user_username='$user_username',user_email='$user_email',user_address='$user_address',user_password = '$user_password', user_photo = '$photo_data'  WHERE id = '$id' ";
                 $conn -> query($sql);
                set_msg('Profile updated Successfully');


                header("location: profile.php");
            }
            else{
                $valid[] =  "<p class='alert alert-warning'>Invaild file format<button class='close' data-dissmiss='alert'>&times;</button></p>";
            }                       
     }

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
    <link rel="stylesheet" href="assets/css/registration.css">
    
</head>
<body>
    <main>
        <div class="container">
            <div class="reg">
                <div class="logo">
                <a href="log-in.php"><img src="assets/img/logo/ultra-Shots-black.png" alt=""></a>
                </div>
               
                    <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST" enctype='multipart/form-data'>
                        <div class="card mx-auto mt-5">
                       
                            <div class="card-body">
                                <div class="log-in-name">
                                    <h2>Update Profile</h2>
                                </div>
                                <?php 

						if ( count($valid)>0) {
							foreach ($valid as $v) {
								echo $v;
							}
						}
					
						get_msg();
					?>


                    <?php 

                        
            $sql = "SELECT * FROM user_data WHERE id='$id'";

            $data =  $conn -> query($sql);
            $f_data = $data -> fetch_assoc();
                    
                    
                    ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Username/Email</label> -->
                                            <input class="" type="text" name="user_name" id="" placeholder="Your Name" value= "<?php echo $f_data['user1_name'];  ?>">
                                            
                                        </div>
                                        <small>
                                        <?php 
                                            if (isset($valid_name)) {
                                                echo $valid_name;
                                                }
                                            ?> 
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Username/Email</label> -->
                                            <input class="" type="text" name="user_username" id="" placeholder="Your Username" value= "<?php echo $f_data['user_username'];  ?>">
                                        </div>
                                            <small><?php 
                                            if (isset($valid_username)) {
                                                echo $valid_username;
                                                }
                                            ?> </small>   
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Username/Email</label> -->
                                            <input class="" type="text" name="user_email" id="" placeholder="Your Email" value= "<?php echo $f_data['user_email'];  ?>">
                                        </div>
                                            <?php 
                                            if (isset($valid_email)) {
                                                echo $valid_email;
                                                }
                                            ?>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Username/Email</label> -->
                                            <input class="" type="text" name="user_address" id="" placeholder="Your Address" value= "<?php echo $f_data['user_address'];  ?>">
                                        </div>
                                        <small>
                                        <?php 
                                            if (isset($valid_address)) {
                                                echo $valid_address;
                                                }
                                            ?> 
                                        </small>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control user_bio" name="user_bio" id="exampleFormControlTextarea1" rows="3" placeholder="Bio" value= "<?php echo $f_data['user1_bio'];  ?>"></textarea>
                                        </div>
                                        <small>
                                        <?php 
                                            if (isset($valid_bio)) {
                                                echo $valid_bio;
                                                }
                                            ?> 
                                        </small>
                                    </div>
                                  
                                 
                                <div class="profile-photo mt-2 mb-3 py-1 ">
                                    <input class="form-control" type="file" name="user_photo">
                                </div>
                                
                                <input  class="login-btn login-btn1 d-block" type="submit" value="update" name="submit">
                                <!-- <button>Log In</button> -->
                            
                            
                       
                    </form>
                    
                </div>
                <div class="profile d-block" class="">
                                                
                                <a  href="profile.php">Back to profile</a>
                            
                            </div>
            </div>
        </div>
    </main>


    

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
</body>
</html>