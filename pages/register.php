<?php
    $permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

    function generate_string($input, $strength = 10)
    {
      $input_length = strlen($input);
      $random_string = '';
      for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
      }
    
      return $random_string;
    }
    
    $string_length = 6;
    $captcha_string = generate_string($permitted_chars, $string_length);
    $_SESSION['captcha_text'] = $captcha_string;

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
        <label for="fname">Voornaam</label>
        <input type="text" name="fname" id="fname">
    </div>
    <div class="lastname">
        <label for="lname">Achternaam</label>
        <input type="text" name="lname" id="lname">
    </div>
    <div class="email">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="password">
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div class="repassword">
        <label for="repassword">Voer hem opnieuw in.</label>
        <input type="password" name="repassword" id="repassword" required>
    </div>
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="/ajax/items/captha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}">
    <div class="submit">
        <input type="submit" value="Registeren">
    </div>
</form>