<!-- FINAL -->
<h1>Betaling aan het Darwin Museum</h1>
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
            <td>
                <a href="add_reservation">
                    <button>Betalen</button>
                </a>
            </td>
        </tr>

    </table>

</div>

<div class="payment_data">
    <table>
        <tr>
            <td><strong>Naam</strong></td>
            <td class="second_td">
                <?php echo $this->session->userdata["tour_data"]["voornaam"]; ?>
                <?php echo $this->session->userdata["tour_data"]["tussenvoegsel"]; ?>
                <?php echo $this->session->userdata["tour_data"]["achternaam"]; ?>
            </td>
        </tr>
        <tr>
            <td><strong>Toer</strong></td>
            <td class="second_td">
                <?php echo $this->session->userdata["tour_data"]["tour_name"]; ?>
            </td>
        </tr>
        <tr>
            <td><strong>Toer id</strong></td>
            <td class="second_td">
                <?php echo $this->session->userdata["tour_data"]["tour_id"]; ?>
            </td>
        </tr>
        <tr>
            <td><strong>Prijs</strong></td>
            <td class="second_td">
                &euro;2
            </td>
        </tr>
    </table>
</div>