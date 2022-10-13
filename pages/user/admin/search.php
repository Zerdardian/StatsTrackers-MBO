<?php
    $search = null;
    if(!empty($_GET['q'])) {
        $search = $_GET['q'];
    }
?>

<div class="search">
    <form action="/user/admin/search/" method="get">
        <input type="text" name="q" id="searchbar" placeholder="Zoeken op Email of Naam" value='<?=$search?>'>
        <input type="submit" value="Zoeken">
    </form>
</div>
<div class="result">
    <?php
        $users = $pdo->query("SELECT * FROM userinfo WHERE ``");
    ?>
</div>