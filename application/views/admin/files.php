<a href="upload_photo">Foto uploaden</a>&nbsp;
<a href="upload_video">Video uploaden</a>
<h1>Foto's </h1>
<div id="files">
    <table>
        <thead>
        <tr>
            <th>Titel</th>
            <th>File</th>
        </tr>
        </thead>
        <?php foreach ($images as $row) {
            ?>
            <tr>
                <td><?= $row->title; ?></td>
                <td><a class="inline" href="<?= base_url(); ?>assets/img/uploads/<?= $row->bestand; ?>">
                        <img src='<?= base_url(); ?>assets/img/uploads/<?= $row->bestand; ?>'/>
                    </a>
                </td>
                <td><a href='<?= base_url(); ?>admin/image_overview/<?= $row->id; ?>'>Meer info</a></td>
                <td><a href='<?= base_url(); ?>admin/edit_image/<?= $row->id; ?>'>Wijzigen</a></td>
            </tr>
            <tr>

            </tr>
        <?php
        }?>
    </table>
</div>

<h1>Video's </h1>
<div id="files">
    <table>
        <thead>
        <tr>
            <th>Titel</th>
            <th>Bestandnaam</th>
        </tr>
        </thead>
        <?php foreach ($videos as $row) {
            ?>
            <tr>
                <td><?= $row->title; ?></td>
                <td><?= $row->bestand; ?></td>
                <td><a href='<?= base_url(); ?>admin/video_overview/<?= $row->id; ?>'>Meer info</a></td>
                <td><a href='<?= base_url(); ?>admin/edit_video/<?= $row->id; ?>'>Wijzigen</a></td>
            </tr>
            <tr>

            </tr>
        <?php
        }?>
    </table>
</div>
