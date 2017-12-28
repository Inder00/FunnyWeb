<?php
require 'hooks/MinecraftPing.php';
require 'hooks/MinecraftPingException.php';
require 'hooks//bootstrap.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

class FunnyPayments extends FunnyWeb {

    //Dostępne:
    // * "homepay" - Homepay.pl
    public $operator = "homepay";

    public function getCost($number){
        if($this->operator == "homepay"){
            switch ($number) {
                case "7055":
                    return 0.55*1.23;
                    break;
                case "7155":
                    return 1*1.23;
                    break;
                case "7255":
                    return 2*1.23;
                    break;
                case "7355":
                    return 3*1.23;
                    break;
                case "7455":
                    return 4*1.23;
                    break;
                case "7555":
                    return 5*1.23;
                    break;
                case "76660":
                    return 6*1.23;
                    break;
                case "77550":
                    return 7*1.23;
                    break;
                case "7955":
                    return 9*1.23;
                    break;
                case "91055":
                    return 10*1.23;
                    break;
                case "91155":
                    return 11*1.23;
                    break;
                case "91455":
                    return 14*1.23;
                    break;
                case "91955":
                    return 19*1.23;
                    break;
                case "92055":
                    return 20*1.23;
                    break;
                case "92520":
                    return 25*1.23;
                    break;
                case "92525":
                    return 25*1.23;
                    break;
                default:
                    return 0;
                    break;
            }
        }
    }
    public function verify($id_uslugi,$kod_sms,$id_uslugi_sms){
        if($this->operator == "homepay"){

            $result = @fopen("http://homepay.pl/sms/check_code.php?acc_id=".$id_uslugi_sms."&code=".$kod_sms,'r');
            $status = fgets($result,8);
            fclose($result);
            if($status == "1"){

                //KOD POPRAWNY
                return true;

            } else {

                //KOD NIEPOPRAWNY
                return false;

            }
        }
    }

    public function update($id,$column,$value){
        $sql = "UPDATE funnyweb_payments SET ".$column."=:value WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':value', $value, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function insert($name,$desc,$number,$content_sms,$commands,$image, $service_id){
        $sql = "INSERT INTO `funnyweb_payments` (`id`, `name`, `description`, `number`, `content_sms`, `commands`, `image`, `service_id`) VALUES (NULL, :name, :description, :numer, :content_sms, :commands, :image, :service_id);";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $desc, PDO::PARAM_STR);
        $stmt->bindValue(':numer', $number, PDO::PARAM_STR);
        $stmt->bindValue(':content_sms', $content_sms, PDO::PARAM_STR);
        $stmt->bindValue(':commands', $commands, PDO::PARAM_STR);
        $stmt->bindValue(':service_id', $service_id, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function getById($name){
        if(empty($name)){
            return "not_found";
        }
        $stmt = $this->db->prepare("SELECT * FROM funnyweb_payments WHERE id=:name");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $num = count($rows);
        if($num == 0){
            return "not_found";
        }
        return $rows;
    }
    public function remove($id){
        $sql = "DELETE FROM `funnyweb_payments` WHERE id = :id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function format($text){
        return nl2br($text);
    }

}

class FunnyCraft extends FunnyWeb {

    public function isOnline($ip,$port){
        $Info = false;
    	$Query = null;
    	try
    	{
    		$Query = new MinecraftPing( $ip, $port, 5 );
    		$Info = $Query->Query( );
    		if( $Info === false )
    		{
    			$Query->Close( );
    			$Query->Connect( );
    		}
    	}
    	catch( MinecraftPingException $e )
    	{
    		$Exception = $e;
    	}
    	if( $Query !== null )
    	{
    		$Query->Close( );
    	}
        if(is_array($Info)){
            return true;
        }
        return false;
    }
    public function executeCommands($service,$ip,$port,$password,$player){

        $Query = new \xPaw\SourceQuery\SourceQuery();

        try {
            $Query->Connect($ip, $port, 5, \xPaw\SourceQuery\SourceQuery::SOURCE);

            $Query->SetRconPassword($password);

            $commands = explode(";",$service['commands']);
            foreach ($commands as $command) {
                $Query->Rcon(str_replace('[PLAYER]', $player, $command));
            }
            return true;
        } catch (Exception $e) {
            return false;
        } finally {
            $Query->Disconnect();
        }

    }
    public function testRcon($service,$ip,$port,$password,$player){

        $Query = new \xPaw\SourceQuery\SourceQuery();

        try {
            $Query->Connect($ip, $port, 5, \xPaw\SourceQuery\SourceQuery::SOURCE);

            $Query->SetRconPassword($password);

            return true;
        } catch (Exception $e) {
            return false;
        } finally {
            $Query->Disconnect();
        }

    }

}

$craft = new FunnyCraft;
$payments = new FunnyPayments;

?>
