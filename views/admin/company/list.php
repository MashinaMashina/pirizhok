<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Список компаний</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <a href="<?=BASE_DIR?>admin/company/edit" class="btn btn-success btn-sm mb-3">Добавить компанию</a><br>

            <?foreach ($companies as $company):?>
                <a href="<?=BASE_DIR?>admin/company/edit/<?=intval($company->id)?>"><?=htmlentities($company->name)?></a>
                <br/>
            <?endforeach;?>
        </div>
    </main>

<?php $this->footer(); ?>