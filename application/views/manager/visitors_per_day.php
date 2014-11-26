<!-- FINAL -->

<table id="tblExport">
    <?php $rows['num_rows'] = count($visitors); ?>
    <tr>
        <td><strong>Aantal bezoekers op deze dag:</strong> <?= $rows['num_rows']; ?></td>
    </tr>
    <tr>
        <th>Naam</th>
        <th>Woonplaats</th>
        <th>Postcode</th>
    </tr>


    <?php foreach ($visitors as $row) {?>

    <tr>
        <td>
            <?php if (empty($row->achternaam)) {
                echo "verkoper ticket";
            }
            else { ?>

                <?php echo $row->voornaam; ?>
                <?php echo $row->tussenvoegsel; ?>
                <?php echo $row->achternaam;  }?>
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