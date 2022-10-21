<?php
// Load post data first.

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$captha = $_POST['captcha_challenge'];
if(!empty($captha) && $captha == $_SESSION['captcha_text']){
if (empty($email) || empty($password) || empty($repassword)) {
    // Values not all filled in.
    $error['bool'] = true;
    $error['type'] = "FLLVALUES";
    $error['message'] = 'Vul alle velden in voor dat je verder kan';
} else {
    // Check if empty
    $check = $pdo->query("SELECT * FROM users WHERE `email`='$email'")->fetch();

    if (empty($check)) {
        // Check if same password
        if ($password == $repassword) {

            // Hasing and making a userid
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userid = uniqid('STTS_');

            // Inserting into the user table
            $insert = $pdo->prepare('INSERT INTO users (`userid`, `email`, `password`) VALUES (:userid, :email, :password)');
            $insert->bindParam(':userid', $userid, PDO::PARAM_STR);
            $insert->bindParam(':email', $email, PDO::PARAM_STR);
            $insert->bindParam(':password', $hash, PDO::PARAM_STR);
            if($insert->execute()) {
                // Creating userinfo
                $insert = $pdo->prepare('INSERT INTO userinfo (`userid`) VALUES (:userid)');
                $insert->bindParam(':userid', $userid, PDO::PARAM_STR);
                if($insert->execute()) {
                    // Inserting main name and lastname
                    $update = $pdo->prepare("UPDATE userinfo SET `firstname`='$fname', `lastname`='$lname' WHERE `userid`='$userid'");
                    if($update->execute()) {
                        header('location: /login/succes/');
                    } else {
                        header('location: /login/succes_half/');
                    }
                }
            }
        } else {
            // Password not the same
            $error['bool'] = true;
            $error['type'] = "PSSNTVLUE";
            $error['message'] = 'Wachtwoord niet het zelfde, probeer het opnieuw';
        }
    } else {
        // Email already known to an account.
        $error['bool'] = true;
        $error['type'] = "USRALRKNWN";
        $error['message'] = 'Deze email wordt al gebruikt, probeer het opnieuw';
    }
}
}