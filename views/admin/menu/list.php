<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Список меню</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <a href="<?=BASE_DIR?>admin/menu/edit" class="btn btn-success btn-sm mb-3">Добавить меню</a><br>

            <?foreach ($menus as $menu):?>
                <a href="<?=BASE_DIR?>admin/menu/edit/<?=intval($menu->id)?>"><?=htmlentities($menu->date)?></a>
                <span class="text-muted">обновлено <?=date('Y-m-d', $menu->updated_at ?? 0)?></span><br>
            <?endforeach;?>
        </div>
    </main>

<?php $this->footer(); ?>