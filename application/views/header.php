<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/style.css' type='text/css'>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/fancybox/source/jquery.fancybox.css"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCwKEmADn_J97zp7jHP5x41LIBeM00ngnE"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.battatech.excelexport.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/fancybox/source/jquery.fancybox.pack.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.battatech.excelexport.js"></script>

        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">
        <title>Darwin Museum</title>
    </head>
    <body>
        <header>
            <!-- FINAL -->
            <img src="<?php echo base_url(); ?>assets/img/logo_en.png" alt="Logo" />
            <!-- FINAL -->
            <img src="<?php echo base_url(); ?>assets/img/sdm_.png" class="sdm" alt="Museum" />
            <nav id='navigation'>
                        <?php $this->load->view('link'); ?>

            </nav>

        </header>
        <!-- FINAL -->
            <div id="sidebar">
                <h1>Openingstijden</h1>
                <p>Het museum is iedere dag van het jaar open behalve maandag en de
                laatste vrijdag van iedere maand.
                Ook op nieuwjaarsdag zijn wij gesloten.
                De reguliere uren zijn van 10 uur 's ochtends tot 6 uur 's avonds</p>
				<?php //$this->load->view('view_tours'); ?>
            </div>

        <div class="container">
            
        