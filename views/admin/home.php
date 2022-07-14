<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Панель администратора</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin/menu">Управление меню</a></li>
                <li><a href="<?=BASE_DIR?>admin/order">Управление заказами</a></li>
                <li><a href="<?=BASE_DIR?>admin/info">Управление информацией</a></li>
                <li><a href="<?=BASE_DIR?>admin/company">Управление компаниями</a></li>
            </ul>
        </div>
    </main>

<?php $this->footer(); ?>