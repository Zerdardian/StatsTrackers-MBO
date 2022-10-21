<?php
if (!empty($id)) {
    // Please don't be empty.
    if (!empty($_SESSION['user'])) {
        // Check item is goals or assists.
        if ($id == 'goals') {
            // Base value.
            $teamid = $goals = null;
            if (!empty($array)) {
                $teamid = $array['teamid'];
                $goals = $array['goals'];

                // Check if team is still known
                $check = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='$teamid'")->fetch();
                if (!empty($check)) {
                    // Updating.
                    $update = $pdo->prepare("UPDATE `userteams` SET `goals`=$goals, `updatedby`='$userid' WHERE `userid`='$userid' AND `teamid`='$teamid'");
                    if ($update->execute()) {
                        $succes['code'] = 200;
                        $succes['type'] = null;
                        $succes['message'] = 'Succesfully changed goals from '.$teamid;

                        echo json_encode($succes);
                    } else {
                        // HOW IS THERE A PDO ERROR MAN.
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

                // Check if team is known
                $check = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='$teamid'")->fetch();
                if (!empty($check)) {
                    // Update the team prediction
                    $update = $pdo->prepare("UPDATE `userteams` SET `assists`=$assists, `updatedby`='$userid' WHERE `userid`='$userid' AND `teamid`='$teamid'");
                    if ($update->execute()) {
                        $succes['code'] = 200;
                        $succes['type'] = null;
                        $succes['message'] = 'Succesfully changed assists from '.$teamid;

                        echo json_encode($succes);
                    } else {
                        // HOW IS THERE A PDO ERROR MAN.
                        echo error('ajax', 'pdoerror');
                    }
                }
            }
        }
    } else {
        // Woopsie dasie, not logged in.
        echo error('ajax', 'notloggedin');
    }
}
