<div class="tours">
    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>Dag en Tijd</th>
            <th>Prijs</th>
            <th>Totaal aantal plekken</th>
        </tr>
        </thead>
        <?php
        foreach ($tours as $row) {
            ?>
            <tr>
                <td><?= $row->name; ?> (<?= $row->status; ?>)</td>
                <td><?= $row->day; ?></td>
                <td>&euro;<?= $row->price; ?></td>
                <td><?= $row->spots; ?></td>
                <td><a href="cancel_tour/<?= $row->t_id; ?>"><button>Annuleren</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>