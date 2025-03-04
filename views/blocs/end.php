<script src="<?= $path ?>node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?= $path ?>node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script type="module" src="<?= $path ?>js/main.js?v=<?= $noCacheFile ?>"></script>

<?php if(isAppDirectory()): ?>
    <script src="<?= $path ?>app/API/scorm_api.php"></script>
    <script src="<?= $path ?>app/API/SCORM_API.js"></script>
    <script type="module" src="<?= $path ?>app/js/main.js?v=<?= $noCacheFile ?>"></script>
<?php endif ?>

</body>
</html>