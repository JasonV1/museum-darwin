<a href="new_user"><button class="button_new_user">Nieuwe medewerker</button></a>

<table>
    <tr>
        <th>Naam</th>
        <th>E-mailadres</th>
        <th>Rol</th>
    </tr>
    <?php
    foreach ($user as $row) {
        ?>
        <tr>
            <td><?= $row->naam; ?></td>
            <td><?= $row->email; ?></td>
            <td><?= $row->role_id; ?></td>
            <td><a href="edit_user/<?= $row->id; ?>"><button class="button_new_user">Bewerken</button></a></td>
        </tr>
        <?php
    }
    ?>
</table>

1 = admin<br />
2 = manager<br />
3 = verkoper<br />
4 = educatieve medewerker
