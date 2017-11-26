<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $admin;
global $user;
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
      				<h3>TWORZENIE KONTA ADMINISTRACYJNEGO</h3>
      </div>
        <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola.
        </div>
        <div id="istnieje" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Bląd!</strong><br />Spróbuj ponownie, pamiętaj, żeby wybrać inną nazwe uzytykownika, ponieważ ta jest zajęta.
        </div>
        <div id="hasla_inne" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Hasła się nie zgadzają!</strong><br />Spróbuj ponownie, pamiętaj, aby podać poprawnie hasło.
        </div>
        <div id="stworzono" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Konto zostało utworzone!</strong><br />Konto zostało pomylśnie utworzone.
        </div>
        <form method="post">
            <input name="tab" value="accounts/create" hidden="true">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Nazwa użytkownika">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Hasło">
            </div>
            <div class="form-group">
                <input name="password2" type="password" class="form-control" placeholder="Powtórz hasło">
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Stwórz konto</button>
            </div>
        </form>
    </div>
</div>
