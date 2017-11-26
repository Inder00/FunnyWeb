<?php
@session_start();
class FunnyAdmin extends FunnyWeb {
  public function getUsername(){
    return $_SESSION['username'];
  }
  public function isLogged(){
    if(isset($_SESSION['username']) != null && !empty($_SESSION['username']) && $_SESSION['username'] != ""){
      if(isset($_SESSION['password']) != null && !empty($_SESSION['password']) && $_SESSION['password'] != ""){
        if($this->verifyLoggedPassword($_SESSION['username'],$_SESSION['password']) == true){
          return true;
        } else {
          return false;
        }
      }
    }
  }
  public function login($username,$password){
    if($this->verify($username,$password) == true){
      $_SESSION['username']=$username;
      $_SESSION['password']=$this->hash($this->hash($password));
      return true;
    } else {
      return false;
    }
  }
  public function logout(){
    if($this->isLogged()){
      $_SESSION['username']="";
      $_SESSION['password']="";
    }
  }
  public function info($username){
    $sql = "SELECT * FROM funnyweb_admins WHERE username=:username";
    $stmt = $this->db->prepare($sql);
	$stmt->bindValue(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = count($rows);
    if($num == 0){
      return "not_found";
    }
    return $rows;
  }
  public function infoById($username){
    $sql = "SELECT * FROM funnyweb_admins WHERE id=:username";
    $stmt = $this->db->prepare($sql);
	$stmt->bindValue(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = count($rows);
    if($num == 0){
      return "not_found";
    }
    return $rows;
  }

  public function remove($id){
      $sql = "DELETE FROM `funnyweb_admins` WHERE id = :id;";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_STR);
      $stmt->execute();
  }
  public function verify($username,$password){
    $sql = "SELECT * FROM funnyweb_admins WHERE username=:username";
    $stmt = $this->db->prepare($sql);
		$stmt->bindValue(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = count($rows);
    if($num > 0 && $rows['password']==$this->hash($password)){
      return true;
    }
    return false;
  }
  public function verifyLoggedPassword($username,$password){
    $sql = "SELECT * FROM funnyweb_admins WHERE username=:username";
    $stmt = $this->db->prepare($sql);
		$stmt->bindValue(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = count($rows);
    if($num > 0 && $this->hash($rows['password'])==$password){
      return true;
    }
    return false;
  }
  public function hash($password){
    return sha1(md5(base64_encode(str_rot13($password))).md5(sha1(base64_encode($password))));
  }
  public function tab($tab,$id){
    if(isset($tab) && !empty($tab)){
      switch($tab){
        case "custom_pages/edit":
            if(isset($id) && !empty($id)){
                $GLOBALS['id_podstrony'] = $id;
                return include($this->root."/admin/tab/pages/edit.php");
                break;
            }
        case "custom_pages/create":
            return include($this->root."/admin/tab/pages/create.php");
            break;
        case "custom_pages":
          return include($this->root."/admin/tab/custom_pages.php");
          break;
        case "change_password":
          return include($this->root."/admin/tab/change_password.php");
          break;
        case "website":
          return include($this->root."/admin/tab/website.php");
          break;
        case "accounts":
            return include($this->root."/admin/tab/accounts.php");
            break;
        case "accounts/create":
            return include($this->root."/admin/tab/accounts/create.php");
            break;
        default:
          return include($this->root."/admin/tab/index.php");
          break;
      }
    } else {
      return include($this->root."/admin/tab/index.php");
    }
  }

  public function update($id,$column,$value){
    $sql = "UPDATE funnyweb_admins SET ".$column."=:value WHERE id=:username";
    $stmt = $this->db->prepare($sql);
	$stmt->bindValue(':username', $id, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
	$stmt->execute();
  }
  
  public function register($username,$password){
      $sql = "INSERT INTO funnyweb_admins (`id`, `username`, `password`) VALUES (NULL, :username, :password);";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
  }

}

$admin = new FunnyAdmin;

?>
