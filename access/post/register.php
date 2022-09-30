<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

if (empty($email) || empty($password) || empty($repassword)) {
    $error['bool'] = true;
    $error['type'] = "FLLVALUES";
    $error['message'] = 'Vul alle velden in voor dat je verder kan';
} else {
    $check = $pdo->query("SELECT * FROM users WHERE `email`='$email'")->fetch();

    if (empty($check)) {
        if ($password == $repassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userid = uniqid('STTS_');

            $insert = $pdo->prepare('INSERT INTO users (`userid`, `email`, `password`) VALUES (:userid, :email, :password)');
            $insert->bindParam(':userid', $userid, PDO::PARAM_STR);
            $insert->bindParam(':email', $email, PDO::PARAM_STR);
            $insert->bindParam(':password', $hash, PDO::PARAM_STR);
            if($insert->execute()) {
                $insert = $pdo->prepare('INSERT INTO userinfo (`userid`) VALUES (:userid)');
                $insert->bindParam(':userid', $userid, PDO::PARAM_STR);
                if($insert->execute()) {
                    $update = $pdo->prepare("UPDATE userinfo SET `firstname`='$fname', `lastname`='$lname' WHERE `userid`='$userid'");
                    if($update->execute()) {
                        header('location: /login/succes/');
                    } else {
                        header('location: /login/succes_half/');
                    }
                }
            }
        } else {
            $error['bool'] = true;
            $error['type'] = "PSSNTVLUE";
            $error['message'] = 'Wachtwoord niet het zelfde, probeer het opnieuw';
        }
    } else {
        $error['bool'] = true;
        $error['type'] = "USRALRKNWN";
        $error['message'] = 'Deze email wordt al gebruikt, probeer het opnieuw';
    }
}
