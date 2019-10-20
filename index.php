<?php
require_once('application/core.php');
$core->top();

		echo $core->includediv(); ?>
		<div class="container mb50">	
			<div class="title-heading1 mb30">
				<h3>MAPA SERWERA</h3>
            <section id="mapa">
				<div class="title-heading1 mb30">
					<a href="#mapa"> <h3>MAPA SERWERA</h3> </a>
				</div>

				<iframe src="WKLEJ TUTAJ SWOJ LINK DO DYNMAPY" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0" style="position:relative;Left:5.5cm;">Ustaw link w konfiguracji (jeżeli nie jesteś administratorem, możliwe że twoja przeglądarka nie działa prawidłowo)</iframe>
				<div class="title-heading1 mb30">
					<br> <br> <br>
					
					<h3>STATYSTYKI</h3>
				</div>
			</section>
			<div class="row mb30 no-margin">
				<div class="col-sm-5 text-center">
					<h3><span>TOP 10 GRACZY</span></h3>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-5 text-center float-md-right">
					<h3><span>TOP 10 GILDII</span></h3>
				</div>
				<hr>
				<div class="col-sm-5 tabelka black-text">
					<?php
					$sql = "SELECT * FROM users ORDER BY points DESC LIMIT 10";
					$stmt = $core->db->prepare($sql);
					$stmt->execute();
					$top_graczy = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$id = 1;
					foreach($top_graczy as $gracz){
					?>
					<div class="topka tabelka gracz">
						<table>
							<tbody>
								<tr>
									<th style="width:25px;" class="black-text" scope="row"><?php echo $id; ?></th>
									<td class="gracz">
										<a class="black-text" href="<?php echo $core->webUrl; ?>gracz/<?php echo $gracz['name']; ?>">
											<img src="https://minotar.net/avatar/<?php echo $gracz['name']; ?>?size=25">
											<p class="black-text"><?php echo $gracz['name']; ?></p>
										</a>
									</td>
									<p class="pull-right"><?php echo $gracz['points']; ?> pkt</p>
								</tr>
							</tbody>
						</table>
					</div>
					<hr class="white">
					<?php
						$id++;
					}
					for($i=$id;$i<=10;$i++){?>
					<div class="topka tabelka gracz">
						<table>
							<tbody>
								<tr>
									<th style="width:25px;" class="black-text" scope="row"><?php echo $i; ?></th>
									<td class="gracz">
										<a class="black-text" href="#">
											<img src="https://minotar.net/avatar/Steve">
											<p class="black-text">Brak</p>
										</a>
									</td>
									<p class="pull-right">? pkt</p>
								</tr>
							</tbody>
						</table>
					</div>
					<hr class="white">
					<?php
					}
					?>
					<div class="text-center">
						<a href="<?php echo $core->webUrl.'statystyki'; ?>" class="btn btn-outline-primary mb5"><span>+</span> Pokaż więcej</a>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5 tabelka black-text">
					<?php
					$sql = "SELECT * FROM guilds ORDER BY points DESC LIMIT 10";
					$stmt = $core->db->prepare($sql);
					$stmt->execute();
					$top_gildii = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$id2 = 1;
					foreach($top_gildii as $gildia){
					?>
					<div class="topka tabelka gracz">
						<table>
							<tbody>
								<tr>
									<th style="width:25px;" class="black-text" scope="row"><?php echo $id2; ?></th>
									<td class="gracz">
										<a class="black-text" href="<?php echo $core->webUrl; ?>gildia/<?php echo $gildia['tag']; ?>">
											<img src="https://minotar.net/avatar/<?php echo $gildia['owner']; ?>?size=25">
											<p class="black-text">[<?php echo $gildia['tag']; ?>] <?php echo $gildia['name']; ?></p>
										</a>
									</td>
									<p class="pull-right"><?php echo $gildia['points']; ?> pkt</p>
								</tr>
							</tbody>
						</table>
					</div>
					<hr class="white">
					<?php
						$id2++;
					}
					for($i=$id2;$i<=10;$i++){?>
					<div class="topka tabelka gracz">
						<table>
							<tbody>
								<tr>
									<th style="width:25px;" class="black-text" scope="row"><?php echo $i; ?></th>
									<td class="gracz">
										<a class="black-text" href="#">
											<img src="https://minotar.net/avatar/Steve">
											<p class="black-text">Brak</p>
										</a>
									</td>
									<p class="pull-right">? pkt</p>
								</tr>
							</tbody>
						</table>
					</div>
					<hr class="white">
					<?php
					}
					?>
					<div class="text-center">
						<a href="<?php echo $core->webUrl.'statystyki'; ?>" class="btn btn-outline-primary mb5"><span>+</span> Pokaż więcej</a>
					</div>
				</div>
            </div>
        </div>
        <div class="bg-faded pt90 pb90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mr-auto ml-auto">
                        <div class="input-group input-group-lg">
                            <input id="wh" class="form-control required" placeholder="Wyszukaj swój profil lub gildie">
                            <span class="input-group-btn">
                                <button onclick="szukaj();" class="btn btn-dark" type="submit"><i class=" ti-search"></i></button>
							</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
$core->footer();
?>
