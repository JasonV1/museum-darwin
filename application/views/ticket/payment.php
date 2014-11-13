<h1>Betaling aan het Darwin Museum</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('booking/add_ticket'); ?>
<div class="payment_bank">
    <table>
        <tr>
            <strong>Bank</strong>
            <div class="select_styled">
                <select>
                        <option value="rabo">Rabobank</option>
                        <option value="abn">ABN AMRO</option>
                        <option value="ing">ING</option>
                        <option value="sns">SNS Bank</option>
                    </select>

            </div>
            <td><input type="submit" name="submit" value="betalen" /></td>
        </tr>

    </table>

</div>
<div class="payment_data">
    <table>
        <tr>
            <td><strong>Naam</strong></td>
            <td class="second_td">
                <?php echo $this->session->userdata["ticket_data"]["voornaam"]; ?>
                <?php echo $this->session->userdata["ticket_data"]["tussenvoegsel"]; ?>
                <?php echo $this->session->userdata["ticket_data"]["achternaam"]; ?>
            </td>
        </tr>
        <tr>
            <td><strong>Leeftijd</strong></td>
            <td class="second_td">
                <?php echo $this->session->userdata["ticket_data"]["age"]->format('%y jaar'); ?>
            </td>
        </tr>
        <tr>
            <td><strong>Prijs</strong></td>
            <td class="second_td">
                &euro;<?php echo $this->session->userdata["ticket_data"]["price"]; ?>
            </td>
        </tr>
    </table>
</div>
<?php echo form_close(); ?>
