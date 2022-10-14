<div class="search">
    <form action="/user/admin/search/" method="get">
        <input type="text" name="q" id="searchbar" placeholder="Zoeken op Email of Naam">
        <input type="submit" value="Zoeken">
    </form>
</div>

<div class="users">
    <div class="title">
        Alle users
    </div>
    <div class="items">
    <?php
    foreach ($users as $user) {
    ?>
        <div class="user" data-userid='<?= $user['userid'] ?>'>
                <div class="name">
                    <?= $user['firstname']?>
                </div>
                <div class="email">
                    <?= $user['email']?>
                </div>
                <a href="/user/admin/edit/?userid=<?= $user['userid'] ?>">
                    <button>
                        Edit <?= $user['firstname']?>
                    </button>
                </a>
                <a href="/user/admin/delete/?userid=<?= $user['userid']?>">
                    <button>
                    Delete <?=$user['firstname']?>
                    </button>    
                </a>
            </div>
    <?php
    }
    ?>
    </div>
</div>