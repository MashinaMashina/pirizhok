<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Заказы на <?=htmlentities($menu->date)?></h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin/order">Заказы</a></li>
            </ul>

            <b><?=$message?></b>

            <form action="" method="post" class="form-width">
                <input type="hidden" name="csrf" value="<?=$csrf?>">
                <div class="menu js-menu-container my-5">
                    <? foreach ($groups as $id => $company): ?>
                        <?$this->render('admin/order/templates/company', [
                            'company' => $company,
                        ])?>
                    <?endforeach;?>
                </div>

                <div class="mb-6"></div>

                <div class="footer fixed-bottom py-3 bg-light border-top">
                    <div class="container">
                        <button type="submit" class="btn btn-success">Подтвердить</button>
                        <a href="/admin" class="btn btn-secondary">Закрыть</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <template id="menu-position">
        <?$this->render('admin/order/templates/position', [
            'companyId' => '%groupId%',
            'orderId' => '%orderId%',
            'positionId' => '%posId%',
        ])?>
    </template>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/admin.js']]]); ?>