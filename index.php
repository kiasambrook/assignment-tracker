<?php

    require("Model/db.php");

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
    <?php include 'View/head.php'; ?>
    <?php include 'View/nav.php'; ?>
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
    
<?php include 'View/footer.php'?>