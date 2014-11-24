<?php echo validation_errors(); ?>
<?php echo form_open('salesman/payment'); ?>
<!-- FINAL -->
<div class="box">
    <h1>Ticket Aanmaken</h1>
    <label>
        <span>Prijs</span>
        <select name="price">
            <option name="2.5">&euro; 2.50</option>
            <option name="4">&euro; 4.00</option>
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