<?php
require '../core.php';
require '../payments.php';
require $core->root.'/config/conf_shop.php';

$id_uslugi = @$_POST['id'];
$nickname = @$_POST['nickname'];
$smscode = @$_POST['smscode'];

if(isset($id_uslugi) && isset($nickname) && isset($smscode)){

    if(strlen($smscode) == 8){

        $usluga = $payments->getById($id_uslugi);
        if(is_array($usluga)){

            if($craft->isOnline($ip,$query_port) == true){

                if($craft->testRcon($usluga,$ip,$rcon_port,$rcon_passwd,$nickname) == true){
                    if($payments->verify($id_uslugi,$smscode,$usluga['service_id']) == true){

                        $craft->executeCommands($usluga,$ip,$rcon_port,$rcon_passwd,$nickname);
                        exit("PURCHASED");

                    } else {
                        exit("ERR_BAD_CODE");
                    }
                } else {
                    exit("ERR_CONNECTION_REFUSED_RCON");
                }
            } else {
                exit("SERVER_OFFLINE");
            }
        } else {
            exit("SERVICE_NOT_EXISTS");
        }

    } else {
        exit("ERR_BAD_CODE");
    }

} else {
    exit("ERR_NO_VALUES");
}

?>
