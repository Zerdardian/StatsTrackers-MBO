<?php
    if(!empty($error)) {
        if($error['bool'] == true) {
            ?>
            <div class="error" id="<?=$error['type']?>">
                <?=$error['message']?>
            </div>
            <?php
        }
    }
?>

<form action="/register/" method="post">
    <div class="firstname">
        <input type="text" name="fname" id="fname">
    </div>
    <div class="lastname">
        <input type="text" name="lname" id="lname">
    </div>
    <div class="email">
        <input type="email" name="email" id="email" required>
    </div>
    <div class="password">
        <input type="password" name="password" id="password" required>
    </div>
    <div class="repassword">
        <input type="password" name="repassword" id="repassword" required>
    </div>
    <div class="submit">
        <input type="submit" value="Registeren">
    </div>
</form>