<?php
require_once('application/core.php');
$core->top();

if(isset($_GET['name']) && !empty($_GET['name'])){

    $strona = $pages->get($_GET['name']);
    if(!is_array($strona)){
        header("Location: ".$core->webUrl);
        exit();
    }
} else {
    header("Location: ".$core->webUrl);
    exit();
}
?>

<div class="container mb50">
    <div class="title-heading1 mb30">
        <h3><?php echo $strona['title']; ?></h3>
    </div>
    <p><?php echo $pages->format($strona['text']); ?></p>
</div>

<?php
$core->footer();
?>
