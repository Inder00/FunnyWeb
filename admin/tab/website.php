<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $admin;
global $user;
?>
<div class="row">
    <div class="col-md-10 offset-1">
      <div class="title-heading1 mb30">
      				<h3>USTAWIENIA STRONY</h3>
      </div>
        <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola.
        </div>
        <div id="zmieniono" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Zapisano!</strong><br />Zmiany zostaly zapisane. Zmiany zostana zastosowane przy ponownym przeladowaniu strony... Kliknij <a href="<?php echo $core->webUrl; ?>admin/ustawienia">tutaj</a>, aby przeładować stronę
        </div>
        <form method="post">
            <input name="tab" value="website" hidden="true">
            <div class="form-group row">
                <label class="col-2 col-form-label">Nazwa strony</label>
                <div class="col-10">
                    <input name="webname" class="form-control" type="text" value="<?php echo $core->webName; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Opis strony</label>
                <div class="col-10">
                    <input name="webdesc" class="form-control" type="text" value="<?php echo $core->webDescription; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Opis strony (2)</label>
                <div class="col-10">
                    <input name="webdesc2" class="form-control" type="text" value="<?php echo $core->webDescriptionSecond; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">IP Serwera</label>
                <div class="col-10">
                    <input name="serverip" class="form-control" type="text" value="<?php echo $core->serverIp; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">URL Strony</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?php echo $core->webUrl; ?>" disabled>
                </div>
                <small class="offset-2">Tą wartość można zmieniać z pliku <strong>conf_global.php</strong> w celu bezpieczeństwa. Jeżeli używasz protokołu HTTP i HTTPS zmień protokół na <strong>//</strong></small>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Tło strony</label>
                <div class="col-10">
                    <input name="background" class="form-control" type="text" value="<?php echo $core->background; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Logo strony</label>
                <div class="col-10">
                    <input name="logo" class="form-control" type="text" value="<?php echo $core->logo; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Ikona strony</label>
                <div class="col-10">
                    <input name="favicon" class="form-control" type="text" value="<?php echo $core->favicon; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">MaxBans</label>
                <div class="col-10">
                    <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                        <input name="maxbans" value="maxbans" type="checkbox" class="custom-control-input" <?php if($core->maxbans == true){ echo "checked"; } ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Czy używasz pluginu MaxBans podpiętego pod tą samą bazę co strona ?</span>
                    </label>
                </div>
                <small class="offset-2">Włączenie tej opcji doda nową zakładkę <strong>Bany</strong> w menu strony.</small>
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Zapisz</button>
            </div>
        </form>
    </div>
</div>
