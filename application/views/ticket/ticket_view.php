<h1>Toegangsbewijs Darwin museum</h1>
<?php $code = random_string('numeric', 12); ?>
<barcode code="<?php echo $code; ?>" type="c39" size="1.0" height="1.0" />
<table>
<?php

foreach ($query as $row) {
?>
    <tr>
        <td>Naam</td>
        <td><?php echo $row->voornaam; ?>
            <?php echo $row->tussenvoegsel; ?>
            <?php echo $row->achternaam; ?></td>
    </tr>
    <tr>
        <td>Geboortedatum</td>
        <td><?php echo $row->geboortedatum; ?></td>
    </tr>
    <tr>
        <td>E-mailadres</td>
        <td><?php echo $row->email; ?></td>
    </tr>

    <tr>
        <td>Postcode</td>
        <td><?php echo $row->postcode; ?></td>
    </tr>
    <tr>
        <td>Woonplaats</td>
        <td><?php echo $row->woonplaats; ?></td>
    </tr>
    <tr>
        <td>Prijs</td>
        <td>&euro;<?php echo $row->price; ?></td>
    </tr>
    <?php
    }

?>
</table>

