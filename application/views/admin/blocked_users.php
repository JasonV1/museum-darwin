<table>
    <tr>
        <th>E-mailadres</th>
        <th>Naam</th>

    </tr>
</table>
<?php
foreach ($users as $row) {
    ?>
    <tr>
        <td><?= $row->email; ?></td>
        <td><?= $row->naam; ?></td>
        <td><a href="unblock_user/<?= $row->id; ?>">Unblock</a></td>
    </tr>
<?php
}