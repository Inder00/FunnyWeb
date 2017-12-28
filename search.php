<?php
require_once('application/core.php');
$core->top();
?>
		<div class="container">
			<div class="title-heading1">
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
				<div class="alert alert-warning alert-danger fade show alert-fix fix-bottom" role="alert">
            		<div class="container">
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    		<span aria-hidden="true">×</span>
                		</button>
                		<strong>Błąd: Nie znaleziono frazy!</strong> Nie znaleziono frazy szukanej przez Ciebie. Spróbuj ponownie, sprawdz zbieżność każdej litery oraz liczby!
            		</div>
        		</div>
		<?php
	}
}


?>		<div class="col-md-12">
			<div class="row mb50 no-margin">
                <div class="input-group input-group-lg">
                    <input id="wh" class="form-control required" placeholder="Wyszukaj swój profil lub gildie">
                    <span class="input-group-btn">
                        <button onclick="szukaj();" class="btn btn-dark" type="submit"><i class=" ti-search"></i></button>
					</span>
                </div>
            </div>
        </div>
	</div>
<?php
$core->footer();
?>
