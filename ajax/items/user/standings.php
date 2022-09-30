<?php
if (!empty($id)) {
    if (!empty($_SESSION['user'])) {
        if ($id == 'goals') {
            $teamid = $goals = null;
            if (!empty($array)) {
                $teamid = $array['teamid'];
                $goals = $array['goals'];

                $check = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='$teamid'")->fetch();
                if (!empty($check)) {
                    $update = $pdo->prepare("UPDATE `userteams` SET `goals`=$goals WHERE `userid`='$userid' AND `teamid`='$teamid'");
                    if ($update->execute()) {
                        $succes['code'] = 200;
                        $succes['type'] = null;
                        $succes['message'] = 'Succesfully changed goals from '.$teamid;

                        echo json_encode($succes);
                    } else {
                        echo error('ajax', 'pdoerror');
                    }
                }
            }
        }
        if ($id == 'assists') {
            $teamid = $assists = null;
            if (!empty($array)) {
                $teamid = $array['teamid'];
                $assists = $array['assists'];

                $check = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='$teamid'")->fetch();
                if (!empty($check)) {
                    $update = $pdo->prepare("UPDATE `userteams` SET `assists`=$assists WHERE `userid`='$userid' AND `teamid`='$teamid'");
                    if ($update->execute()) {
                        $succes['code'] = 200;
                        $succes['type'] = null;
                        $succes['message'] = 'Succesfully changed assists from '.$teamid;

                        echo json_encode($succes);
                    } else {
                        echo error('ajax', 'pdoerror');
                    }
                }
            }
        }
    } else {
        echo error('ajax', 'notloggedin');
    }
}
