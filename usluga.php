<?php
require_once('config/conf_shop.php');
require_once('application/core.php');
require_once('application/payments.php');
if($shop_enable != true){
	header("Location: ".$core->webUrl);
	exit();
}
$usluga = $payments->getById(@$_GET['id']);
if(!is_array($usluga)){
	header("Location: ".$core->webUrl);
	exit();
}
$core->top();
?>
<div id="error" class="alert alert-warning alert-danger fade show alert-fix fix-bottom hidden" role="alert">
	<div class="container">
		<p id="error_html">hide</p>
	</div>
</div>
<div id="success" class="alert alert-success alert-success fade show alert-fix fix-bottom hidden" role="alert">
	<div class="container">
		<p id="success_html">hide</p>
	</div>
</div>
<div class="container">
	<div class="title-heading1">
		<h3>Usługa - <?php echo $usluga['name']; ?></h3>
	</div>

<div class="row" style="transform: none;">
	<div class="col-lg-3 mb40 sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
		<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 76.5px; top: 0px;"><div class="mb40">
			<img class="card-img-top img-fluid" src="<?php echo $usluga['image']; ?>">
			<h3 class="card-title text-center">
				<?php echo $usluga['name']; ?>
			</h3>
			<h5 class="text-center"><i class="fa fa-mobile-phone"></i> SMS: <?php echo $payments->getCost($usluga['number']); ?>zł | brutto (z VAT)</h5>
			<h6 class="text-center">Wyślij SMS o treści <strong><?php echo $usluga['content_sms']; ?></strong> na numer <strong><?php echo $usluga['number']; ?></strong></h6>
			<hr>
			<div class="input-group input-group-lg">
				<span class="input-group-btn">
                    <button class="btn btn-dark" type="submit"><i class="fa fa-user"></i></button>
				</span>
                <input id="nickname" class="form-control required" placeholder="Nick z gry">
            </div>

			<div class="input-group input-group-lg" style="top:7px;">
				<span class="input-group-btn">
                    <button class="btn btn-dark" type="submit"><i class="fa fa-code"></i></button>
				</span>
                <input id="smscode"  class="form-control required" placeholder="Kod z SMSa">
            </div>
			<input id="uid_payment" value="<?php echo $usluga['id']; ?>" hidden="true">
			<div class="text-center">
				<button style="top:14px;" id="kup_teraz" type="submit" class="btn btn-outline-dark"><i class="fa fa-shopping-cart"></i> Kup teraz</button>
			</div>
		</div>
		<div class="resize-sensor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
			<div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
				<div style="position: absolute; left: 0px; top: 0px; transition: 0s; width: 550px; height: 89px;">
				</div>
			</div>
			<div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
				<div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="col-lg-9 sticky-content" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
		<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
			<div class="row">
				<div class="col">
					<h3 class="mb30">Dodatkowe informacje</h3>
					<p><?php echo $payments->format($usluga['description']); ?></p>
					<?php
					if($payments->operator == "homepay"){
					?>
					<hr>
					<p>
						Płatności zapewnia firma <a class="link-reverse" href="http://homepay.pl/">Homepay</a>.
						Korzystanie z serwisu jest jednozanczne z akceptacją
						<a class="link-reverse" href="http://homepay.pl/regulamin">regulaminów</a>.
						Jeśli minęło 30 minut od dokonania płatności i nie otrzymali Państwo
						wiadomości potwierdzającej płatność, prosimy o skorzystanie
						z <a href="https://homepay.pl/reklamacje" target="_blank">formularza reklamacji</a>.
					</p>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<?php
$core->footer();
?>
