<?php 
    

    include 'db/db.php';
    include 'db/function.php';
    include 'vendor/autoload.php';

if (isset($_POST['log_in'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_pass'];



  if(empty($username)){
    $username_valid = "<p class='invailed-msg'>Username/Email Required</p>";
   }
   if(empty($user_password)){
    $pass_valid = "<p class='invailed-msg'>Password Required</p>";
   }

   if(empty($username)||empty($user_password)){
    $valid =  "<p class='invailed-msg'>All fields are required<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";

   }else{
    // Database Username
    $collection=$db->profile;
	$db_user_detail=$collection->findOne(
        ['user_username' => $username],
    );
    $num_docs = $collection->count();

    // $pass=$db->profile;
    // $db_user_pass=$pass->findOne(
    //     ['user_password' => $user_password],
    // );

    // $check_pass = $pass->count();


    if($num_docs > 0){
        if($db_user_detail['user_password'] == $user_password){
            session_start();
            // $_SESSION['id'] = $f_data['id'];
            // $_SESSION['user_name'] = $f_data['user1_name'];
            // $_SESSION['user_email'] = $f_data['user_email'];
            // $_SESSION['user_bio'] = $f_data['user_bio'];
            // $_SESSION['user_username'] = $f_data['user_username'];
            // $_SESSION['user_photo'] = $f_data['user_photo'];
            $_SESSION['id'] = $db_user_detail["_id"] ;
            $_SESSION['user_username'] = $db_user_detail["user_username"] ;
            $_SESSION['user_name'] = $db_user_detail["user_name"];
            $_SESSION['user_photo'] = $db_user_detail["user_photo"];
            $_SESSION['user_address'] = $db_user_detail["user_address"];
            $_SESSION['user_email'] = $db_user_detail["user_email"];
            $_SESSION['user_bio'] = $db_user_detail["user_name"];
            $_SESSION['user_password'] = $db_user_detail["user_password"];
            header("location:profile.php");
        }else{
            $valid =  "<p style ='color:#CC3C39;'>Wrong Password<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
        }
    }else{
        $valid =  "<p style ='color:#CC3C39;'>wrong username<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
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
    <link rel="stylesheet" href="assets/css/log-in.css">
    
</head>
<body>
    <main>
        <div class="container">
            <div class="log-in">
                <div class="logo">
                    <a href="log-in.php"><img src="assets/img/logo/ultra-Shots-black.png" alt=""></a>
                </div>
               
                    <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST">

                        <div class="card mx-auto mt-5">
                        
                            <div class="card-body">
                                <div class="log-in-name">
                                    <h2>Login</h2>
                                </div>
                                <div class="container " style="z-index: 2">
                            <?php

                    if (isset($valid)) {
                        echo $valid;
                    }
                    ?>
                        </div>
                                <div class="user-input">
                                    <div class="form-group">
                                        <!-- <label for="">Username/Email</label> -->
                                    <input class="" type="text" placeholder="username" name="username">
                                    </div>
                                    <?php 

                                    if (isset($username_valid)) {
                                    echo $username_valid;
                                     }

                                    ?>
                                   <!--  <p class="invailed-msg">Invailed Username</p> -->
                                </div>
                                <div class="user-input">
                                    <div class="form-group">
                                        <!-- <label for="">Password</label> -->
                                        <input  class="" type="password" placeholder="password" name="user_pass">
                                    </div>
                                    <?php 

                    if (isset($pass_valid)) {
                        echo $pass_valid;
                    }

                ?>
                                    <!-- <p class="invailed-msg">Invailed Password</p> -->
                                </div>
                                <input  class="login-btn login-btn1 btn-block" type="submit" value="Sign in" name="log_in">
                                <!-- <button>Log In</button> -->
                                <div class="forgot-pass">
                                    <a href="#"><p class="">Forgot Password ?</p></a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="reg-link">
                            <div class="reg-text">
                                <p>Don't have an account? <a href="registration.php">Sign up here!</a></p>
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