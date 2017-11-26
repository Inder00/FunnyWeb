<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $admin;
global $user;
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
      				<h3>ZMIANA HASŁA</h3>
      </div>
        <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola.
        </div>
        <div id="hasla_inne" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Hasła się nie zgadzają!</strong><br />Spróbuj ponownie, pamiętaj, aby podać poprawnie hasło.
        </div>
        <div id="nieprawidlowe_stare" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Podane hasło jest nieprawidłowe!</strong><br />Spróbuj ponownie, pamiętaj, aby podać poprawnie zapisać stare hasło.
        </div>
        <div id="zmieniono" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Zmieniono!</strong><br />Twoje hasło zostało zmienione! Za chwile zostaniesz wylogowany i przekierowany na stronę logowania.
        </div>
        <form method="post">
            <input name="tab" value="change_password" hidden="true">
            <div class="form-group">
                <input name="oldpass" type="password" class="form-control" placeholder="Stare hasło">
            </div>
            <div class="form-group">
                <input name="newpass" type="password" class="form-control" placeholder="Hasło">
            </div>
            <div class="form-group">
                <input name="newpass2" type="password" class="form-control" placeholder="Powtórz hasło">
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Zmień hasło</button>
            </div>
        </form>
    </div>
</div>
