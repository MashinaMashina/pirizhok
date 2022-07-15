<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]);

?>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <? $this->render('banner', [
                'info' => $info,
            ]); ?>

            <? if (!empty($company->name)): ?>
                <h2 class="mt-5">Ваша компания: <?= htmlspecialchars($company->name) ?></h2>
            <? endif; ?>

            <div class="menu my-5">
                <?
                $group_name = "";
                foreach ($menu->positions as $value) {
                    if ($value->group_name != $group_name) {
                        $group_name = $value->group_name;
                        echo "<h4 class='mt-4'>$value->group_name</h4>";
                    }
                    ?>
                    <div class='menu-item js-menu-item row border-bottom'>
                        <div class='col-sm-4 col-md-4  text-center text-md-start '>
                            <span class='fw-bold align-middle'><?= htmlentities($value->name) ?></span>
                        </div>
                        <div class='col-sm-8 col-md-8'>
                            <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                                <div class='col-auto'>
                                    <span class='form-text'>
                                        <span>
                                            <?= $value->price ?>
                                        </span> р.
                                    </span>
                                </div>
                                <div class='col-auto'>
                                    <span class='form-text'>
                                        <?= $value->weight ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                }
                ?>

                <? if (!empty($company->code)): ?>
                    <div class="my-5 text-center">
                        <a href="<?=BASE_DIR?>orders?company=<?=htmlentities($company->code)?>" class="btn btn-primary">
                            Открыть заказы
                        </a>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </main>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/menu.js']]]); ?>