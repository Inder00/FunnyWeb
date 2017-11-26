<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $pages;
global $admin;
global $user;
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
      				<h3>TWORZENIE PODSTRONY</h3>
      </div>
        <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola.
        </div>
        <div id="strona_istnieje" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Strona istnieje!</strong><br />Spróbuj ponownie, pamiętaj, aby podać inną nazwę podstrony.
        </div>
        <div id="stworzono" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Stworzono!</strong><br />Podstrona została stworzona z <stong>powodzeniem</strong>.
        </div>
        <form method="post">
            <input name="tab" value="custom_pages/create" hidden="true">
            <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Nazwa strony (pod linkiem twojastrona.pl/page/nazwa)">
            </div>
            <div class="form-group">
                <input name="title" type="text" class="form-control" placeholder="Tytuł strony">
            </div>
            <div class="form-group">
                <textarea name="text" class="form-control" style="height: 222px;" placeholder="Zawartość podstrony (wspiera html)"></textarea>
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Stworz podstronę</button>
            </div>
        </form>
    </div>
</div>
