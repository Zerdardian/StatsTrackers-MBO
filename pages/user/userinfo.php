<?php
$selectteams = $pdo->query('SELECT * FROM `teams`')->fetchall();
if (!empty($_GET)) {
    if (!empty($_GET['removeteam'])) {
        $teamid = $_GET['removeteam'];
        $check = $pdo->query("SELECT * FROM `teams` WHERE `teamid`='$teamid'")->fetch();

        if (!empty($check)) {
            $delete = $pdo->prepare("DELETE FROM `userteams` WHERE `userid`='$userid' AND `teamid`='$teamid'");
            if ($delete->execute()) {
                header('location: /user/userinfo/?succes=teamremove');
            } else {
                header('location: /user/userinfo/?error=teamremove');
            }
        } else {
            header('location: /user/userinfo/');
        }
    }
}

?>

<div id="userinfo" class="user userinfo">
    <div class="user">
        <div class="basis">
            <input type="text" name="email" id="email" class='general' value="<?= $user['email'] ?>">
            <input type="text" name="firstname" id="firstname" class='general' value="<?= $userinfo['firstname'] ?>">
            <input type="text" name="lastname" id="lastname" class='general' value="<?= $userinfo['lastname'] ?>">
        </div>
        <div class="teams">
            <?php
            if (empty($teams)) {
                if (!empty($selectteams)) {
            ?>
                    <div class="selecteam">
                        <form action="/user/userinfo/setteam/" method="post">
                            <select name="selecteam" id="selectteam">
                                <option value="-">
                                    <- Select your team ->
                                </option>
                                <?php
                                foreach ($selectteams as $team) {
                                    $teamid = $team['teamid'];
                                    $check = $pdo->query("SELECT teamid FROM `userteams` WHERE `teamid`='$teamid' AND `userid`='$userid'")->fetch();
                                    if (empty($check)) {
                                ?>
                                        <option value="<?= $team['teamid'] ?>">
                                            <?= $team['teamname'] ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select><br>
                            <label for="goals">Give a number of goals</label><br>
                            <input type="number" name="goals" id="goals"><br>
                            <label for="assists">Give a number of assists</label><br>
                            <input type="number" name="assists" id="assists"><br>
                            <input type="submit" value="Submit!">
                        </form>
                    </div>
            <?php
                }
            }
            ?>
            <div class="chosenteams">
                <?php
                if (!empty($teams)) {
                    foreach ($teams as $team) {
                ?>
                        <div class="team" data-teamid='<?= $team['teamid'] ?>'>
                            <div class="teaminfo">
                                <div class="team">
                                    <div class="name"><?= $team['teamname'] ?></div>
                                    <div class="description"><?= $team['teamdescription'] ?></div>
                                </div>
                                <div class="picture"></div>
                            </div>
                            <div class="scores">
                                <div class="goals">
                                    <div class="text">
                                        Goals
                                    </div>
                                    <input type="number" data-teamid="<?= $team['teamid'] ?>" name="<?= $team['teamid'] ?>goals" class='inputgoals' id="<?= $team['teamid'] ?>goals" value=<?= $team['goals'] ?>>
                                </div>
                                <div class="assists">
                                    <div class="text">
                                        Assists
                                    </div>
                                    <input type="number" data-teamid="<?= $team['teamid'] ?>" name="<?= $team['teamid'] ?>assists" class='inputassists' id="<?= $team['teamid'] ?>assists" value=<?= $team['assists'] ?>>
                                </div>
                            </div>
                            <a href="/user/userinfo/?removeteam=<?= $team['teamid'] ?>">
                                Verwijder jezelf van '<?= $team['teamname'] ?>'
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

        </div>
    </div>
</div>