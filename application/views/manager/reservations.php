<!-- FINAL -->
<h1>Alle reserveringen</h1>
<table cellspacing="10">
    <form action="get_day_data" method="post">
        <tr>
            <td>Dag</td>
            <td>
                <select name="created_at">
                    <?php foreach ($created_at as $c) { ?>
                        <option value="<?= $c ?>"><?= $c ?></option>
                    <?php
                    } ?>
                </select>
            </td>
            <td ><input type = "submit" name = "submit" value = "Selecteer" ></td >
        </tr >
    </form >
</table >
