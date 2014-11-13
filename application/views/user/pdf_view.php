<style>
    .barcode {
        margin: 0;
        vertical-align: top;
        color: #000044;
    }
</style>

<h1>PDF Test</h1>
<table cellspacing="10" class="view_users">
    <tr>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>E-mailadres</th>
        <th>Geboortedatum</th>
        <th>Postcode</th>
        <th>Woonplaats</th>
    </tr>


    <?php
    $code = random_string('numeric', 12);

    foreach($user as $row) {

        echo "
        <tr>
            <td>$row->voornaam</td>
            <td>$row->tussenvoegsel</td>
            <td>$row->achternaam</td>
            <td>$row->email</td>
            <td>$row->geboortedatum</td>
            <td>$row->postcode</td>
            <td>$row->woonplaats</td>
        </tr>";
    }
    ?>

</table>

<barcode code="<?php echo $code; ?>" type="isbn" size="1.1" height="0.5" />