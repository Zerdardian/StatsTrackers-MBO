<?php
$teams = $pdo->query('SELECT * FROM `teams`')->fetchall();

$i = 0;
foreach ($teams as $a) {
    $teamid = $a['teamid'];
    $team[$i]['teamid'] = $a['teamid'];
    $team[$i]['teamname'] = $a['teamname'];
    $team[$i]['teamdescription'] = $a['teamdescription'];

    $userteams = $pdo->query("SELECT * FROM `userteams` WHERE `teamid`='$teamid'")->fetchall();

    if (!empty($userteams)) {
        $teamplayer = 0;
        foreach ($userteams as $userteam) {
            $userid = $userteam['userid'];
            $user = $pdo->query("SELECT * FROM `userinfo` WHERE `userid`='$userid'")->fetch();
            if (!empty($user)) {
                $team[$i]['players'][$teamplayer]['name'] = $user['firstname'];
                $team[$i]['players'][$teamplayer]['goals'] = $userteam['goals'];
                $team[$i]['players'][$teamplayer]['assists'] = $userteam['assists'];

                $teamplayer++;
            }
        }
    }
    $i++;
}
?>

<div class="teams">
    <div class="allteams">
        <?php
        foreach ($team as $item) {
            $totalgoals = 0;
            $totalassists = 0;
            $players = false;
            $totalplayers = 0;

            if (!empty($item['players'])) {
                $players = true;
                foreach ($item['players'] as $player) {
                    $addgoals = 0;
                    $addassists = 0;

                    if ($player['goals'] == null) {
                        $addgoals = 0;
                    } else {
                        $addgoals = $player['goals'];
                    }
                    if ($player['assists'] == null) {
                        $addassists = 0;
                    } else {
                        $addassists = $player['assists'];
                    }

                    $totalgoals = $totalgoals + $addgoals;
                    $totalassists = $totalassists + $addassists;
                    $totalplayers++;
                }
            }
        ?>
            <div class="team" data-teamid="<?= $item['teamid'] ?>" style="margin-top:20px">
                <div class="items">
                    <div class="item">
                        <div class="total">
                            <div class="title">Totals overal</div>
                            <?php
                            if ($players != false) {
                            ?>
                                <div class="items">
                                    <div class="item goals">
                                        <div class="text">Total Goals</div>
                                        <span class="text"><?= $totalgoals ?></span>
                                    </div>
                                    <div class="item assists">
                                        <div class="text">Total Assists</div>
                                        <span class="text"><?= $totalassists ?></span>
                                    </div>
                                </div>
                            <?php
                            } else {
                                ?>
                                <div class="empty">
                                    Leeg team of te weinig gegevens. Je kunt dit team joinen via de <a href="/user/userinfo/">user info pagina</a>. Lukt het niet? Vraag een admin.
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                    <div class="item">
                        <div class="teaminfo">
                            <div class="title"><?= $item['teamname'] ?></div>
                            <div class="description"><?= $item['teamdescription'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>