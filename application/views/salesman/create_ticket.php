<!-- FINAL -->
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
<?php echo form_open('salesman/payment'); ?>
<!-- FINAL -->
<div class="box">
    <h1>Ticket Aanmaken</h1>
    <label>
        <span>Prijs</span>
        <select name="price">
            <option value="gratis">gratis</option>
            <option value="2.5">&euro; 2.50</option>
            <option value="4">&euro; 4.00</option>
        </select>
    </label>
    <label>
        <input type="submit" class="button" value="Ticket aanmaken"/>
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