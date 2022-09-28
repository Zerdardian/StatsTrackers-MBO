<?php
    if(!empty($_SESSION['user'])) {
        unset($_SESSION['user']);
        unset($_COOKIE['userid']);
        unset($_COOKIE['username']);
        unset($_COOKIE['useremail']);

        header('location: /');
    }
?>