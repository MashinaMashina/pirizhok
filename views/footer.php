        <script src="<?=BASE_DIR?>assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?=BASE_DIR?>assets/utils.js"></script>
        <?php foreach ($scripts as $script): ?>
            <script<?=$this->formatter->buildTagProperty($script);?>></script>
        <?php endforeach; ?>
    </body>
</html>