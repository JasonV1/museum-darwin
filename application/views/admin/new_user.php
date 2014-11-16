<?php echo validation_errors(); ?>
<?php echo form_open('admin/create_user'); ?>
    <div class="box">
        <h1>Create User</h1>
        <label>
            <span>Naam</span>
            <input type="text" class="input_text" name="name" id="name"/>
        </label>
        <label>
            <span>E-mail</span>
            <input type="text" class="input_text" name="email" id="email"/>
        </label>
        <label>
            <span>Wachtwoord</span>
            <input type="password" class="input_text" name="password" id="password"/>
        </label>
        <label>
            <span>Rol</span>
            <select name="role">
                <option value="none" selected="selected">Selecteer rol</option>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Verkoper</option>
                <option value="4">Educatieve medewerker</option>
            </select>
        </label>
        <label>
            <span><input type="submit" class="button" value="Create User" /></span>
        </label>
    </div>
<?php echo form_close(); ?>