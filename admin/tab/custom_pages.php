<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $pages;
global $admin;
global $user;
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb40">
                    <div class="title-heading1 mb30">
                        <h3>WŁASNE PODSTRONY</h3>
                    </div>
                    <div id="usunieto" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                      </button>
                      <strong>Usunięta!</strong><br />Podstrona została usunięta z <strong>powodzeniem</strong>.
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width:100px;">Nazwa</th>
                                <th style="min-width:100px;">Tytuł</th>
                                <th>Treść</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM funnyweb_pages ORDER BY id DESC";
                            $stmt = $core->db->prepare($sql);
        					$stmt->execute();
        					$strony = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($strony as $strona){
                                ?>
                                <tr id="<?php echo $strona['id']; ?>">
                                    <th scope="row"><?php echo $strona['id']; ?></th>
                                    <td><?php echo $strona['name']; ?></td>
                                    <td><?php echo $strona['title']; ?></td>
                                    <td><button type="button" class="btn btn-info btn-sm mb5" data-toggle="modal" data-target="#zobacz<?php echo $strona['id']; ?>"><i class="fa fa-envelope-o"></i> Podgląd</button></td>
                                    <td><a href="<?php echo $core->webUrl; ?>admin/strony/edycja/<?php echo $strona['id']; ?>"><button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Edytuj</button></a> <button type="button" class="btn btn-danger btn-sm mb5" data-toggle="modal" data-target="#usun<?php echo $strona['id']; ?>"><i class="fa fa-trash-o"></i> Usuń</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if(count($strony) == 0){
                        ?><tr><h5 class="text-center">Nie znaleziono rekordów w bazie danych</h5></tr><?php
                    }
                    ?>
                    <div class="col-sm-2 offset-9">
                        <a href="<?php echo $core->webUrl; ?>admin/strony/stworz"><button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Stwórz nową podstronę</button></a>
                    </div>
                </div>
            </div>
        </div>
<?php
foreach($strony as $strona){
?>
<div class="modal fade" id="usun<?php echo $strona['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Napewno usunąć ? </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p>Czy napewno chcesz usunąc podstronę <strong><?php echo $strona['name']; ?> (id: <?php echo $strona['id']; ?>)</strong> ?<br />
                       Ta czynnośc jest nie odrwacalna, więc zastanów się dwa razy
                   </p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                   <form method="post">
                       <input name="id" value="<?php echo $strona['id']; ?>" hidden="true" />
                       <input name="tab" value="custom_pages/delete" hidden="true" />
                       <button name="submit" value="submit" type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Usuń</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <div class="modal fade" id="zobacz<?php echo $strona['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title"><?php echo $strona['title']; ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p><?php echo $pages->format($strona['text']); ?></p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                  </div>
              </div>
          </div>
      </div>
<?php
}
?>
