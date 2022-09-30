<?php
if (!empty($_SESSION['user'])) {
    if(empty($item)) {
        header('location: /user/userinfo/');
    }

    if (!empty($item)) {
        include_once "./pages/user/header.php";
        if (file_exists("./pages/user/$item.php")) {
            $user = $userinfo = null;
            $user = $pdo->query("SELECT `userid`, `email` FROM `users` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            $userinfo = $pdo->query("SELECT * FROM `userinfo` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            $teams = $pdo->query("SELECT * FROM `userteams` INNER JOIN `teams` WHERE userteams.userid = '$userid' AND userteams.teamid = teams.teamid")->fetchall();
            include_once "./pages/user/$item.php";
        } else {
            include_once "./pages/error/usererr.php";
        }
    }
} else {
    header("location: /login/?returnto=".$_SESSION['fullpage']);
}
