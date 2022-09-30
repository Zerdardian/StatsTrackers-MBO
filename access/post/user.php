<?php
if (!empty($_SESSION['user'])) {
    if ($pageitem == 'setteam') {
        $teamid = $_POST['selecteam'];
        $goals = $_POST['goals'];
        $assists = $_POST['assists'];

        if (!empty($teamid) && !empty($goals) && !empty($assists)) {
            $check = $pdo->query("SELECT * FROM teams WHERE `teamid`='$teamid'")->fetch();
            if (!empty($check)) {
                $insert = $pdo->prepare("INSERT INTO `userteams` (`userid`, `teamid`, `goals`, `assists`) VALUES ('$userid', '$teamid', '$goals', '$assists')");
                if ($insert->execute()) {
                    header('location: /user/userinfo/');
                } else {
                    header('location: /user/userinfo/?error=dberr');
                }
            } else {
                header('location: /user/userinfo/?error=noknownteam');
            }
        } else {
            header('location: /user/userinfo/?error=fillteamvalues');
        }
    }
}
