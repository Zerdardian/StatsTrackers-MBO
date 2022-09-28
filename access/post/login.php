<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $pdo->query("SELECT * FROM users WHERE `email`='$email'")->fetch();
    if(!empty($check)) {
        if(password_verify($password, $check['password'])) {
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['userid'] = $check['userid'];

            if(!empty($_POST['returntohome'])) {
                if($_POST['returntohome'] == true) {
                    header('location: /');
                }
            } else {
                header('location: /user/userinfo/');
            }
        } else {
            $error['bool'] = true;
        $error['type'] = 'WRNGUSRPASS';
        $error['message'] = "Email or Password Wrong, please try again";
        }
    } else {
        $error['bool'] = true;
        $error['type'] = 'NOUSR';
        $error['message'] = "No user found, register here <a href='/register/'>now to join!</a>";
    }
?>