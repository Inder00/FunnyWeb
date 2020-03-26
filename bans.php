<?php
require_once('application/core.php');

if($core->maxbans == false){
	header("Location: ".$core->webUrl);
	exit();
}

$core->top();
?>
		<div class="container mb50">
			<div class="title-heading1 mb30">
				<h3>ZBANOWANI</h3>
      </div>
			<div class="row mb30 no-margin">
				<div class="col-sm-12">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th>
									<span>Gracz</span>
								</th>
								<th>
									<span>Data bana</span>
								</th>
								<th>
									<span>Wygasa</span>
								</th>
								<th style="min-width:200px;">
									<span>Powód</span>
								</th>
								<th>
									<span>Banujący</span>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * FROM bans ORDER BY time DESC LIMIT 25";
							$stmt = $core->db->prepare($sql);
							$stmt->execute();
							$bany = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$num = count($bany);
							foreach($bany as $ban){
								if(is_array($ban)){

									?>
									<tr>
											<th class="text-nowrap gracz" scope="row"><a href="<?php echo $core->webUrl; ?>gracz/<?php echo $ban['name']; ?>"><img src="https://minotar.net/avatar/<?php echo $ban['name']; ?>/25"> <?php echo $ban['name']; ?></a></th>
											<td><?php echo date("m.d.Y, H:i:s", substr($ban['time'], 0, -3)); ?></td>
											<td>
												<?php
												if($ban['expires'] == 0){
													echo 'Na zawsze';
												} else {
													echo date("m.d.Y, H:i:s", substr($ban['expires'], 0, -3));
												}
												?>
											</td>
											<td><?php echo $ban['reason']; ?></td>
											<th class="gracz" scope="row"><a href="<?php echo $core->webUrl; ?>gracz/<?php echo $ban['banner']; ?>"><img src="https://minotar.net/avatar/<?php echo $ban['banner']; ?>/25"> <?php echo $ban['banner']; ?></a></th>
									</tr>
									<?php

								}

							}
							?>
						</tbody>
					</table>
					<?php
					if($num == 0){
						?><h4 class="text-center">Nie znaleziono rekordów w bazie danych</h4><?php
					}
					?>
        </div>
			</div>
<?php
$core->footer();
?>
