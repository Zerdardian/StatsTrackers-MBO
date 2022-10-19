<?php
if (empty($_GET['userid'])) {
    header('location: /user/admin/main/');
}

$userid = $_GET['userid'];
$userteam = null;

if (!empty($_GET['addteam']) && !empty($_POST)) {
    $addtoteam = $_POST['addtoteam'];

    if (empty($_POST['addtoteam']) || $_POST['addtoteam'] == '-') {
        echo 'Please select a team';
    } else {
        $team = $pdo->query("SELECT * FROM `userteams` WHERE `userid`='$userid' AND `teamid`='$addtoteam'")->fetch();

        if (empty($team)) {
            $insert = $pdo->prepare("INSERT INTO `userteams` (`userid`, `teamid`, `updatedby`) VALUES ('$userid', '$addtoteam', '" . $_SESSION['userid'] . "')");
            if ($insert->execute()) {
                header('location: /user/admin/edit/?userid=' . $userid);
            }
        }
    }
    print_r($_POST);
}

if (!empty($_GET['removefromteam'])) {
    $teamid = $_GET['removefromteam'];
    echo $_GET['removefromteam'];

    $team = $pdo->query("SELECT * FROM `userteams` WHERE `userid`='$userid' AND `teamid`='$teamid'")->fetch();
    if (!empty($team)) {
        $delete = $pdo->prepare("DELETE FROM `userteams` WHERE `userid`='$userid' AND `teamid`='$teamid'");
        if ($delete->execute()) {
            header('location: /user/admin/edit?userid=' . $userid);
        }
    } else {
        // Niet in het juiste team
        header('location: /user/admin/edit?userid=' . $userid . '&error=noteam');
    }
}
$user = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname, userinfo.permissions FROM `users` INNER JOIN `userinfo` WHERE userinfo.userid = '$userid'")->fetch();
$teams = $pdo->query("SELECT * FROM `userteams` WHERE `userid`='" . $_GET['userid'] . "'")->fetchall();
$allteams = $pdo->query("SELECT * FROM `teams`")->fetchall();
foreach ($allteams as $team) {
    $userteam[$team['teamid']] = false;
}
?>

<div id="useredit" class="edit" data-userid='<?= $_GET['userid'] ?>'>
    <div id="edituserinfo">
        <div class="firstname">
            <input type="text" name="fname" id="fname" class="edit" value="<?= $user['firstname'] ?>" data-userid="<?= $userid ?>" data-type="firstname">
        </div>
        <div class="lastname">
            <input type="text" name="lname" id="lname" class="edit" value="<?= $user['lastname'] ?>" data-userid="<?= $userid ?>" data-type="lastname">
        </div>
    </div>
    <div id="teams">
        <div class="currentteams">
            <?php
            foreach ($teams as $team) {
                $userteam[$team['teamid']] = true;
                $info = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='" . $team['teamid'] . "'")->fetch();
                $userteam = $pdo->query("SELECT * FROM `userteams` WHERE `teamid`='" . $team['teamid'] . "' AND `userid`='" . $userid . "'")->fetch();
            ?>
                <div class="team" data-teamid="<?= $team['teamid'] ?>">
                    <div class="teaminfo">
                        <div class="teamname">
                            Team naam: <?= $info['teamname'] ?>
                        </div>
                        <div class="description">
                            <?= $info['teamdescription'] ?>
                        </div>
                    </div>
                    <div class="goalsdiv">
                        <div class="goalstext">Goals</div>
                        <input type="number" name="goals" class="goals" id="goals" data-userid="<?= $userid ?>" data-teamid="<?= $team['teamid'] ?>" value=<?= $userteam['goals'] ?>>
                    </div>
                    <div class="assistsdiv">
                        <div class="assiststext">Assists</div>
                        <input type="number" name="assists" class="assists" id="assists" data-userid="<?= $userid ?>" data-teamid="<?= $team['teamid'] ?>" value=<?= $userteam['assists'] ?>>
                    </div>

                    <div class="remove">
                        <a href="/user/admin/edit?userid=<?= $userid ?>&removefromteam=<?= $team['teamid'] ?>">Verwijder van '<?= $info['teamname'] ?>'</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        $i = 0;
        foreach ($allteams as $allteam) {
            $userteam = $pdo->query("SELECT * FROM `userteams` WHERE `teamid`='" . $allteam['teamid'] . "' AND `userid`='" . $userid . "'")->fetch();
            if (empty($userteam)) {

                $addteam[$i]['teamid'] = $allteam['teamid'];
                $addteam[$i]['teamname'] = $allteam['teamname'];
                $i++;
            }
        }

        if (!empty($addteam) || $addteam != null) {
        ?>
            <div class="addteams">
                <form action="/user/admin/edit/?userid=<?= $userid ?>&addteam=true" method="post">
                    <label for="addtoteam">Add user to a team</label>
                    <select name="addtoteam" id="addtoteam">
                        <option value="-">Select a team</option>
                        <?php
                        foreach ($addteam as $team) {
                            print_r($team);
                        ?>
                            <option value="<?= $team['teamid'] ?>"><?= $team['teamname'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" value="Add to team">
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="return" style="margin-top:20px">
    <a href="/user/admin/">Keer terug</a>
</div>