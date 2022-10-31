<?php
// Creating teams and predictions
if (!empty($_SESSION['user'])) {
    if ($pageitem == 'setteam') {
        // Basic info
        $teamid = $_POST['selecteam'];
        $goals = $_POST['goals'];
        $assists = $_POST['assists'];

        if (!empty($teamid) && !empty($goals) && !empty($assists)) {
            // If team is known
            $check = $pdo->query("SELECT * FROM teams WHERE `teamid`='$teamid'")->fetch();
            if (!empty($check)) {
                // Insert it into your prediction
                $insert = $pdo->prepare("INSERT INTO `userteams` (`userid`, `teamid`, `goals`, `assists`) VALUES ('$userid', '$teamid', '$goals', '$assists')");
                if ($insert->execute()) {
                    header('location: /user/userinfo/');
                } else {
                    // HOW IS THERE A PDO ERROR, IT MUST WORK MAN.
                    header('location: /user/userinfo/?error=dberr');
                }
            } else {
                // Team is not known
                header('location: /user/userinfo/?error=noknownteam');
            }
        } else {
            // Not the right value.
            header('location: /user/userinfo/?error=fillteamvalues');
        }
    }
}
