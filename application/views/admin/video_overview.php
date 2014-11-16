<table>
    <?php foreach ($query as $row) {
        ?>
        <tr>
            <td>
                <embed src='<?= base_url(); ?>assets/vid/uploads/<?= $row->bestand; ?>' height="415"
                       width="515"></embed>
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