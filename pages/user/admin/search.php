<?php
$search = null;
if (!empty($_GET['q'])) {
    $search = $_GET['q'];
}
?>

<div class="search">
    <form action="/user/admin/search/" method="get">
        <input type="text" name="q" id="searchbar" placeholder="Zoeken op Email of Naam" value='<?= $search ?>'>
        <select name="type" id="type">
            <option value="all">Seach on all users</option>
            <option value="email">Seach by email</option>
            <option value="name">Search by Name</option>
            <option value="userid">Search by Userid</option>
        </select>
        <input type="submit" value="Zoeken">
    </form>
</div>
<div class="result">
    <?php
    if(empty($search)) {
        ?>
        <div class="empty">
            Please insert something in the search. Thank you!
        </div>
        <?php
    } else {
    unset($users);
    if ($_GET['type'] == 'all') {
        $names = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
        WHERE users.userid = userinfo.userid AND userinfo.firstname LIKE '%$search%'")->fetchall();
        $emails = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
        WHERE users.userid = userinfo.userid AND users.email LIKE '%$search%'")->fetchall();
        $userids = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
        WHERE users.userid = userinfo.userid AND users.userid = '$search'")->fetchall();
        $i['name'] = 0;
        foreach ($names as $name) {
            $users['names'][$i['name']]['userid'] = $name['userid'];
            $users['names'][$i['name']]['email'] = $name['email'];
            $users['names'][$i['name']]['firstname'] = $name['firstname'];
            $users['names'][$i['name']]['lastname'] = $name['lastname'];
            $i['name']++;
        }

        $i['emails'] = 0;
        foreach ($emails as $name) {
            $users['emails'][$i['emails']]['userid'] = $name['userid'];
            $users['emails'][$i['emails']]['email'] = $name['email'];
            $users['emails'][$i['emails']]['firstname'] = $name['firstname'];
            $users['emails'][$i['emails']]['lastname'] = $name['lastname'];
            $i['emails']++;
        }

        $i['userids'] = 0;
        foreach ($userids as $name) {
            $users['userids'][$i['userids']]['userid'] = $name['userid'];
            $users['userids'][$i['userids']]['email'] = $name['email'];
            $users['userids'][$i['userids']]['firstname'] = $name['firstname'];
            $users['userids'][$i['userids']]['lastname'] = $name['lastname'];
            $i['userids']++;
        }

        $i = 0;
        foreach ($users as $user) {
            $i++;
        }

        if (!empty($users)) {
            if (!empty($users['emails'])) {
    ?>
                <div class="type">
                    Emails found
                </div>
                <div class="users">
                    <?php
                    foreach ($users['emails'] as $user) {
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
                    Woops, No with emails found.
                </div>
            <?php
                    } ?>
        <?php
        }
        if (!empty($users['names'])) {
        ?>
            <div class="type">Names found</div>
            <div class="users">
                <?php
                foreach ($users['emails'] as $user) {
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
            </div>
        <?php
        } else {
        ?>
            <div class="empty">
                Woops, No users with that name found.
            </div>
        <?php
        }
        if (!empty($users['userids'])) {
        ?>
            <div class="type">
                Userid
            </div>
            <div class="users">
                <?php
                foreach ($users['emails'] as $user) {
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
                Woops, No users found with that userid
            </div>
        <?php
                }
            }

            if ($_GET['type'] == 'email') {
                $emails = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
                WHERE users.userid = userinfo.userid AND users.email LIKE '%$search%'")->fetchall();

                $i['emails'] = 0;
                foreach ($emails as $name) {
                    $users['emails'][$i['emails']]['userid'] = $name['userid'];
                    $users['emails'][$i['emails']]['email'] = $name['email'];
                    $users['emails'][$i['emails']]['firstname'] = $name['firstname'];
                    $users['emails'][$i['emails']]['lastname'] = $name['lastname'];
                    $i['emails']++;
                }

                if (!empty($emails)) {
        ?>
            <div class="users">
                <?php
                    foreach ($users['emails'] as $user) {
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
            </div>
        <?php
                } else {
        ?>
            <div class="empty">No Users found with a email</div>
    <?php
                }
            }

            if ($_GET['type'] == 'name') {
                $names = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
                WHERE users.userid = userinfo.userid AND userinfo.firstname LIKE '%$search%'")->fetchall();

                $i['name'] = 0;
                foreach ($names as $name) {
                    $users['names'][$i['name']]['userid'] = $name['userid'];
                    $users['names'][$i['name']]['email'] = $name['email'];
                    $users['names'][$i['name']]['firstname'] = $name['firstname'];
                    $users['names'][$i['name']]['lastname'] = $name['lastname'];
                    $i['name']++;
                }

                if(!empty($names)) {
                    ?>
                    <div class="users">
                <?php
                    foreach ($users['names'] as $user) {
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
            </div>
                    <?php
                } else {
                    ?>
                    <div class="empty">
                        No users found
                    </div>
                    <?php
                }
            }

            if ($_GET['type'] == 'userid') {
                $userids = $pdo->query("SELECT users.userid, users.email, userinfo.firstname, userinfo.lastname FROM `users` INNER JOIN `userinfo` 
                WHERE users.userid = userinfo.userid AND users.userid = '$search'")->fetchall();
                
                $i['userids'] = 0;
                foreach ($userids as $name) {
                    $users['userids'][$i['userids']]['userid'] = $name['userid'];
                    $users['userids'][$i['userids']]['email'] = $name['email'];
                    $users['userids'][$i['userids']]['firstname'] = $name['firstname'];
                    $users['userids'][$i['userids']]['lastname'] = $name['lastname'];
                    $i['userids']++;
                }

                if(!empty($userids)) {
                     ?>
                     <div class="users">
                <?php
                    foreach ($users['userids'] as $user) {
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
            </div>
                     <?php
                } else {
                    ?>
                    <div class="empty">
                        No users found
                    </div>
                    <?php
                }
            }
        }
    ?>
</div>