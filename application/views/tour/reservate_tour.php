<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/17/2014
 * Time: 1:29 PM
 */

echo validation_errors();
echo form_open('tour/payment');
?>
<!-- FINAL -->
<table>
    <?php
    foreach ($tours as $row) {
        ?>
        <h1>Reservering maken voor <?= $row->name; ?></h1>
        <div class="box">

            <label>
                <span>Voornaam</span>
                <input type="text" class="input_text" name="voornaam" id="voornaam"/>
            </label>
            <label>
                <span>Tussenvoegsel</span>
                <input type="text" class="input_text" name="tussenvoegsel" id="tussenvoegsel"/>
            </label>
            <label>
                <span>Achternaam</span>
                <input type="text" class="input_text" name="achternaam" id="achternaam"/>
            </label>
            <label>
                <span>E-mailadres</span>
                <input type="text" class="input_text" name="email" id="email"/>
            </label>
            <label>
                <span>Geboortedatum</span>
                <input type="date" id="geboortedatum" name="geboortedatum" />
            </label>
            <label>
                <span>Postcode</span>
                <input type="text" class="input_text" name="postcode" id="postcode"/>
            </label>
            <label>
                <span>Woonplaats</span>
                <input type="text" class="input_text" name="woonplaats" id="woonplaats"/>
                <label>
                    <input type='hidden' name='tour_id' id="tour_id" value="<?= $row->t_id; ?>" />
                </label>
                <label>
                    <input type='hidden' name='tour_name' id="tour_name" value="<?= $row->name; ?>" />
                </label>
                <input type="submit" class="button" value="Reserveren" />
            </label>


        </div>
    <?php
    }
    ?>
</table>
<?php
echo form_close();
?>
