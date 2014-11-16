<?php
echo validation_errors();
echo form_open('admin/user_edit');
foreach ($user as $row) {
    ?>
    <h1>Bewerken <?= $row->naam; ?></h1>

    <table>
        <tr>
            <td><input type="hidden" name="id" value="<?= $row->id; ?>" /></td>
        </tr>
        <tr>
            <td>Naam</td>
            <td><input type="text" name="name" value="<?= $row->naam; ?>" /></td>
        </tr>
        <tr>
            <td>E-mailadres</td>
            <td><input type="text" name="email" value="<?= $row->email; ?>" /></td>
        </tr>
        <tr>
            <td>Wachtwoord</td>
            <td><input type="password" name="password" value="<?= $row->password; ?>" /></td>
        </tr>
        <td>Rol</td>
        <td>
            <select name="role">
                <option value="none" selected="selected">Selecteer rol</option>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Verkoper</option>
                <option value="4">Educatieve medewerker</option>
            </select>
        </td>
        <tr>
            <td><input type="submit" value="Wijzigen" /></td>
            <td><a href="<?= base_url(); ?>admin/users">Annuleren</a></td>
        </tr>
    </table>
<?php
}
echo form_close();