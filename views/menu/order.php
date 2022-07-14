<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]); ?>
    <script>
        var csrf = '<?=\App\Support\Security::csrf()?>';
        var companyId = <?=$company->id?>;
        var menuId = <?=$menu->id?>;
    </script>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <?$this->render('banner', [
                'info' => $info,
            ]);?>

            <h2 class="mt-5">Ваша компания: <?=htmlspecialchars($company->name)?></h2>

            <div class="menu my-5">

                <?
                $group_name = "";
                foreach ($menu->positions as $value) {
                    if($value->group_name != $group_name){
                        $group_name = $value->group_name;
                        echo "<h4>$value->group_name</h4>";
                    }
                    echo "<div class='menu-item js-menu-item row'>
                    <div class='col-sm-12 col-md-4 mb-3 text-center text-md-start '>
                        <span data-group='$value->group_name' class='fw-bold align-middle js-item-name'>$value->name</span>
                    </div>
                    <div class='col-sm-12 col-md-2'>
                        <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                            <div class='col-auto'>
									<span class='form-text'>
									  <span class='js-item-price'>$value->price</span> р.
									</span>
                            </div><div class='col-auto'>
									<span class='form-text js-item-measure'>
                    за $value->weight 
									</span>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-6'>
                        <div class='row g-3 align-items-center justify-content-center justify-content-md-end '>
                            <div class='col-auto col-4'>
                                <input type='number' class='form-control js-item-count' placeholder='0'>
                            </div>
                            <div class='col-auto'>
									<span class='form-text'>
                    порций
									</span>
                            </div>
                            <div class='col-auto'>
                                <button type='button' class='btn btn-primary js-to-cart'>В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                ?>
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