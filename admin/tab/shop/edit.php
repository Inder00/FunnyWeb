<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $admin;
global $user;
global $payments;
$id_uslugi = $GLOBALS['id_uslugi'];

$usluga = $payments->getById($id_uslugi);
if(!is_array($usluga)){
    header("Location: ".$core->webUrl."admin/sklep");
    exit();
}
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
      				<h3>EDYCJA USŁUGI</h3>
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
          <strong>Zaaktualizowano!</strong><br />Usługa została zaaktualizowana z <stong>powodzeniem</strong>. Zmiany będą widoczne po przeładowaniu strony.
        </div>
        <form method="post">
            <input name="id" value="<?php echo $usluga['id']; ?>" hidden="true">
            <input name="tab" value="shop/edit" hidden="true">
            <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Nazwa usługi" value="<?php echo $usluga['name']; ?>">
            </div>
            <div class="form-group">
                <select class="form-control" name="number" value="<?php echo $usluga['number']; ?>">
                                <?php
                                if($payments->operator == "homepay"){
                                    ?>
                                    <option <?php if($usluga['number'] == 7055){ echo "selected"; } ?>>7055</option>
                                    <option <?php if($usluga['number'] == 7155){ echo "selected"; } ?>>7155</option>
                                    <option <?php if($usluga['number'] == 7255){ echo "selected"; } ?>>7255</option>
                                    <option <?php if($usluga['number'] == 7355){ echo "selected"; } ?>>7355</option>
                                    <option <?php if($usluga['number'] == 7455){ echo "selected"; } ?>>7455</option>
                                    <option <?php if($usluga['number'] == 7555){ echo "selected"; } ?>>7555</option>
                                    <option <?php if($usluga['number'] == 76660){ echo "selected"; } ?>>76660</option>
                                    <option <?php if($usluga['number'] == 77550){ echo "selected"; } ?>>77550</option>
                                    <option <?php if($usluga['number'] == 7955){ echo "selected"; } ?>>7955</option>
                                    <option <?php if($usluga['number'] == 91055){ echo "selected"; } ?>>91055</option>
                                    <option <?php if($usluga['number'] == 91155){ echo "selected"; } ?>>91155</option>
                                    <option <?php if($usluga['number'] == 91455){ echo "selected"; } ?>>91455</option>
                                    <option <?php if($usluga['number'] == 91955){ echo "selected"; } ?>>91955</option>
                                    <option <?php if($usluga['number'] == 92055){ echo "selected"; } ?>>92055</option>
                                    <option <?php if($usluga['number'] == 92520){ echo "selected"; } ?>>92520</option>
                                    <option <?php if($usluga['number'] == 92525){ echo "selected"; } ?>>92525</option>
                                    <?php
                                }
                                ?>
                </select>
                <small class="form-text text-muted">Numer SMS</small>
            </div>
            <div class="form-group">
                <input name="content_sms" type="text" class="form-control" placeholder="Treść SMS np. HPAY.VIP" value="<?php echo $usluga['content_sms']; ?>">
            </div>
            <div class="form-group">
                <input name="service_id" type="text" class="form-control" placeholder="ID Usługi HomePay" value="<?php echo $usluga['service_id']; ?>">
            </div>
            <div class="form-group">
                <input name="commands" type="text" class="form-control" placeholder="Komendy" value="<?php echo $usluga['commands']; ?>">
                <small class="form-text text-muted">Komendy należy odzielać średniekiem. Nick gracza należy zastąpić [PLAYER] np. "<strong>op [PLAYER];say Dziękujemy za zakup [PLAYER]</strong>"</small>
            </div>
            <div class="form-group">
                <input name="image" type="text" class="form-control" placeholder="Link do obrazu usługi" value="<?php echo $usluga['image']; ?>">
            </div>
            <div class="form-group">
                <textarea name="desc" class="form-control" style="height: 222px;" placeholder="Opis (wspiera html)"><?php echo $payments->format($usluga['description']); ?></textarea>
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Edytuj usługę</button>
            </div>
        </form>
    </div>
</div>
