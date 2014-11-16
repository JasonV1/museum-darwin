<?php
//$backgrounds = array(
//    'pdfbg1.jpg',
//    'pdfbg2.jpg',
//    'pdfbg3.jpg');
//
//$todaysBackground = strtotime('today') % count($backgrounds);
?>


<style type="text/css">
    <!--
    body {
        background-position: center center;

        /* Background image doesn't tile */
        background-repeat: no-repeat;

        /* Background image is fixed in the viewport so that it doesn't move when
           the content's height is greater than the image's height */
        background-attachment: fixed;

        /* This is what makes the background image rescale based
           on the container's size */
        background-size: cover;

        /* Set a background color that will be displayed
           while the background image is loading */
        background-color: #464646;
    <?php $dayforbackground=date('N'); ?> <?php if ($dayforbackground==1) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;
    <?php } ?> <?php if ($dayforbackground==2) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;
    <?php } ?> <?php if ($dayforbackground==3) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;
    <?php } ?> <?php if ($dayforbackground==4) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;
    <?php } ?> <?php if ($dayforbackground==5) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg2.jpg') no-repeat center fixed;

    <?php } ?> <?php if ($dayforbackground==6) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;
    <?php } ?> <?php if ($dayforbackground==7) { ?> background-image: url('<?= base_url(); ?>assets/img/pdfbg3.jpg') no-repeat center fixed;

    <?php } ?>

    }

    #pdf td {
        color: #fff !important;
        font-weight: bold;
    }

    #pdf h1 {
        color: #fff;
    }

    -->
</style>
<div id="pdf">
    <h1>Toegangsbewijs Darwin museum</h1>

    <table>
        <?php

        foreach ($query as $row) {
            $originalDate = $row->geboortedatum;
            $newDate = date("d-m-Y", strtotime($originalDate));
            ?>
            <tr>
                <td>Naam</td>
                <td><?php echo $row->voornaam; ?>
                    <?php echo $row->tussenvoegsel; ?>
                    <?php echo $row->achternaam; ?></td>
            </tr>
            <tr>
                <td>Geboortedatum</td>
                <td><?php echo $newDate; ?></td>
            </tr>
            <tr>
                <td>E-mailadres</td>
                <td><?php echo $row->email; ?></td>
            </tr>

            <tr>
                <td>Postcode</td>
                <td><?php echo $row->postcode; ?></td>
            </tr>
            <tr>
                <td>Woonplaats</td>
                <td><?php echo $row->woonplaats; ?></td>
            </tr>
            <tr>
                <td>Prijs</td>
                <td>&euro;<?php echo $row->price; ?></td>
            </tr>
        <?php
        }
        $code = random_string('numeric', 12);
        ?>
    </table>
    <barcode code="<?php echo $code; ?>" type="c39" size="1.0" height="1.0"/>
</div>
