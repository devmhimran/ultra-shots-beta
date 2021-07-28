<?php

    include 'db/db.php';
    include 'db/function.php';
    include 'vendor/autoload.php';
    $valid[] ='';
    if(isset($_POST['submit'])){

$user_name             = $_POST['user_name'];
$user_username         = $_POST['user_username'];
$user_email             = $_POST['user_email'];
$user_address          = $_POST['user_address'];
$user_bio              = $_POST['user_bio'];
$user_password         = $_POST['user_password'];
$user_confirm_password = $_POST['user_confirm_password'];
    // $user_photo            = $_POST['user_photo'];
    // $password_hash         = password_hash($user_password, PASSWORD_DEFAULT);
                
     // username check
    // -------------------------------
                    $check=$db->profile;
                    $unique_check = $check->findOne(
                    ['user_username' => $user_username]
                );

                $num_username = $check->count(['user_username' => $user_username]);
                if($num_username > 0){
                    $unique_username_check = false;
                }else{
                    $unique_username_check = true;
                }
     // email check
    // -------------------------------
    //   $unique_email_check =  unique_check($conn,'user_email', 'user_data', $user_email);

     // Confirm Password
    // -------------------------------
      if($user_password  == $user_confirm_password){
        $password_check = true;
      }else{
        $password_check =  false;
      }

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
      if(empty($user_password)){
        $valid_password = "<p class='invailed-msg'>Enter Password</p>";
      }
      if(empty($user_confirm_password)){
        $valid_confirm_password = "<p class='invailed-msg'>Enter Password</p>";
      }

      // if ($unique_username_check == false ) {   
      //           $valid_username =  "<p class='invailed-msg'>Username already exists</p>";
                
                
      //        }
            
    //         if( $unique_email_check == false){
    //             $valid_email =  "<p class='invailed-msg'>Email already exists</p>";
            
    //         }
    //         if( $password_check == false){
    //             $valid_pass =  "<p class='invailed-msg'>Password doesn't match</p>";
    //         }

    

     // form-validation
     // -------------------------------
     if(empty($user_name )  || empty( $user_username) || empty($user_email) || empty($user_address) || empty($user_bio) || empty($user_password)){
         $valid[] =  "<p class='alert alert-danger'>All fields are required<button class='close' data-dissmiss='alert'>&times;</button></p>";
         }elseif ($unique_username_check == false) {
                $valid[] =  "<p class='alert alert-warning'>Couldn't Sign In !<button class='close' data-dissmiss='alert'>&times;</button></p>";
                $valid_username =  "<p>Username already exits</p>";
            }
        elseif ($password_check == false) {
            $valid[] =  "<p class='alert alert-warning'>Couldn't Sign In !<button class='close' data-dissmiss='alert'>&times;</button></p>";
            $valid_pass =  "<p>Password doesn't match</p>";
            }else{

        
            // Photo validation + Upload DataBase
           // -----------------------------------
            $data = photo_upload($_FILES['user_photo'],'assets/img/user_img/');
            $photo_data = $data['file_name'];

            if ( $data['status'] == 'yes' ) {

                //  $sql = " INSERT INTO user_data ( user1_name ,user_username,user_email,user_address,user_bio,user_password,user_photo) values ('$user_name ','$user_username','$user_email','$user_address','$user_bio','$user_password','$photo_data')";
                //  $conn -> query($sql);
                $collection=$db->profile; //Here, data is the name of table and $db is variable of selected database.

				//Now, Creating a array document which will be inserted in database.


                $insertOneResult =  $collection->insertOne(
                    [
                        "user_name"=>$user_name,
                        "user_username"=>$user_username,
                        "user_email"=>$user_email,
                        "user_address"=>$user_address,
                        "user_bio"=>$user_bio,
                        "user_password"=>$user_password,
                        "user_photo"=>$photo_data
                    ]
                );


				// $document=array(
				// 	"user_name"=>$user_name,
				// 	"user_username"=>$user_username,
				// 	"user_email"=>$user_email,
                //     "user_address"=>$user_address,
                //     "user_bio"=>$user_bio,
                //     "user_password"=>$user_password,
				// 	"user_photo"=>$photo_data);

				//Now, Insert this document into database using insert function of collection object.

				$insertOneResult->getInsertedCount();
                set_msg('Successfully Sign Up');


                header("location: registration.php");
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
                                    <h2>Registration</h2>
                                </div>
                                <?php 

						if ( count($valid)>0) {
							foreach ($valid as $v) {
								echo $v;
							}
						}
					
						get_msg();
					?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Username/Email</label> -->
                                            <input class="" type="text" name="user_name" id="" placeholder="Your Name" value= "<?php old('user_name') ?>">
                                            
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
                                            <input class="" type="text" name="user_username" id="" placeholder="Your Username" value= "<?php old('user_username') ?>">
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
                                            <input class="" type="text" name="user_email" id="" placeholder="Your Email" value= "<?php old('user_email') ?>">
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
                                            <input class="" type="text" name="user_address" id="" placeholder="Your Address" value= "<?php old('user_address') ?>">
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
                                            <textarea class="form-control user_bio" name="user_bio" id="exampleFormControlTextarea1" rows="3" placeholder="Bio" value= "<?php old('user_bio') ?>"></textarea>
                                        </div>
                                        <small>
                                        <?php 
                                            if (isset($valid_bio)) {
                                                echo $valid_bio;
                                                }
                                            ?> 
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Password</label> -->
                                            <input  class="" type="password" name="user_password" id="" placeholder="Password">
                                        </div>
                                        <small>
                                            <?php 
                                                if (isset($valid_pass)) {
                                                echo $valid_pass;
                                                }
                                            ?> 
                                        </small>
                                        <small>
                                            <?php 
                                                if (isset($valid_password)) {
                                                echo $valid_password;
                                                }
                                            ?>   
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="">Password</label> -->
                                            <input  class="" type="password" name="user_confirm_password" id="" placeholder="Re-type Password">
                                        </div>
                                        <small>
                                            <?php 
                                                if (isset($valid_confirm_password)) {
                                                echo $valid_confirm_password;
                                                }
                                            ?>   
                                        </small>
                                    </div>
                                </div>
                                <div class="profile-photo mt-2 mb-3 py-1">
                                    <input class="form-control" type="file" name="user_photo">
                                </div>
                                
                                <input  class="login-btn login-btn1" type="submit" value="Sign in" name="submit">
                                <!-- <button>Log In</button> -->
                                <div class="reg-link">
                            <div class="reg-text mt-3">
                                <p>Let's <a href="log-in.php">Sign in</a></p>
                            </d
                            </div>
                            
                        </div>
            
                       
                    </form>
                </div>
            </div>
        </div>
    </main>


    

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
</body>
</html>