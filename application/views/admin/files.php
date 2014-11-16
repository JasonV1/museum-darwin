<a href="upload_photo"><button class="button_new_user">Foto uploaden</button></a>&nbsp;
<a href="upload_video"><button class="button_new_user">Video uploaden</button></a>
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
                <td><a href='<?= base_url(); ?>admin/image_overview/<?= $row->id; ?>'>
                        <button class="button_new_user">Meer info</button>
                    </a></td>
                <td><a href='<?= base_url(); ?>admin/edit_image/<?= $row->id; ?>'>
                        <button class="button_new_user">Wijzigen</button>
                    </a></td>
                <td><a class="delete"
                       onclick="javascript:deleteImage('<?php echo base_url() . 'admin/delete_image/' . $row->id; ?>');"
                       deleteConfirm href="#">
                        <button class="button_new_user">Verwijderen</button>
                    </a></td>
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
                <td><a href='<?= base_url(); ?>admin/video_overview/<?= $row->id; ?>'>
                        <button class="button_new_user">Meer info</button>
                    </a></td>
                <td><a href='<?= base_url(); ?>admin/edit_video/<?= $row->id; ?>'>
                        <button class="button_new_user">Wijzigen</button>
                    </a></td>
            </tr>
            <td><a class="delete"
                   onclick="javascript:deleteVideo('<?php echo base_url() . 'admin/delete_video/' . $row->id; ?>');"
                   deleteConfirm href="#">
                    <button class="button_new_user">Verwijderen</button>
                </a></td>
        <?php
        }?>
    </table>
</div>

<script type="text/javascript">
    function deleteImage(url) {
        if (confirm('Wilt u dit record echt verwijderen?')) {
            window.location.href = url;
        }
    }

    function deleteVideo(url) {
        if (confirm('Wilt u dit record echt verwijderen?')) {
            window.location.href = url;
        }
    }
</script>