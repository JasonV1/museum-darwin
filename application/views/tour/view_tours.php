<!-- FINAL -->
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
                <td><?= $row->day; ?>
                    10:00</td>
                <td>&euro;<?= $row->price; ?></td>
                <td><?= $row->spots; ?></td>
                <td><a href="tour_overview/<?= $row->t_id; ?>">
                        <button>Meer info</button>
                    </a></td>
                <?php if ($row->status == 'vol' || $row->status == 'geannuleerd') { ?>
                    <td>Reserveren niet meer mogelijk</td>
                <?php } else {
                    ?>
                    <td><a href="reservate_tour/<?= $row->t_id; ?>">
                            <button>Reserveren</button>
                        </a></td>
                <?php } ?>
            </tr>
        <?php
        }
        ?>
    </table>
</div>