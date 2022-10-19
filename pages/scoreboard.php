<?php
    $teams = $pdo->query('SELECT * FROM `teams`')->fetchall();

    $i = 0;
    foreach($teams as $a) {
        $teamid = $a['teamid'];
        $team[$i]['teamid'] = $a['teamid'];
        $team[$i]['teamname'] = $a['teamname'];
        $team[$i]['teamdescription'] = $a['teamdescription'];

        $userteams = $pdo->query("SELECT * FROM `userteams` WHERE `teamid`='$teamid'")->fetchall();

        if(!empty($userteams)) {
            $teamplayer = 0;
            foreach($userteams as $userteam) {
                $userid = $userteam['userid'];
                $user = $pdo->query("SELECT * FROM `userinfo` WHERE `userid`='$userid'")->fetch();
                if(!empty($user)) {
                    $team[$i]['players'][$teamplayer]['name'] = $user['firstname'];
                    $team[$i]['players'][$teamplayer]['goals'] = $userteam['goals'];
                    $team[$i]['players'][$teamplayer]['assists'] = $userteam['assists'];
                    
                    $teamplayer++;
                }
            }
        }
        $i++;
    }

    print_r($team);
?>