<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $admin;
global $user;
global $payments;
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
      				<h3>TWORZENIE USŁUGI</h3>
      </div>
        <div id="pola" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Wypełnij wszystkie pola!</strong><br />Spróbuj ponownie, pamiętaj, żeby wypełnić wszystkie pola.
        </div>
        <div id="stworzono" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
          </button>
          <strong>Stworzono!</strong><br />Usługa została stworzona z <stong>powodzeniem</strong>.
        </div>
        <form method="post">
            <input name="tab" value="shop/create" hidden="true">
            <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Nazwa usługi">
            </div>
            <div class="form-group">
                <select class="form-control" name="number">
                                <?php
                                if($payments->operator == "homepay"){
                                    ?>
                                    <option>7055</option>
                                    <option>7155</option>
                                    <option>7255</option>
                                    <option>7355</option>
                                    <option>7455</option>
                                    <option>7555</option>
                                    <option>76660</option>
                                    <option>77550</option>
                                    <option>7955</option>
                                    <option>91055</option>
                                    <option>91155</option>
                                    <option>91455</option>
                                    <option>91955</option>
                                    <option>92055</option>
                                    <option>92520</option>
                                    <option>92525</option>
                                    <?php
                                }
                                ?>
                </select>
                <small class="form-text text-muted">Numer SMS</small>
            </div>
            <div class="form-group">
                <input name="content_sms" type="text" class="form-control" placeholder="Treść SMS np. HPAY.VIP">
            </div>
            <div class="form-group">
                <input name="service_id" type="text" class="form-control" placeholder="ID Usługi HomePay">
            </div>
            <div class="form-group">
                <input name="commands" type="text" class="form-control" placeholder="Komendy">
                <small class="form-text text-muted">Komendy odzielać średniekiem. Nick gracza zastąpić [PLAYER] np. "<strong>op [PLAYER];say Dziękujemy za zakup [PLAYER]</strong>"</small>
            </div>
            <div class="form-group">
                <input name="image" type="text" class="form-control" placeholder="Link do obrazu usługi">
            </div>
            <div class="form-group">
                <textarea name="desc" class="form-control" style="height: 222px;" placeholder="Opis (wspiera html)"></textarea>
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Stworz usługę</button>
            </div>
        </form>
    </div>
</div>
