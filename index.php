<?php require_once __DIR__.'/views/config/sessionAuth.php' ?>
<?php require __DIR__.'/views/blocs/doctype.php' ?>

<div>
<?php
$string = "j'adore la musique française énervée de_la_mort_qui tue !";
$crypto = crypto($string);
echo $crypto .'<br>';
echo decrypto($crypto)
?>
</div>

<div class="my-5">
    <code>
    <?php var_dump($_SESSION) ?>
    </code>
</div>

<div>
<a href="<?= $path ?>generate_pdf.php" target="_blank" class="btn btn-primary">générer un pdf</a>
</div>


<?php require __DIR__.'/views/blocs/footer.php' ?>
<?php require __DIR__.'/views/blocs/end.php' ?>
