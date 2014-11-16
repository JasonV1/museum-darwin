<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/16/2014
 * Time: 2:02 PM
 */
?>
<form method="post" action="<?= base_url();?>admin/video_edit" enctype="multipart/form-data" />
<?php echo validation_errors(); ?>
<table>
    <?php
    foreach ($query as $row) {

        ?>
        <h1>Wijzigen <?= $row->bestand; ?></h1>
        <tr>
            <td><input type="hidden" name="id" value="<?= $row->id; ?>" /></td>
        </tr>
        <tr>
            <td>Titel</td>
            <td><input type="text" name="title" value="<?= $row->title; ?>" /></td>
        </tr>
        <tr>
            <td>Beschrijving</td>
            <td><textarea name="description" rows="8" cols="40"><?= $row->description; ?></textarea></td>
        </tr>
        <tr>
            <td>Bestand</td>
            <td><input type="file" id="video" name="video" size="200" value="<?= $row->bestand; ?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Wijzigen" /></td>
            <td><a href="<?= base_url(); ?>admin/files">Annuleren</a></td>
        </tr>
    <?php
    }
    ?>
</table>
</form>