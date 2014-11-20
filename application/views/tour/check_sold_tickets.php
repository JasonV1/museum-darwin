<table cellpadding="5">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Aantal reserveringen</th>
            <th>Status</th>
        </tr>
    </thead>
    <?php foreach ($tours as $row) {
        ?>
        <tr>
            <td><?= $row->name; ?></td>
            <td><?= $row->c; ?></td>
            <td><?= $row->status; ?></td>
        </tr>
    <?php
    }
    ?>
</table>