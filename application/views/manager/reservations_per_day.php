<table id="tblExport">
    <tr>
        <th>Naam</th>
        <th>Woonplaats</th>
        <th>Postcode</th>
    </tr>

    <?php foreach ($reservations as $row) {
        ?>
        <tr>
            <td>
                <?php echo $row->voornaam; ?>
                <?php echo $row->tussenvoegsel; ?>
                <?php echo $row->achternaam; ?>
            </td>
            <td>
                <?php echo $row->woonplaats; ?>
            </td>
            <td>
                <?php echo $row->postcode; ?>
            </td>
    <?php
    } ?>
</table>
<button id="btnExport">Export to excel</button>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport", datatype: $datatype.Table
            });
        });
    });
</script>