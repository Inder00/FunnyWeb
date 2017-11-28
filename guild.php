<?php
require_once('application/core.php');
ob_start();
if(isset($_GET['name']) && !empty($_GET['name'])){
	$g = $core->searchGuild($_GET['name']);
	if(!is_array($g)){
		header("Location: ".$core->webUrl);
		exit();
	}
} else {
	header("Location: ".$core->webUrl);
	exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $core->webName.' - '.$core->webDescription; ?></title>
        <link href="<?php echo $core->webUrl; ?>css/plugins/plugins.css" rel="stylesheet">
        <link href="<?php echo $core->webUrl; ?>css/style.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/png" href="<?php echo $core->favicon; ?>"/>
    </head>

    <body>
        <div id="preloader">
            <div id="preloader-inner"></div>
        </div>
        <div class="site-overlay"></div>

        <nav class="navbar navbar-expand-lg navbar-light navbar-transparent bg-faded">
            <div class="container">

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $core->webUrl; ?>">
					<p class="logo logo-dark visible-md-up  hidden-lg-up logo-text"><?php echo $core->logo; ?></p>
					<p class="logo logo-light hidden-xs-down hidden-sm-down hidden-md-down text-light logo-text"><?php echo $core->logo; ?></p>
				</a>
                <div  id="navbarNavDropdown" class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $core->webUrl; ?>">
                                STRONA GŁÓWNA
                            </a>
						</li>
						<li class="nav-item">
                            <a class="nav-link" href="<?php echo $core->webUrl.'statystyki'; ?>">
                                STATYSTYKI
                            </a>
                        </li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $core->webUrl.'aktualnosci'; ?>">
								AKTUALNOŚCI
							</a>
						</li>
												<?php
                        if($core->maxbans == true){
                          ?>
                          <li class="nav-item">
                                <a class="nav-link" href="<?php echo $core->webUrl.'bany'; ?>">
                                    BANY
                                </a>
                          </li>
                          <?php
                        }
						$sql = "SELECT * FROM funnyweb_pages ORDER BY id DESC";
						$stmt = $core->db->prepare($sql);
						$stmt->execute();
						$strony = $stmt->fetchAll(PDO::FETCH_ASSOC);
						foreach($strony as $strona){
							?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo $core->webUrl.'page/'.$strona['name']; ?>">
									<?php echo $strona['title']; ?>
								</a>
							</li>
							<?php
						}
                        ?>
                    </ul>
                </div>
                <div class=" navbar-right-elements">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="<?php echo $core->webUrl.'szukaj'; ?>" class="search-open"><i class="ti-search"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="page-custom-header title-space-lg bg-parallax mb80 parallax-overlay" data-jarallax='{"speed": 0.2}' style='background-image: url("<?php echo $core->background; ?>");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
						<div class="col-md-6">
							<h3 class="text-white"><button id="cosfajengo" class="btn btn-success btn-md"><?php echo $g['tag']; ?> </button> <?php echo $g['name']; ?></h3>
							<h5 class="text-white-gray">
								Data utworzenia: <?php echo date("m.d.Y, H:i:s", substr($g['born'], 0, -3)); ?>
							</h5>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<div class="container mb5">
			<div class="row mb50 no-margin">
				<div class="col-md-3 gracz">
					<h3><span><a href="<?php echo $core->webUrl; ?>gracz/<?php echo $g['owner']; ?>"><img src="https://crafatar.com/avatars/<?php echo $g['owner']; ?>?size=25"> <?php echo $g['owner']; ?></a></span></h3>
					<span>Założyciel</span>
				</div>
				<div class="col-md-3">
					<h3><span><i class="fa fa-circle-o-notch"></i> <?php echo $g['points'] ?></span></h3>
					<span>Punktów gildii</span>
				</div>
				<div class="col-md-3">
					<h3><span><i class="fa fa-clock-o"></i> <?php echo date("m.d.Y, H:i:s", substr($g['validity'], 0, -3)); ?></span></h3>
					<span>Ważność gildii</span>
				</div>
				<?php
				$czlonkowie = substr($g['members'], 0, -1);
				$lista_czlonkow = explode(",",$czlonkowie);
				$kille = 0;
				$dedy = 0;
				$ilosc_czlonkow = count($lista_czlonkow);
				foreach($lista_czlonkow as $member){
					$row = $core->searchPlayer($member);
					$kille += $row['kills'];
					$dedy += $row['deaths'];
				}
				if($kille == 0 || $dedy == 0){
					$kd = 0.00;
				} else {
					$kd = $kille/$dedy;
				}
				?>
				<div class="col-md-3">
					<h3><span><i class="fa fa-user-o"></i> <?php echo $ilosc_czlonkow; ?></span></h3>
					<span>Czlonków gildii</span>
				</div>
            </div>
			<hr>
			<div class="row mb50 no-margin">
				<div class="col-md-3">
					<h3><span><i class="fa fa-diamond"></i> <?php echo $kille; ?></span></h3>
					<span>Łącznych zabójstw</span>
				</div>
				<div class="col-md-3">
					<h3><span><i class="fa fa-meh-o"></i> <?php echo $dedy; ?></span></h3>
					<span>Łącznych zgonów</span>
				</div>
				<div class="col-md-3">
					<h3><span><i class="fa fa-magic"></i> <?php echo round($kd,2); ?></span></h3>
					<span>Średnia zabić / zgonów</span>
				</div>
				<div class="col-md-3">
					<h3><span><i class="fa fa-heart-o"></i> <?php echo $g['lives'] ?></span></h3>
					<span>Życia gildii</span>
				</div>
            </div>
		</div>
		<br />
		<div class="container mb5">
			<div class="row mb50 no-margin">
				<div class="col-md-12">
					<div class="title-heading1 mb30 text-center">
						<h3>CZŁONKOWIE</h3>
					</div>
				</div>
			</div>

			<?php

			$col = 0;

			foreach($lista_czlonkow as $gracz){

				if($col == 4){
					?></div><br /><?php
					$col = 0;
				}
				if($col == 0){
				?><div class="row mb50 no-margin"><?php
				}
				?>
				<div class="col-md-3 text-center gracz">
					<a href="<?php echo $core->webUrl.'gracz/'.$gracz; ?>">
						<h3><span><img src="https://crafatar.com/avatars/<?php echo $gracz; ?>?size=64"></span></h3>
						<span><?php echo $gracz; ?></span>
					</a>
				</div>
				<?php
				$col++;
			}
			?>

			</div>
		</div>
<?php
$core->footer();
?>
