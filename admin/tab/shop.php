<?php
if(!defined("IN_SCRIPT")){ exit("Error 403."); }
global $core;
global $pages;
global $admin;
global $user;
global $payments;
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb40">
                    <div class="title-heading1 mb30">
                        <h3>SKLEP</h3>
                    </div>
                    <div id="usunieto" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                      </button>
                      <strong>Usunięto!</strong><br />Usługa została usunięta z <strong>powodzeniem</strong>.
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width:70px;">Nazwa</th>
                                <th>Numer</th>
                                <th>Treść</th>
                                <th>Koszt</th>
                                <th style="min-width:120px;">ID Usługi SMS</th>
                                <th>Opis</th>
                                <th style="min-width:240px;">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM funnyweb_payments ORDER BY id ASC";
                            $stmt = $core->db->prepare($sql);
        					$stmt->execute();
        					$sklep = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($sklep as $usluga){
                                ?>
                                <tr id="<?php echo $usluga['id']; ?>">
                                    <th scope="row"><?php echo $usluga['id']; ?></th>
                                    <th><?php echo $usluga['name']; ?></th>
                                    <td><?php echo $usluga['number']; ?></td>
                                    <td><?php echo $usluga['content_sms']; ?></td>
                                    <td><?php echo $payments->getCost($usluga['number']) ?></td>
                                    <td><?php echo $usluga['service_id']; ?></td>
                                    <td><button type="button" class="btn btn-info btn-sm mb5" data-toggle="modal" data-target="#zobacz<?php echo $usluga['id']; ?>"><i class="fa fa-envelope-o"></i> Podgląd</button></td>
                                    <td><a href="<?php echo $core->webUrl; ?>admin/sklep/edycja/<?php echo $usluga['id']; ?>"><button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Edytuj</button></a> <button type="button" class="btn btn-danger btn-sm mb5" data-toggle="modal" data-target="#usun<?php echo $usluga['id']; ?>"><i class="fa fa-trash-o"></i> Usuń</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if(count($sklep) == 0){
                        ?><tr><h5 class="text-center">Nie znaleziono rekordów w bazie danych</h5></tr><?php
                    }
                    ?>
                    <div class="col-sm-2 offset-9">
                        <button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Stwórz nową usługę</button>
                        <a href="<?php echo $core->webUrl; ?>admin/sklep/stworz"><button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Stwórz nową usługę</button></a>
                    </div>
                </div>
            </div>
        </div>
<?php
foreach($sklep as $usluga){
?>
<div class="modal fade" id="usun<?php echo $usluga['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Napewno usunąć ? </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p>Czy napewno chcesz usunąc usługę <strong><?php echo $usluga['name']; ?> (id: <?php echo $usluga['id']; ?>)</strong> ?<br />
                       Ta czynnośc jest nie odrwacalna, więc zastanów się dwa razy
                   </p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                   <form method="post">
                       <input name="id" value="<?php echo $usluga['id']; ?>" hidden="true" />
                       <input name="tab" value="shop/delete" hidden="true" />
                       <button name="submit" value="submit" type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Usuń</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <div class="modal fade" id="zobacz<?php echo $usluga['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title"><?php echo $usluga['name']; ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p><?php echo $payments->format($usluga['description']); ?></p>
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
