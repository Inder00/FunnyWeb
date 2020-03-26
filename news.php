<?php
require_once('application/core.php');
$core->top();
?>

<div class="container mb30">
    <div class="title-heading1 mb30">
        <h3>AKTUALNOŚCI</h3>
    </div>
    <div class="row">
        <div class="col-md-10 ml-auto mr-auto">
            <?php
            $sql = "SELECT * FROM funnyweb_news ORDER BY date DESC LIMIT 10";
            $stmt = $core->db->prepare($sql);
            $stmt->execute();
            $newsy = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num = count($newsy);
            foreach($newsy as $aktualnosc){
            ?>
            <article class="article-post mb70">
                <?php
                if(isset($aktualnosc['image']) && $aktualnosc['image'] != ""){?>
                    <div class="post-thumb mb30">
                        <img src="<?php echo $aktualnosc['image']; ?>" alt="" class="img-fluid">
                    </div>
                <?php
                }
                ?>
                <div class="post-content text-center">
                    <h2 class="post-title"><?php echo $aktualnosc['title']; ?></h2>
                    <p><?php echo $news->format($aktualnosc['text']); ?></p>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <img src="hhttps://minotar.net/avatar/<?php echo $aktualnosc['username']; ?>?size=16"> <?php echo $news->format($aktualnosc['username']); ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o"></i> <?php echo date("m.d.Y H:i", $aktualnosc['date']); ?>
                        </li>
                    </ul>
                </div>
            </article>
            <?php
            }
            if($num == 0){
                ?><h3 class="text-center"><i class="fa fa-search"></i> Nie znaleziono rekordów w bazie danych</h3><?php
            }
            ?>
        </div>
    </div>
</div>

<?php
$core->footer();
?>
