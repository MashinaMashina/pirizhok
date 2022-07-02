        <script src="<?=BASE_DIR?>assets/vendor/bootstrap/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <?php foreach ($scripts as $script): ?>
            <script<?=$this->formatter->buildTagProperty($script);?>></script>
        <?php endforeach; ?>
    </body>
</html>