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
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="/ajax/items/captha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}">
    
    <input type="submit" value="Inloggen">
</form>
<a href="<?=$_SESSION['fullprevpage']?>">Keer terug naar de vorige pagina</a>