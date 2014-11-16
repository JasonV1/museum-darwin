<?php echo validation_errors(); ?>
<form method="post" action="photo_upload" enctype="multipart/form-data" />

    <table>
        <tr>
            <td>Titel</td>

        </tr>
        <tr>
            <td><input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>"/></td>
        </tr>
        <tr>
            <td>Beschrijving</td>
        </tr>
        <tr>
            <td><textarea id="description" name="description" rows="8" cols="40"></textarea></td>
        </tr>
        <tr>
            <td>Afbeelding</td>
        </tr>
        <tr>
            <td><input type="file" id="image" name="image" size="200" value="<?php echo set_value('image'); ?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="versturen" /></td>
        </tr>
    </table>
</form>