<?php
    // Load post data.

    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check if email is known as an account.
    $check = $pdo->query("SELECT * FROM users WHERE `email`='$email'")->fetch();
    if(!empty($check)) {
        // Check if it is the same password.
        if(password_verify($password, $check['password'])) {
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['userid'] = $check['userid'];

            // If you want to return to the main page
            if(!empty($_POST['returntohome'])) {
                if($_POST['returntohome'] == true) {
                    header('location: /');
                }
            } else {
                // Go to user info page.
                header('location: /user/userinfo/');
            }
        } else {
            // Wrong password. No access.
            $error['bool'] = true;
        $error['type'] = 'WRNGUSRPASS';
        $error['message'] = "Email or Password Wrong, please try again";
        }
    } else {
        // No account yet.
        $error['bool'] = true;
        $error['type'] = 'NOUSR';
        $error['message'] = "No user found, register here <a href='/register/'>now to join!</a>";
    }
