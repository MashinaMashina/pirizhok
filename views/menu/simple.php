<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]);

?>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <?$this->render('banner', [
                    'info' => $info,
                ]);?>

            <? if(!empty($company->name)): ?>
                <h2 class="mt-5">Ваша компания: <?=htmlspecialchars($company->name)?></h2>
            <?endif;?>

            <div class="menu my-5">
                <?
                $group_name = "";
                foreach ($menu->positions as $value) {
                    if($value->group_name != $group_name){
                        $group_name = $value->group_name;
                        echo "<h4 class='mt-4'>$value->group_name</h4>";
                    }
                    echo "<div class='menu-item js-menu-item row border-bottom'>
                            <div class='col-sm-4 col-md-4  text-center text-md-start '>
                                <span class='fw-bold align-middle js-item-name'>$value->name</span>
                            </div>
                            <div class='col-sm-8 col-md-8'>
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
                        </div>
                ";
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
            </div>
        </div>
    </footer>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


                    <div class="js-cart-positions">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success js-cart-confirm">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/menu.js']]]); ?>