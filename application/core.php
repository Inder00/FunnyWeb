<?php
class FunnyWeb {

	public $maxbans;
	public $dbPass;
	public $dbHost;
	public $dbUsername;
	public $dbDatabaseName;
	public $dbPort;
	public $webName;
	public $webDescription;
	public $webDescriptionSecond;
	public $serverIp;
	public $webUrl;
	public $background;
	public $logo;
	public $favicon;

	public $db;
	public $root;

	public function __construct(){
		$this->root = str_replace('\\', '/', getcwd());
		$this->root = str_replace('/application/', '', $this->root);
		$this->root = str_replace('application', '', $this->root);
		$this->root = str_replace('pages', '', $this->root);
		$this->root = str_replace('admin', '', $this->root);
		$this->root = str_replace('tab', '', $this->root);
		if(file_exists($this->root.'/cache/install.txt') == false){
			header("Location: install.php");
			die();
		}
		include $this->root.'/conf_global.php';
		$this->maxbans = $maxbans;
		$this->dbPass = $dbPass;
		$this->dbHost = $dbHost;
		$this->dbUsername = $dbUsername;
		$this->dbDatabaseName = $dbDatabaseName;
		$this->dbPort = $dbPort;
		$this->webName = $webName;
		$this->webDescription = $webDescription;
		$this->webDescriptionSecond = $webDescriptionSecond;
		$this->serverIp = $serverIp;
		$this->webUrl = $webUrl;
		$this->background = $background;
		$this->logo = $logo;
		$this->favicon = $favicon;
		try {
			$this->db = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbDatabaseName.';charset=utf8', $this->dbUsername, $this->dbPass);
			$this->db->setAttribute(PDO::MYSQL_ATTR_FOUND_ROWS, true);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = file_get_contents($this->root.'/error.html');
			$error = str_replace("{TITLE}","Błąd związany z bazą danych", $error);
			$error = str_replace("{DESC}", "Nie mozna sie polaczyc z baza danych (".$e->getMessage().").", $error);
			$error = str_replace("{OTHER}", "Jeśli uważasz, że to błąd w systemie jak najszybciej skontaktuj się z serwisem w celu ustalenia przyczyny.", $error);
			$error = str_replace("{BUTTON}", "application/core.php line: 4-8", $error);
			echo $error;
			die();
		}
		if(!defined('IN_SCRIPT')) define("IN_SCRIPT", 1);
	}
	public function top(){
		return include $this->root.'/application/pages/top.php';
	}
	public function footer(){
		return include $this->root.'/application/pages/footer.php';
	}
	public function search($what){
		$guild = $this->searchGuild($what);
		if(is_array($guild)){
			return $guild;
		} else {
			$player = $this->searchPlayer($what);
			if(is_array($player)){
				return $player;
			} else {
				return "not_found";
			}
		}
	}
	public function searchGuild($tag){
		if(empty($tag)){
			return "not_found";
		}
		$stmt = $this->db->prepare("SELECT * FROM guilds WHERE tag=:name");
		$stmt->bindValue(':name', $tag, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$num = count($rows);
		if($num == 0){
			return "not_found";
		}
		return $rows;
	}
	public function searchGuildByName($name){
		if(empty($name)){
			return "not_found";
		}
		$stmt = $this->db->prepare("SELECT * FROM guilds WHERE name=:name");
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$num = count($rows);
		if($num == 0){
			return "not_found";
		}
		return $rows;
	}
	public function searchPlayer($name){
		if(empty($name)){
			return "not_found";
		}
		$stmt = $this->db->prepare("SELECT * FROM users WHERE name=:name");
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$num = count($rows);
		if($num == 0){
			return "not_found";
		}
		return $rows;
	}
	public function includediv(){
		return include $this->root.'/application/pages/include.php';
	}
	public function replaceProtocol($string){
		return str_replace("https://", "//", str_replace("http://", "//", $string));
	}
}

class CustomPages extends FunnyWeb {

	public function update($id,$column,$value){
		$sql = "UPDATE funnyweb_pages SET ".$column."=:value WHERE id=:id";
      	$stmt = $this->db->prepare($sql);
  		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
      	$stmt->bindValue(':value', $value, PDO::PARAM_STR);
  		$stmt->execute();
    }
	public function insert($name,$title,$text){
		$sql = "INSERT INTO `funnyweb_pages` (`id`, `name`, `title`, `text`) VALUES (NULL, :name, :title, :text);";
		$stmt = $this->db->prepare($sql);
  		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
      	$stmt->bindValue(':title', $title, PDO::PARAM_STR);
		$stmt->bindValue(':text', $text, PDO::PARAM_STR);
  		$stmt->execute();
	}
	public function get($name){
		if(empty($name)){
			return "not_found";
		}
		$stmt = $this->db->prepare("SELECT * FROM funnyweb_pages WHERE name=:name");
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$num = count($rows);
		if($num == 0){
			return "not_found";
		}
		return $rows;
	}
	public function getById($name){
		if(empty($name)){
			return "not_found";
		}
		$stmt = $this->db->prepare("SELECT * FROM funnyweb_pages WHERE id=:name");
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
		$sql = "DELETE FROM `funnyweb_pages` WHERE id = :id;";
		$stmt = $this->db->prepare($sql);
  		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
  		$stmt->execute();
	}
	public function format($text){
		return nl2br($text);
	}
}

$pages = new CustomPages;
$core = new FunnyWeb;
?>
