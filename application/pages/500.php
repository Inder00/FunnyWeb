<?php
require_once '../core.php';
?>
<!DOCTYPE html>
<html lang='pl'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <title>Błąd 500</title>    
        <link href='<?php echo $core->webUrl; ?>css/plugins/plugins.css' rel='stylesheet'>
        <link href='<?php echo $core->webUrl; ?>css/style.css' rel='stylesheet'>
    </head>

    <body data-spy='scroll' data-darget='.navbar-seconday'>
        <div id='preloader'>
            <div id='preloader-inner'></div>
        </div>
        <div class='site-overlay'></div>
        <div id='particles' class='fullscreen particle-bg bg-primary'>
            <div class='d-flex align-items-center particle-content error-404-content'>
                 <div class='container'>
                <div class='row'>
                    <div class=' col-md-12'>
                        <h1 class='text-uppercase'>500</h1>
                        <p class="lead">Server Internal Error</p>
                        <a href='<?php echo $core->webUrl; ?>' class='btn btn-lg btn-white-outline'>Strona główna</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <a href='#' class='back-to-top hidden-xs-down' id='back-to-top'><i class='ti-angle-up'></i></a>
        <script type='text/javascript' src='<?php echo $core->webUrl; ?>js/plugins/plugins.js'></script>
		<script type='text/javascript' src='<?php echo $core->webUrl; ?>js/script.js'></script>
    </body>
</html>
