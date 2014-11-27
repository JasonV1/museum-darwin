<table id="tblExport" class="table table-hover">
    <thead>
    <tr>
        <th>LOG</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($contents as $line) { ?>
        <tr>
            <td><?php echo $line; ?></td>
        </tr>
    <?php } ?>
    </tbody>
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