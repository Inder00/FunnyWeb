<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $pages;
global $admin;
global $user;
global $news;
$id_podstrony = $GLOBALS['id_podstrony'];

$strona = $news->getById($id_podstrony);
if(!is_array($strona)){
    header("Location: ".$core->webUrl."admin/aktualnosci");
    exit();
}
?>
<div class="row">
    <div class="col-md-8 offset-2">
      <div class="title-heading1 mb30">
          <h3>EDYCJA NEWSA</h3>
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
          <strong>Zaaktualizowano!</strong><br />News został zaaktualizowany z <stong>powodzeniem</strong>. Zmiany będą widoczne po przeładowaniu strony.
        </div>
        <form method="post">
            <input name="id" value="<?php echo $strona['id']; ?>" hidden="true">
            <input name="tab" value="news/edit" hidden="true">
            <div class="form-group">
                <input name="title" value="<?php echo htmlspecialchars($strona['title']); ?>" type="text" class="form-control" placeholder="Tytuł">
            </div>
            <div class="form-group">
                <input name="image" type="text" class="form-control" placeholder="Link do obrazu" value="<?php echo $strona['image']; ?>">
            </div>
            <div class="form-group">
                <textarea name="text" class="form-control" style="height: 222px;" placeholder="Zawartość (wspiera html)"><?php echo $strona['text']; ?></textarea>
            </div>
            <div class="form-group">
                  <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Zapisz</button>
            </div>
        </form>
    </div>
</div>
