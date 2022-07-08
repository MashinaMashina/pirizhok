        <script src="<?=BASE_DIR?>assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
        <?php foreach ($scripts as $script): ?>
            <script<?=$this->formatter->buildTagProperty($script);?>></script>
        <?php endforeach; ?>
    </body>
</html>