<?php
require_once('application/core.php');
$core->top();
?>
		<div class="container mb50">
			<div class="title-heading1 mb30">
				<h3>WYSZUKIWANIE</h3>                       
            </div>
<?php
if(isset($_GET['what']) && !empty($_GET['what'])){
	$szukane = $core->search($_GET['what']);
	if($szukane != "not_found"){
		if(isset($szukane['tag'])){
			header("Location: ".$core->webUrl."gildia/".$szukane['tag']);
			exit();
		} else {
			header("Location: ".$core->webUrl."gracz/".$szukane['name']);
			exit();
		}
	} else {
		?>
				<div id="not_found" class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
					</button>
					<strong>Nie znaleziono!</strong> Spróbuj ponownie za chwile.
				</div>
		<?php
	}
}

?>
			<div class="row mb30 no-margin">
                <div class="input-group input-group-lg">
                    <input id="wh" class="form-control required" placeholder="Wyszukaj swój profil lub gildie">
                    <span class="input-group-btn">
                        <button onclick="szukaj();" class="btn btn-dark" type="submit"><i class=" ti-search"></i></button>
					</span>
                </div>
            </div>
        </div>
<?php
$core->footer();
?>