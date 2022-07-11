<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Правка меню на <?=htmlentities($menu->date)?></h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <form action="" method="post" class="form-width">
                <input type="hidden" name="csrf" value="<?=$csrf?>">
                <div class="menu js-menu-container my-5"></div>
                <div class="menu-controls">
                    <button class="btn btn-success btn-sm js-add-group">Добавить группу</button>
                </div>

                <div class="footer fixed-bottom py-3 bg-light border-top">
                    <div class="container">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <a href="admin" class="btn btn-secondary">Закрыть</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <template id="menu-group">
        <div class="row my-2 align-items-center">
            <div class="col-auto">
                <input type="text" placeholder="Заголовок группы" class="form-control" name="groups[%group%][name]">
            </div>
        </div>
        <div class="js-menu-positions">
        </div>
        <div class="menu-controls">
            <button class="btn btn-success btn-sm js-add-position" data-num="%group%" type="button">Добавить позицию</button>
        </div>
    </template>

    <template id="menu-position">
        <div class="row my-2 lign-items-center">
            <div class="col-6">
                <input type="text" placeholder="Название блюда" class="form-control" name="groups[%group%][positions][%pos%][name]">
            </div>
            <div class="col-2">
                <input type="text" placeholder="Выход" class="form-control" name="groups[%group%][positions][%pos%][weight]">
            </div>
            <div class="col-2">
                <input type="number" placeholder="Цена в руб." class="form-control" name="groups[%group%][positions][%pos%][price]">
            </div>
        </div>
    </template>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/admin.js']]]); ?>