<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]); ?>
    <script>
        var csrf = '<?=\App\Support\Security::csrf()?>';
        var companyId = <?=$company->id?>
    </script>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <?$this->render('banner')?>

            <h2 class="mt-5">Ваша компания: <?=htmlspecialchars($company->name)?></h2>

            <div class="menu my-5">

            <? foreach($orders as $order) : ?>
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <h5>Заказчик: <?=$order->user_name?></h5>
                    <? foreach($order->positions as $pos): ?>
                        <div class='menu-item js-menu-item row'>
                            <div class='col-sm-5 col-md-3 mb-3 text-center text-md-start '>
                                <span class='fw-bold align-middle js-item-name'><?=$pos->name?></span>
                            </div>
                            <div class='col-sm-4 col-md-2'>
                                <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                                    <div class='col-auto'>
                                            <span class='form-text'>
                                            <span class='js-item-price'><?=$pos->price?></span> р.
                                            </span>
                                    </div><div class='col-auto'>
                                            <span class='form-text js-item-measure'>
                            <?=$pos->weight?> 
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
                    <? if($order->confirm == 1) : ?>
                        <p class="text-success">Заказ подтвержден</p>
                    <? endif ; ?>
                </div>
            <? endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="footer fixed-bottom py-3 bg-light border-top">
        <div class="container main-container">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="d-flex align-items-center me-auto fw-bold js-cart-count">
                    В корзине нет заказов
                </div>

                <div>
                    <button type="button" class="btn btn-success js-open-cart" data-bs-toggle="modal" data-bs-target="#orderModal">Оформить заказ</button>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подтверждение заказа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Имя и фамилия заказывающего:</label>
                        <input type="text" class="form-control" id="username" placeholder="Иван Ж.">
                    </div>

                    <div class="js-cart-positions"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success js-cart-confirm">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ваш заказ успешно оформлен</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/menu.js']]]); ?>