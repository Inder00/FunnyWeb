<?php
ob_start();
if(file_exists('cache/install.txt') == true){
  header("Location: index.php");
  die();
}
/*
* Funckja zaczerpnięta z stackoverflow.
* Link: https://stackoverflow.com/questions/2820723/how-to-get-base-url-with-php
*/
if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }
        if(substr($base_url, -1) != "/"){
          $base_url .= "/";
        }
        return $base_url;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>FunnyWeb - Instalator</title>
        <link href="css/plugins/plugins.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div id="preloader">
            <div id="preloader-inner"></div>
        </div>
        <div class="site-overlay"></div>
        <div class="page-custom-header title-space-lg bg-parallax mb80 parallax-overlay" data-jarallax='{"speed": 0.2}' style='background-image: url("//i.imgur.com/THhxnVu.jpg>");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h2 class="text-white">FunnyWeb</h2>
                        <p class="text-white-gray 14px">
                            Strona www, służąca do wyświetlania informacji z pluginu FunnyGuilds
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="zainstalowano" style="display:none;">
            <div class="row pb30">
                <div class="col-lg-12">
                  <div class="col-lg-12 mb30 wow zoomInUp" data-wow-delay="100ms" data-wow-duration=".4s">
                      <div class="icon-box icon-box-center">
                          <i class="icon-hover-1 bg-info icon-trophy icon-hover-default"></i>
                          <h4>Pomylśnie zainstalowano</h4>
                          <p>
                            Gratulacje, pomylśnie zainstalowałeś/aś skrypt FunnyWeb.<br />
                            Aby się zalogować do panelu uzyj <a href="admin/">tego</a> linku.<br />
                            Dziękuję za skorzystanie.
                          </p>
                      </div>
                  </div>
                  <div class="col-lg-4"></div>
                </div>
            </div>
        </div>
        <div class="container" id="instalator">
          <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
            </button>
            <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola
          </div>
          <div id="mysql" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
            </button>
            <strong>Brak polaczenia z MYSQL!</strong><br />Spróbuj ponownie, upewnij się, czy wszystkie pola dot. bazy danych są poprawne.
          </div>
          <div class="title-heading1 mb30">
    				<h3>Baza danych</h3>
          </div>
            <div class="row pb30">
                <div class="col-lg-6 col-md-6 mr-auto ml-auto col-sm-6">
                  <form method="post">
                        <div class="form-group">
                            <input name="dbhost" type="text" class="form-control" placeholder="Nazwa hosta bazy danych">
                        </div>
                        <div class="form-group">
                            <input name="dbuser" type="text" class="form-control" placeholder="Nazwa użytkownika bazy danych">
                        </div>
                        <div class="form-group">
                            <input name="dbname" type="text" class="form-control" placeholder="Nazwa bazy w bazie danych">
                        </div>
                        <div class="form-group">
                            <input name="dbpass" type="text" class="form-control" placeholder="Hasło bazy danych">
                        </div>
                        <br />
                        <div class="container">
                          <div class="title-heading1 mb30">
                            <h3>Konto administratora</h3>
                          </div>
                            <div class="row pb30">
                                <div class="col-lg-12 col-md-6 mr-auto ml-auto col-sm-12">
                                        <div class="form-group">
                                            <input name="admin_username" type="text" class="form-control" placeholder="Nazwa użytkownika administratora">
                                        </div>
                                        <div class="form-group">
                                            <input name="admin_password" type="text" class="form-control" placeholder="Hasło administratora">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="container">
                          <div class="title-heading1 mb30">
                            <h3>Pozostale</h3>
                          </div>
                            <div class="row pb30">
                                <div class="col-lg-12 col-md-6 mr-auto ml-auto col-sm-12">
                                        <div class="form-group">
                                            <input name="baseurl" type="text" class="form-control" value="<?php echo base_url(); ?>" placeholder="URL strony (na koću musi byc '/' !!)" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input name="logo" type="text" class="form-control" placeholder="Napis na logo">
                                        </div>
                                        <div class="form-group">
                                            <button id="install" name="submit" value="submit" type="submit" class="btn btn-rounded btn-primary btn-block">Instaluj</button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <script type="text/javascript" src="js/plugins/plugins.js"></script>
		    <script type="text/javascript" src="js/script.js"></script>
        <script>
        $(document).ready(function(){

          $("#install").click(function(){

            $(this).html('<i class="fa fa-gear fa-spin"></i> Instalowanie...');

          });

        });
        </script>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
  if(isset($_POST['dbhost']) && strlen($_POST['dbhost']) > 0
  && isset($_POST['dbuser']) && strlen($_POST['dbuser']) > 0
  && isset($_POST['dbname']) && strlen($_POST['dbname']) > 0
  && isset($_POST['dbpass'])){

    if(isset($_POST['admin_username']) && strlen($_POST['admin_username']) > 0
    && isset($_POST['admin_password']) && strlen($_POST['admin_password']) > 0){

      if(isset($_POST['logo']) && strlen($_POST['logo']) > 0){

        $dbhost = $_POST['dbhost'];
        $dbuser = $_POST['dbuser'];
        $dbname = $_POST['dbname'];
        $dbpass = $_POST['dbpass'];

        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        $base_url = base_url();
        $logo = $_POST['logo'];

        $db;

        try {
          $db = @new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass);
        } catch (PDOException $e) {
          ?><script>$("#mysql").show();</script><?php
          exit();
        }
        $db->query("CREATE TABLE `funnyweb_admins` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(32) NOT NULL , `password` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $db->query("INSERT INTO `funnyweb_admins` (`id`, `username`, `password`) VALUES (NULL, '".$admin_username."', '".sha1(md5(base64_encode(str_rot13($admin_password))).md5(sha1(base64_encode($admin_password))))."');");
        $db->query("CREATE TABLE `funnyweb_pages` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL , `text` TEXT CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

        $content = '<?php
$dbPass="'.$dbpass.'";
$dbHost="'.$dbhost.'";
$dbUsername="'.$dbuser.'";
$dbDatabaseName="'.$dbname.'";
$dbPort="3306";
$maxbans = false;
$webName="SERWER.PL";
$webDescription="Najlepszy polski serwer";
$webDescriptionSecond="Wojna trwa! Zbierz drużynę i ruszaj na spotkanie przygody";
$serverIp="SERWER.PL";
$webUrl="'.$base_url.'";
$background="//i.imgur.com/THhxnVu.jpg";
$logo="'.$logo.'";
$favicon="'.$base_url.'assets/favicon.ico";
?>';
        $fp = fopen("conf_global.php","wb");
        fwrite($fp,$content);
        fclose($fp);
        $fp = fopen("cache/install.txt","wb");
        fwrite($fp,''.date('d.m.Y H:i:s', time()).'');
        fclose($fp);
        ?><script>$("#instalator").hide();$("#zainstalowano").show();</script><?php
      } else {
        ?><script>$("#pola").show();</script><?php
      }

    } else {
      ?><script>$("#pola").show();</script><?php
    }

  } else {
    ?><script>$("#pola").show();</script><?php
  }
}
ob_end_flush();
?>
