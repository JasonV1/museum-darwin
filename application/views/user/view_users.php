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
    <?php foreach($user as $row) {

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

<a href="get_pdf">Nou, doe er wat leuks mee</a>