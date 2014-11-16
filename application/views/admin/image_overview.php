<table>
    <?php foreach ($query as $row) {
        ?>
        <tr>
            <td>
                <img src='<?= base_url(); ?>assets/img/uploads/<?= $row->bestand; ?>' />
            </td>
        </tr>
        <tr>
            <td>
                <h1><?= $row->title; ?></h1>
                <?= $row->description; ?>
            </td>
            <td>

            </td>
        </tr>

    <?php
    }?>
</table>