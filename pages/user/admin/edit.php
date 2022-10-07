<?php
    if(empty($_GET['userid'])) {
        header('location: /user/admin/main/');
    }
    $userid = $_GET['userid'];
    $user = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname, userinfo.permissions FROM `users` INNER JOIN `userinfo` WHERE userinfo.userid = '$userid'")->fetch();
    $teams = $pdo->query("SELECT * FROM `userteams` WHERE `userid`='".$_GET['userid']."'")->fetchall();
?>

<div id="useredit" class="edit" data-userid='<?=$_GET['userid']?>'>
    <div id="edituserinfo">
        <div class="firstname">
            <input type="text" name="fname" id="fname" class="edit" value="<?=$user['firstname']?>">
        </div>
        <div class="lastname">
            <input type="text" name="lname" id="lname" class="edit" value="<?=$user['lastname']?>">
        </div>
    </div>
    <div id="teams">
        <?php
            print_r($teams);
        ?>
    </div>
</div>