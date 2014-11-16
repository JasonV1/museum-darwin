

<div class="prices">
    <h1>Prijzen</h1>
    <table>
        <tr>
            <td>Prijs kind (0 t/m 11 jr):</td>
            <td>Gratis</td>
        </tr>
        <tr>
            <td>Prijs jongeren (12 t/m 17 jr):</td>
            <td>2,50</td>
        </tr>
        <tr>
            <td>Prijs volwassenen (18 t/m 59 jr):</td>
            <td>4,00</td>
        </tr>
        <tr>
            <td>Prijs ouderen (60+):</td>
            <td>2,50</td>
        </tr>
    </table>

</div>
<?php echo validation_errors(); ?>
<?php echo form_open('booking/payment'); ?>

<div class="box">
    <h1>Ticket Bestellen</h1>
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
        <input type='hidden' name='id' id="id" />
    </label>
        <input type="submit" class="button" value="Bestellen" />
    </label>


</div>
<?php echo form_close(); ?>

<!--
<script>
    var currentTime = new Date();
    var picker = new Pikaday({
        field: document.getElementById('geboortedatum'),
        format: 'DD-MM-YYYY',
        minDate: new Date('01-01-1910'),
        maxDate: currentTime,
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>
-->