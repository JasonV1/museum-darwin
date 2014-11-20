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
                <td><a href="tour_overview"><button>Meer info</button></a></td>
                <td><a href="reservate_tour/<?= $row->t_id; ?>"><button>Reserveren</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>