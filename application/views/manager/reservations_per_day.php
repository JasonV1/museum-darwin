<form action="export_excel" method="post"
      onsubmit='$("#datatodisplay").val( $("<div>").append( $("#ReportTable").eq(0).clone() ).html() )'>
    <table>
        <tr>
            <th>Naam</th>
        </tr>

        <?php foreach ($reservations as $row) {
            ?>
            <tr>
                <td>
                    <?php echo $row->voornaam; ?>
                    <?php echo $row->tussenvoegsel; ?>
                    <?php echo $row->achternaam; ?>
                </td>
            </tr>
        <?php
        } ?>
        <tr>
            <td>
                <input type="hidden" id="datatodisplay" name="datatodisplay">
                <input type="submit" value="Export to Excel">
            </td>
        </tr>
    </table>
</form>