<?php
require_once('application/core.php');
$core->top();
?>
<div class="container">
	<div class="title-heading1">
		<h3>SKLEP</h3>
	</div>

	<div class="row">
		<?php
		$sql = "SELECT * FROM funnyweb_payments";
		$stmt = $core->db->prepare($sql);
		$stmt->execute();
		$sklep = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$num = count($sklep);
		foreach($sklep as $usluga){
			?>
			<div class="col-md-3">
				<div class="card mb30">
					<img class="card-img-top img-fluid" src="<?php echo $usluga['image']; ?>">
					<div class="card-body">
						<h3 class="card-title text-center">
							<?php echo $usluga['name']; ?>
						</h3>
						<div class="text-center">
							<a href="<?php echo $core->webUrl; ?>sklep/<?php echo $usluga['id']; ?>" class="btn btn-outline-dark mb10"><i class="fa fa-shopping-cart"></i> Kup teraz</a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		if($num == 0){
			?><div class="offset-3"><h3><i class="fa fa-search"></i> Nie znaleziono rekordów w bazie danych</h3></div><?php
		}
		?>
	</div>

</div>
<?php
$core->footer();
?>
