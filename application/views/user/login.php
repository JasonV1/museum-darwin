<h1>Inloggen</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('user/log_in'); ?>
<div class="box">
    <label>E-mailadres</label>
    <input class="textfield"  type="text" tabindex="1" name="email" id="email">
    <label>
        Wachtwoord
    </label>
    <input class="textfield" type="password"  name="password" tabindex="2" id="password">
    <label>
        <input type="submit" value="Login" tabindex="4">
    </label>

</div>
<?php echo form_close(); ?>