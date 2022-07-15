<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]); $today = date('Y-m-d'); ?>
    <script>
        var csrf = '<?=\App\Support\Security::csrf()?>';
        var companyId = <?=$company->id?>
    </script>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <?$this->render('banner', [
                'info' => $info,
            ])?>

            <h2 class="mt-5">Ваша компания: <?=htmlspecialchars($company->name)?></h2>

            <div class="menu my-5">
                <? foreach($company->orders as $order) : ?>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <h5 class="d-inline">Заказчик: <?=$order->user_name?></h5>
                        <? if ($today != $order->date): ?>
                            <span class="text-muted">на <?=$order->date?></span>
                        <? endif; ?>
                        <? foreach($order->positions as $pos): ?>
                            <div class='menu-item js-menu-item row'>
                                <div class='col-sm-5 col-md-3 mb-3 text-center text-md-start '>
                                    <span class='fw-bold align-middle'><?=htmlentities($pos->name)?></span>
                                </div>
                                <div class='col-sm-4 col-md-2'>
                                    <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                                        <div class='col-auto'>
                                            <span class='form-text'>
                                                <span class='js-item-price'><?=$pos->price?></span> р.
                                            </span>
                                        </div>
                                        <div class='col-auto'>
                                            <span class='form-text js-item-measure'>
                                                <?=htmlentities($pos->weight)?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-3 col-md-2'>
                                    <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                                        <div class='col-auto'>
                                                <span class='form-text'>
                                                    <?=$pos->count?> порц.
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach ; ?>
                        <b>Итого: <?=$order->sum?> руб.</b>

                        <? if($order->confirm) : ?>
                            <p class="text-success">Заказ подтвержден</p>
                        <? endif ; ?>
                    </div>
                <? endforeach; ?>

                <b>Итого с компании: <?=$company->orders_sum?> руб.</b>

                <div class="my-3 text-center">
                    <a href="<?=BASE_DIR?>?company=<?=htmlentities($company->code)?>" class="btn btn-primary">
                        Открыть меню
                    </a>
                </div>
            </div>
        </div>
    </main>


<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/menu.js']]]); ?>