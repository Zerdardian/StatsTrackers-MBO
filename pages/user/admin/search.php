<?php
$search = null;
if (!empty($_GET['q'])) {
    $search = $_GET['q'];
}
?>

<div class="search">
    <form action="/user/admin/search/" method="get">
        <input type="text" name="q" id="searchbar" placeholder="Zoeken op Email of Naam" value='<?= $search ?>'>
        <input type="submit" value="Zoeken">
    </form>
</div>
<div class="result">
    <?php
    $users = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` WHERE users.userid LIKE '$search' OR users.email LIKE '$search' OR userinfo.firstname LIKE '$search'")->fetchall();
    $i = 0;

    foreach($users as $user) {
        $i++;
    }

    if(!empty($users)) {
        ?>
        <div class="found" style="margin-bottom: 20px;">Found <?=$i?> users</div>
        <div class="users">
        <?php
        foreach ($users as $user) {
            ?>
                <div class="user" data-userid='<?= $user['userid'] ?>'>
                    <div class="name">
                        <?= $user['firstname'] ?>
                    </div>
                    <div class="email">
                        <?= $user['email'] ?>
                    </div>
                    <a href="/user/admin/edit/?userid=<?= $user['userid'] ?>">
                        <button>
                            Edit <?= $user['firstname'] ?>
                        </button>
                    </a>
                    <a href="/user/admin/delete/?userid=<?= $user['userid'] ?>">
                        <button>
                            Delete <?= $user['firstname'] ?>
                        </button>
                    </a>
                </div>
            <?php
            }
            ?>
            </div><?php
    } else {
        ?>
        <div class="empty">
            Woops, No users found.
        </div>
        <?php
    }?>
</div>