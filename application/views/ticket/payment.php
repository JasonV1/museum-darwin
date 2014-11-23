<h1>Betaling aan het Darwin Museum</h1>
<div class="payment_bank">
    <table>
        <tr>
            <strong>Bank</strong>
            <!-- FINAL -->
            <div class="select_styled">
                <select>
                        <option value="rabo">Rabobank</option>
                        <option value="abn">ABN AMRO</option>
                        <option value="ing">ING</option>
                        <option value="sns">SNS Bank</option>
                    </select>

            </div>
            <td>
                <!-- FINAL -->
                <a onclick="open_in_new_tab_and_reload('add_ticket')" href="index">
                    <button>Betalen</button>
                </a>
            </td>
        </tr>

    </table>

</div>
<div class="payment_data">
    <table>
        <tr>
            <!-- FINAL -->
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

<script>
    function open_in_new_tab_and_reload(url)
    {
        //Open in new tab
        window.open(url, '_blank');
        //focus to that window
        window.focus();
        //reload current page
        location.reload();
    }
</script>