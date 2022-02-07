<?php

    require("db.php");

    try{
        if(isset($_POST['login'])){
        // get form values
    $email = $_POST['email'];
    $password = $_POST['password'];

    //retreieve table row that matches username
    $sql = "SELECT id,  email, password FROM users WHERE email = '".$email."'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // check if user exists
    if($user !== false){

      // check if password is valid
      $validPassword = password_verify($password, $user['password']);
      if($validPassword){
        // pass user values to next page
        session_start();
        $_SESSION['email'] = $user['email'];

        // check if user is verefied 
          // move to dashboard
        header("Location: dashboard.php");
      }
      else{
        $output = "The entered password is incorrect, please try again.";
      }
    }
    else{
      $output = "This user does not exist, please try again.";
    }

    }
}
    catch(PDOException $e){
        echo $e->getMessage();
      }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Assignment Tracker</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md position-sticky">
        <div class="container-fluid">
            <div class="collapse navbar-collapse order-2" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item" style="border-width: 1px;"><a class="nav-link" href="#" style="border-width: 1px;border-radius: 100%;background: var(--bs-blue);"><i class="fas fa-graduation-cap" style="font-size: 1.5em;color: var(--bs-gray-100);"></i></a></li>
                </ul>
            </div>
            <ul class="navbar-nav text-nowrap d-flex flex-row order-1 order-md-2 mx-md-auto">
                <li class="nav-item"><a class="navbar-brand d-xxl-flex justify-content-xxl-center align-items-xxl-center" href="#" style="font-weight: bold;font-size: 1.5em;text-align: center;">Assignment Tracker</a></li><button data-bs-target="#navcol-1" data-bs-toggle="collapse" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            </ul>
            <div class="order-3 ms-auto order-md-3 navbar-collapse collapse nav-content">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-xxl-flex justify-content-xxl-center"><a class="nav-link" href="#" type="button" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-user d-xxl-flex justify-content-xxl-center align-items-xxl-center" style="font-size: 1.5em;font-weight: bold;"></i>Account</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="d-xxl-flex justify-content-xxl-center" style="margin: 2% 0%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-xxl-flex justify-content-xxl-end"><img class="d-xxl-flex justify-content-xxl-center"></div>
                <div class="col-md-6">
                    <h2 style="font-weight: bold;">Keep on top of your assignments</h2>
                    <p>Assignment Tracker makes easy to follow when your assignments are due and the progress you have made on them.<br><br>Use the form below to sign up or login using the button at the top right:</p>
                    <form><input class="form-control" type="email" inputmode="email" style="border-radius: 10px;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;width: 400px;margin: 2% 0;" placeholder="Email address..."><input class="form-control" type="password" style="width: 400px;border-radius: 10px;border-top-left-radius: 10;margin: 2% 0;" placeholder="Password..."><input class="form-control" type="password" style="width: 400px;border-radius: 10px;border-top-left-radius: 10;margin: 2% 0;" placeholder="Confirm password..."><button class="btn btn-primary d-xxl-flex justify-content-xxl-end" type="button" style="margin: 2% 0;">Register</button></form>
                    <p>Once logged in, simply add your modules and assignments to your account. You can update your progress by selecting each assignment.&nbsp;<br><br>You can log into your account from anywhere using your email and password to ensure that you are always on top of your work.&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal1" style="width: 1421px;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center d-xxl-flex justify-content-xxl-center" style="border-style: none;width: 100%;">
                        <h3 class="modal-title d-xxl-flex justify-content-xxl-center" style="font-weight: bold;width: 100%;">Login</h3><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-xxl-flex justify-content-xxl-center" style="border-style: none;">
                        <form method="POST">
                            <input class="form-control" type="email" style="margin: 2% 0;border-radius: 10px;width: 350px;" placeholder="Email address..." name="email">
                            <input class="form-control" type="password" style="margin: 2% 0;border-radius: 10px;width: 350px;" placeholder="Passsword..." name="password">
                            <button class="btn btn-primary" name="login" type="submit">login</button>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-style: none;"></div>
                </div>
            </div>
        </div>
    </header>
    <footer class="footer-clean" style="background: var(--bs-gray-200);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3 item">
                    <h3>Links</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                    <p class="copyright">Kia Sambrook © 2022</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>