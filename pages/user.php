<?php
if (!empty($_SESSION['user'])) {
    if(empty($item)) {
        header('location: /user/userinfo/');
    }

    if (!empty($item)) {
        include_once "./pages/user/header.php";
        if($item == 'admin') {
            $user = $userinfo = null;
            $user = $pdo->query("SELECT `userid`, `email` FROM `users` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            $userinfo = $pdo->query("SELECT * FROM `userinfo` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            if($userinfo['permissions'] == 3) {
                $teams = $pdo->query("SELECT * FROM `teams`")->fetchall();
                $users = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM users INNER JOIN userinfo WHERE userinfo.userid = users.userid")->fetchall();
                if(!empty($pageitem)) {
                    if(file_exists("./pages/user/admin/$pageitem.php")) {
                        include_once "./pages/user/admin/$pageitem.php";
                    } else {
                        include_once "./pages/error/usererr.php";
                    } 
                } else {
                    include_once "./pages/user/admin/main.php";
                }
            } else {
                header('location: /user/userinfo/?error=nopermission');
            }
            return;
        }

        if (file_exists("./pages/user/$item.php")) {
            $user = $userinfo = null;
            $user = $pdo->query("SELECT `userid`, `email` FROM `users` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            $userinfo = $pdo->query("SELECT * FROM `userinfo` WHERE `userid`='".$_SESSION['user']['userid']."'")->fetch();
            $teams = $pdo->query("SELECT * FROM `userteams` INNER JOIN `teams` WHERE userteams.userid = '$userid' AND userteams.teamid = teams.teamid")->fetchall();
            include_once "./pages/user/$item.php";
        } else {
            include_once "./pages/error/usererr.php";
        }
        return;
    }
} else {
    header("location: /login/?returnto=".$_SESSION['fullpage']);
}
