<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/styles.css']]]);
var_dump($menu);
?>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container main-container content-container">
            <div class="p-4 p-md-5 my-4 text-white rounded bg-dark top-img top-img">
                <div class="col-md-8 px-0">
                    <h1 class="display-4">Тут можно написать какой-то заголовок страницы</h1>
                    <p class="lead my-3">Тут можно написать какое-то длинное описание. Информация.  Информация.  Информация.  Информация.  Информация.  Информация. </p>
                </div>
            </div>

            <h2 class="mt-5">Ваша компания: ЦИТ Барс</h2>

            <div class="menu my-5">
                <h4>Холодные блюда</h4>

                <div class="menu-item js-menu-item row">
                    <div class="col-sm-12 col-md-4 mb-3 text-center text-md-start ">
                        <span class="fw-bold align-middle js-item-name">Рататуй (морковь, баклажан, кабачок, сельдерей, болгарский перец)</span>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="row g-3 align-items-center justify-content-center justify-content-md-end ">
                            <div class="col-auto">
									<span class="form-text">
									  <span class="js-item-price">58</span> р.
									</span>
                            </div><div class="col-auto">
									<span class="form-text js-item-measure">
									  за 100 гр.
									</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="row g-3 align-items-center justify-content-center justify-content-md-end ">
                            <div class="col-auto col-4">
                                <input type="number" class="form-control js-item-count" placeholder="0">
                            </div>
                            <div class="col-auto">
									<span class="form-text">
									  порций
									</span>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary js-to-cart">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                    <button type="button" class="btn btn-success js-open-cart" data-bs-toggle="modal" data-bs-target="#exampleModal">Оформить заказ</button>
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