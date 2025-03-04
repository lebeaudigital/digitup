<?php require_once __DIR__.'/views/config/sessionAuth.php' ?>
<?php require __DIR__.'/views/blocs/doctype.php' ?>

<?php
$string = "j'adore la musique française énervée de_la_mort_qui tue !";
echo removeAccents($string);
?>

<?php require __DIR__.'/views/blocs/footer.php' ?>
<?php require __DIR__.'/views/blocs/end.php' ?>
