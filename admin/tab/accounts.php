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
                        <h3>ADMINISTRATORZY</h3>
                    </div>
                    <div id="nie_usunieto" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                      </button>
                      <strong>Błąd!</strong><br />Nie możesz sam siebie usunąc z listy <strong>administratorów</strong>.
                    </div>
                    <div id="usunieto" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                      </button>
                      <strong>Usunięto!</strong><br />Administrator został usunięty z <strong>powodzeniem</strong>.
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width:100px;">Nazwa użytkownika</th>
                                <th style="min-width:100px;">Hasło</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM funnyweb_admins ORDER BY id ASC";
                            $stmt = $core->db->prepare($sql);
        					$stmt->execute();
        					$admini = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($admini as $user){
                                ?>
                                <tr id="<?php echo $user['id']; ?>">
                                    <th scope="row"><?php echo $user['id']; ?></th>
                                    <td><img src="https://minotar.net/avatar/<?php echo $user['username']; ?>/23"> <?php echo $user['username']; ?></td>
                                    <td><?php echo "***********"; ?></td>
                                    <td><button type="button" class="btn btn-danger btn-sm mb5" data-toggle="modal" data-target="#usun<?php echo $user['id']; ?>"><i class="fa fa-trash-o"></i> Usuń</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if(count($user) == 0){
                        ?><tr><h5 class="text-center">Nie znaleziono rekordów w bazie danych</h5></tr><?php
                    }
                    ?>
                    <div class="col-sm-2 offset-9">
                        <a href="<?php echo $core->webUrl; ?>admin/konta/stworz"><button type="button" class="btn btn-primary btn-sm mb5"><i class="fa fa-edit"></i> Dodaj administratora</button></a>
                    </div>
                </div>
            </div>
        </div>
<?php
foreach($admini as $user){
?>
<div class="modal fade" id="usun<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Napewno usunąć ? </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p>Czy napewno chcesz usunąc administratora <strong><?php echo $user['username']; ?> (id: <?php echo $user['id']; ?>)</strong> ?<br />
                       Ta czynnośc jest nie odrwacalna, więc zastanów się dwa razy
                   </p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                   <form method="post">
                       <input name="id" value="<?php echo $user['id']; ?>" hidden="true" />
                       <input name="tab" value="accounts/delete" hidden="true" />
                       <button name="submit" value="submit" type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Usuń</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
<?php
}
?>
