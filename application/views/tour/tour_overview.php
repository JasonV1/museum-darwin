<!-- FINAL -->
<table>
    <?php foreach ($query as $row) {
        ?>
        <tr>
            <td>Naam</td>
            <td>
                <?= $row->name; ?>
            </td>
        </tr>
        <tr>
            <td>Beschrijving</td>
            <td><?= $row->description; ?></td>
        </tr>
        <tr>
            <td>Dag</td>
            <td><?= $row->day; ?></td>
        </tr>
        <tr>
            <td>Prijs</td>
            <td>&euro;<?= $row->price; ?></td>
        </tr>
        <tr>
            <td>Aantal plekken</td>
            <td><?= $row->spots; ?></td>
        </tr>
        <?php if ($row->status == 'vol' || $row->status == 'geannuleerd') { ?>
            <td>Reserveren niet meer mogelijk</td>
        <?php } else {
            ?>
            <td><a href="reservate_tour/<?= $row->t_id; ?>">
                    <button>Reserveren</button>
                </a></td>
        <?php } ?>
    <?php
    }?>
</table>