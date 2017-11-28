<?php
if(!defined("IN_SCRIPT")){ exit(include('403.php')); }
global $core;
ob_start();
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
        <meta property="og:locale" content="pl_PL">
        <meta property="og:site_name" content="<?php echo $core->webName.' - '.$core->webDescription; ?>">
        <meta name="description" content="<?php echo $core->webDescription; ?>">
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
                    <div class=" col-md-12">
                        <h2 class="text-white"><?php echo $core->webDescription; ?></h2>
                        <p class="text-white-gray 14px">
                            <?php echo $core->webDescriptionSecond; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
