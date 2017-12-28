<?php
require_once '../application/core.php';
require_once '../application/payments.php';
require_once '../application/admin.php';

if($admin->isLogged() == false){
  header("Location: ".$core->webUrl.'admin');
  exit();
}

$user = $admin->info($admin->getUsername());

$core->top();
?>
<div class="container mb70">
     <div class="row">
         <div class="col-lg-3 mb40">
             <div class="mb40">
                 <h4 class="sidebar-title">Witaj, <img src="https://crafatar.com/avatars/<?php echo $user['username']; ?>?size=23"> <?php echo $user['username']; ?></h4>
                 <ul class="list-unstyled categories">
                     <li><a href="<?php echo $core->webUrl; ?>admin/home">Strona główna</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/ustawienia">Ustawienia strony</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/strony">Własne podstrony</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/konta">Konta administracyjne</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/aktualnosci">Aktualnosci</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/sklep">Sklep</a></li>
                     <li><br /></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/zmienhaslo">Zmień hasło</a></li>
                     <li><a href="<?php echo $core->webUrl; ?>admin/wyloguj">Wyloguj</a></li>
                 </ul>
             </div>
         </div>
         <div class="col-lg-9">
           <?php $admin->tab(@$_GET['tab'],@$_GET['id']); ?>
         </div>
     </div>
 </div>
<?php
$core->footer();

//ZMIANA HASLA
if((isset($_POST['submit'])) != null){
  if(isset($_POST['tab']) && $_POST['tab'] == "change_password"){
    if(isset($_POST['oldpass']) && !empty($_POST['oldpass'])
    && isset($_POST['newpass']) && !empty($_POST['newpass'])
    && isset($_POST['newpass2']) && !empty($_POST['newpass2'])){

      $stare = $_POST['oldpass'];
      $nowe = $_POST['newpass'];
      $nowe2 = $_POST['newpass2'];
      $hash = $admin->hash($nowe);
      if($user['password'] == $admin->hash($stare)){
        if($nowe == $nowe2){
          ?><script>$("#zmieniono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin";},3000);</script><?php
          $admin->update($user['id'],"password",$hash);
          $admin->logout();
        } else {
          ?><script>$("#hasla_inne").show();</script><?php
        }
      } else {
        ?><script>$("#nieprawidlowe_stare").show();</script><?php
      }

    } else {
      ?><script>$("#pola").show();</script><?php
    }

    //ZMIANA USTAWIEŃ
    }
    if(isset($_POST['tab']) && $_POST['tab'] == "website"){

        if(isset($_POST['webname']) && !empty($_POST['webname'])
        && isset($_POST['webdesc']) && !empty($_POST['webdesc'])
        && isset($_POST['webdesc2']) && !empty($_POST['webdesc2'])
        && isset($_POST['serverip']) && !empty($_POST['serverip'])
        && isset($_POST['background']) && !empty($_POST['background'])
        && isset($_POST['logo']) && !empty($_POST['logo'])
        && isset($_POST['favicon']) && !empty($_POST['favicon'])){

            $webname = $_POST['webname'];
            $webdesc = $_POST['webdesc'];
            $webdesc2 = $_POST['webdesc2'];
            $serverip = $_POST['serverip'];
            $background = $core->replaceProtocol($_POST['background']);
            $logo = $_POST['logo'];
            $favicon = $_POST['favicon'];
            $maxbans = false;
            if(isset($_POST['maxbans'])){
                $maxbans = true;
            }

            $content = '<?php
$dbPass="'.$core->dbPass.'";
$dbHost="'.$core->dbHost.'";
$dbUsername="'.$core->dbUsername.'";
$dbDatabaseName="'.$core->dbDatabaseName.'";
$dbPort="3306";
$maxbans="'.$maxbans.'";
$webName="'.$webname.'";
$webDescription="'.$webdesc.'";
$webDescriptionSecond="'.$webdesc2.'";
$serverIp="'.$serverip.'";
$webUrl="'.$core->webUrl.'";
$background="'.$background.'";
$logo="'.$logo.'";
$favicon="'.$favicon.'";
?>';
            $fp = fopen($core->root."/conf_global.php","wb");
            fwrite($fp,$content);
            fclose($fp);
            ?><script>$("#zmieniono").show();</script><?php
        } else {
            ?><script>$("#pola").show();</script><?php
        }

    }

    //TWORZENIE PODSTRONY
    if(isset($_POST['tab']) && $_POST['tab'] == "custom_pages/create"){

        if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['text']) && !empty($_POST['text'])
        && isset($_POST['title']) && !empty($_POST['title'])){

            $nazwa = $_POST['name'];
            $text = $_POST['text'];
            $title = $_POST['title'];

            $istnieje = $pages->get($nazwa);
            if(!is_array($istnieje)){

                $pages->insert($nazwa,$title,$text);
                ?><script>$("#stworzono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/strony";},3000);</script><?php
            } else {
                ?><script>$("#strona_istnieje").show();</script><?php
            }

        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //USUWANIE PODSTRONY
    if(isset($_POST['tab']) && $_POST['tab'] == "custom_pages/delete"){
        if(isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $istnieje = $pages->getById($id);
            if(is_array($istnieje)){
                $pages->remove($id);
                ?><script>$("#usunieto").show();$("#<?php echo $id; ?>").hide();</script><?php
            }
        }
    }

    //EDYCJA PODSTRONY
    if(isset($_POST['tab']) && $_POST['tab'] == "custom_pages/edit"){

        if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['text']) && !empty($_POST['text'])
        && isset($_POST['title']) && !empty($_POST['title'])
        && isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $nazwa = $_POST['name'];
            $text = $_POST['text'];
            $title = $_POST['title'];

            $strona = $pages->getById($id);
            if(is_array($strona)){

                $pages->update($strona['id'],'name',$nazwa);
                $pages->update($strona['id'],'text',$text);
                $pages->update($strona['id'],'title',$title);
                ?><script>$("#zmieniono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/strony";},3000);</script><?php
            } else {
                ?><script>$("#pola").show();</script><?php
            }

        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //TWORZENIE KONTA
    if(isset($_POST['tab']) && $_POST['tab'] == "accounts/create"){

        if(isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['password2']) && !empty($_POST['password2'])){

            $username = $_POST['username'];
            $pass1 = $_POST['password'];
            $pass2 = $_POST['password2'];

            if($pass1 == $pass2){
                $konto = $admin->info($username);
                if(!is_array($konto)){
                    $admin->register($username,$admin->hash($pass1));
                    ?><script>$("#stworzono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/konta";},3000);</script><?php
                } else {
                    ?><script>$("#istnieje").show();</script><?php
                }
            } else {
                ?><script>$("#hasla_inne").show();</script><?php
            }

        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //USUWANIE KONTA
    if(isset($_POST['tab']) && $_POST['tab'] == "accounts/delete"){
        if(isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $istnieje = $admin->infoById($id);
            if(is_array($istnieje)){
                if($istnieje['username']!=$admin->getUsername()){
                    $admin->remove($id);
                    ?><script>$("#usunieto").show();$("#<?php echo $id; ?>").hide();</script><?php
                } else {
                    ?><script>$("#nie_usunieto").show();</script><?php
                }
            }
        }
    }

    //TWORZENIE NEWSA
    if(isset($_POST['tab']) && $_POST['tab'] == "news/create"){

        if(isset($_POST['text']) && !empty($_POST['text'])
        && isset($_POST['title']) && !empty($_POST['title'])){

            $text = $_POST['text'];
            $title = $_POST['title'];
            $img = $_POST['image'];
            $news->insert($admin->getUsername(),$title,$text,$img);
            ?><script>$("#stworzono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/aktualnosci";},3000);</script><?php
        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //EDYCJA NEWSA
    if(isset($_POST['tab']) && $_POST['tab'] == "news/edit"){

        if(isset($_POST['text']) && !empty($_POST['text'])
        && isset($_POST['title']) && !empty($_POST['title'])
        && isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $text = $_POST['text'];
            $title = $_POST['title'];
            $img = $_POST['image'];

            $strona = $news->getById($id);
            if(is_array($strona)){

                $news->update($strona['id'],'text',$text);
                $news->update($strona['id'],'title',$title);
                $news->update($strona['id'],'image',$img);
                ?><script>$("#zmieniono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/aktualnosci";},3000);</script><?php
            } else {
                ?><script>$("#pola").show();</script><?php
            }

        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //USUWANIE NEWSA
    if(isset($_POST['tab']) && $_POST['tab'] == "news/delete"){
        if(isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $istnieje = $news->getById($id);
            if(is_array($istnieje)){
                $news->remove($id);
                ?><script>$("#usunieto").show();$("#<?php echo $id; ?>").hide();</script><?php
            }
        }
    }

    //EDYCJA USŁUGI
    if(isset($_POST['tab']) && $_POST['tab'] == "shop/edit"){

        if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['number']) && !empty($_POST['number'])
        && isset($_POST['content_sms']) && !empty($_POST['content_sms'])
        && isset($_POST['service_id']) && !empty($_POST['service_id'])
        && isset($_POST['commands']) && !empty($_POST['commands'])
        && isset($_POST['image']) && !empty($_POST['image'])
        && isset($_POST['desc']) && !empty($_POST['desc'])
        && isset($_POST['id']) && !empty($_POST['id'])
    ){

            $id = $_POST['id'];
            $name = $_POST['name'];
            $number = $_POST['number'];
            $img = $_POST['image'];
            $content_sms = $_POST['content_sms'];
            $service_id = $_POST['service_id'];
            $commands = $_POST['commands'];
            $desc = $_POST['desc'];

            $usluga = $payments->getById($id);
            if(is_array($usluga)){

                $payments->update($usluga['id'],'name',$name);
                $payments->update($usluga['id'],'number',$number);
                $payments->update($usluga['id'],'image',$img);
                $payments->update($usluga['id'],'content_sms',$content_sms);
                $payments->update($usluga['id'],'service_id',$service_id);
                $payments->update($usluga['id'],'commands',$commands);
                $payments->update($usluga['id'],'description',$desc);
                ?><script>$("#zmieniono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/sklep";},3000);</script><?php

            } else {
                ?><script>$("#pola").show();</script><?php
            }
        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //TWORZENIE USŁUGI
    if(isset($_POST['tab']) && $_POST['tab'] == "shop/create"){

        if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['number']) && !empty($_POST['number'])
        && isset($_POST['content_sms']) && !empty($_POST['content_sms'])
        && isset($_POST['service_id']) && !empty($_POST['service_id'])
        && isset($_POST['commands']) && !empty($_POST['commands'])
        && isset($_POST['image']) && !empty($_POST['image'])
        && isset($_POST['desc']) && !empty($_POST['desc'])
    ){

            $name = $_POST['name'];
            $number = $_POST['number'];
            $img = $_POST['image'];
            $content_sms = $_POST['content_sms'];
            $service_id = $_POST['service_id'];
            $commands = $_POST['commands'];
            $desc = $_POST['desc'];

            $payments->insert($name,$desc,$number,$content_sms,$commands,$img,$service_id);
            ?><script>$("#stworzono").show();setInterval(function(){location.href="<?php echo $core->webUrl; ?>admin/sklep";},3000);</script><?php
        } else {
            ?><script>$("#pola").show();</script><?php
        }
    }

    //USUWANIE USŁUGI
    if(isset($_POST['tab']) && $_POST['tab'] == "shop/delete"){
        if(isset($_POST['id']) && !empty($_POST['id'])){

            $id = $_POST['id'];
            $istnieje = $payments->getById($id);
            if(is_array($istnieje)){
                $payments->remove($id);
                ?><script>$("#usunieto").show();$("#<?php echo $id; ?>").hide();</script><?php
            }
        }
    }

}
?>
