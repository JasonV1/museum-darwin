<h1>Alle foutieve login pogingen</h1>
<table id="tblExport">
    <tr>
        <th>E-mailadres</th>
        <th>Wachtwoord</th>
        <th>Datum</th>
    </tr>

    <?php
    foreach ($logins as $row) {
        ?>

        <tr>
            <td><?= $row->emailadres; ?></td>
            <td><?= $row->wachtwoord; ?></td>
            <td><?= $row->datum; ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<button id="btnExport">Export to excel</button>
<h1>Alle goede login pogingen</h1>
<table id="tblExport2">
    <tr>
        <th>E-mailadres</th>
        <th>Datum</th>
    </tr>

    <?php
    foreach ($login as $row) {
        ?>

        <tr>
            <td><?= $row->emailadres; ?></td>
            <td><?= $row->datum; ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<button id="btnExport2">Export to excel</button>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport", datatype: $datatype.Table
            });
        });
        $("#btnExport2").click(function () {
            $("#tblExport2").btechco_excelexport({
                containerid: "tblExport", datatype: $datatype.Table
            });
        });
    });
</script>