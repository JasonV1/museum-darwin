<?php echo validation_errors(); ?>
<?php echo form_open('user/create_user'); ?>
    <div class="box">
        <h1>Create User</h1>
        <label>
            <span>Voornaam</span>
            <input type="text" class="input_text" name="voornaam" id="voornaam"/>
        </label>
        <label>
            <span>Tussenvoegsel</span>
            <input type="text" class="input_text" name="tussenvoegsel" id="tussenvoegsel"/>
        </label>
        <label>
            <span>Achternaam</span>
            <input type="text" class="input_text" name="achternaam" id="achternaam"/>
        </label>
        <label>
            <span>E-mailadres</span>
            <input type="text" class="input_text" name="email" id="email"/>
        </label>
        <label>
            <span>Geboortedatum</span>
            <input type="date" name="geboortedatum" id="geboortedatum"/>
        </label>
        <label>
            <span>Postcode</span>
            <input type="text" class="input_text" name="postcode" id="postcode"/>
        </label>
        <label>
            <span>Woonplaats</span>
            <input type="text" class="input_text" name="woonplaats" id="woonplaats"/>
        </label>
        <label>
            <span>Password</span>
            <input type="password" class="input_text" name="password" id="password"/>
        </label>
        <label>
            <span>Bevestig wachtwoord</span>
            <input type="password" class="input_text" name="con_password" id="con_password"/>
        </label>
        <label>
            <span><input type="submit" class="button" value="Create User" /></span>
        </label>
    </div>
<?php echo form_close(); ?>