<?php
require_once '../application/core.php';
require_once '../application/admin.php';

if($admin->isLogged() == true){
  header("Location: ".$core->webUrl.'admin/home');
  exit();
}

$core->top();
?>
    <div class="container">
      <div class="title-heading1 mb30">
				<h3>PANEL ADMINISTRATORA</h3>
      </div>
        <div class="row pb30">
            <div class="col-lg-4 col-md-6 mr-auto ml-auto col-sm-8">
              <?php
              if((isset($_POST['submit'])) != null){
                if((isset($_POST['username'])) != null){
                    if((isset($_POST['password'])) != null){
                      if($admin->login($_POST['username'],$_POST['password']) == true){
                        header("Location: ".$core->webUrl.'admin/home');
                        exir();
                      } else {
                        ?>
                        <div id="bad_login" class="alert alert-danger alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                          </button>
                          <strong>Nieprawidłowe dane!</strong><br />Spróbuj ponownie (możesz mieć wciśnięty klawisz "Caps Lock")
                        </div>
                        <?php
                      }
                    }
                  }
              }
              ?>
                <form method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Nazwa użytkownika">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Hasło">
                    </div>
                      <div class="form-group">
                          <button name="submit" value="submit" type="submit" class="btn btn-rounded btn-primary btn-block">Zaloguj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
$core->footer();
?>
