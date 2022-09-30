<?php
    if(!empty($_SESSION['user'])) {
        header('location: /user/');
    }

    if(!empty($error)) {
        ?>
        <div class="error" data-errorid="<?=$error['type']?>">
            <?=$error['message']?>
        </div>
        <?php
    }
?>
<form action="<?=$fulllink?>" method="post">
    <input type="text" name="email" id="email" required>
    <input type="password" name="password" id="password" required>
    <input type="checkbox" name="returntohome" id="returntohome"> Terug keren naar de hoofd pagina?
    <input type="submit" value="Inloggen">
</form>
<a href="<?=$_SESSION['fullprevpage']?>">Keer terug naar de vorige pagina</a>