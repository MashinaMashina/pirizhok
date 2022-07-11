<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]);

?>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <?$this->render('banner')?>

            <div class="menu my-5">
                <h2><?=$message ?? 'Меню не доступно'?></h2>
            </div>
        </div>
    </main>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/menu.js']]]); ?>