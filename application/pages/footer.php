<?php
if(!defined("IN_SCRIPT")){ exit(include('403.php')); }
global $core;
ob_end_flush();
?>
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <script type="text/javascript" src="<?php echo $core->webUrl; ?>js/plugins/plugins.js"></script>
		<script type="text/javascript" src="<?php echo $core->webUrl; ?>js/script.js"></script>
        <script>function szukaj(){var t = $("#wh").val();location.href="<?php echo $core->webUrl; ?>szukaj/"+t;}</script>
    </body>
</html>
