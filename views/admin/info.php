<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Управление информацией</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <b><?=$message?></b>
            <form action="" method="post" class="form-width">
                <input type="hidden" name="csrf" value="<?=$csrf?>">
                <div class="mb-3">
                    <label for="info-title" class="form-label">Заголовок страницы</label>
                    <input type="text" class="form-control" name="title"
                           id="info-title" placeholder="Столовая Пирожок" value="<?=htmlentities($info->title)?>">
                </div>
                <div class="mb-3">
                    <label for="info-title" class="form-label">Описание</label>
                    <textarea class="form-control" name="description"><?=htmlentities($info->description)?></textarea>
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary">
            </form>
        </div>
    </main>

<?php $this->footer(); ?>