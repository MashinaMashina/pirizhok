<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Управление компаниями</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <b><?=$message?></b>
            <form action="" method="post" class="form-width">
                <input type="hidden" name="csrf" value="<?=$csrf?>">
                <div class="mb-3">
                    <label for="info-title" class="form-label">Название компании</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="name"
                        id="info-title" 
                        placeholder="Столовая Пирожок" 
                        value=""
                    />
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary">
            </form>
        </div>
    </main>

<?php $this->footer(); ?>