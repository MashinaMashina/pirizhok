<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); 
    $switch = "";
    if($menu->can_order == 1){
        $switch = "checked";
    }
?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container content-container">
            <? if($menu->id) : ?>
            <h2 class="mt-5">Правка меню на <?=htmlentities($menu->date)?></h2>
            <? else : ?>
            <h2 class="mt-5">Создание меню</h2>
            <? endif; ?>
            <ul>
                <li><a href="<?=BASE_DIR?>admin/menu">Меню</a></li>
            </ul>

            <b><?=$message?></b>
            <form action="" method="post" class="form-width">
                <input type="hidden" name="csrf" value="<?=$csrf?>">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="can_order" type="checkbox" id="switch" <?=$switch?> />
                    <label class="form-check-label" for="switch">Возможность заказа</label>
                </div>
                <? if(!$menu->id) :?>
                <input class="my-1" name="date" type="date" value="<?=htmlentities($menu->date)?>" />
                <? endif; ?>
                <div class="menu js-menu-container mb-5">
                    <? $i = 0; foreach ($groups as $groupName => $positions): $i++; ?>
                        <?$this->render('admin/menu/templates/group', [
                            'groupId' => $i,
                            'groupName' => $groupName,
                            'positions' => $positions,
                        ])?>
                    <?endforeach;?>
                </div>
                <div class="menu-controls mb-6">
                    <button class="btn btn-success btn-sm js-add-group">Добавить группу</button>
                </div>

                <div class="footer fixed-bottom py-3 bg-light border-top">
                    <div class="container">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <a href="/admin" class="btn btn-secondary">Закрыть</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <template id="menu-group">
        <?$this->render('admin/menu/templates/group', [
            'groupId' => '%group%',
        ])?>
    </template>

    <template id="menu-position">
        <?$this->render('admin/menu/templates/position', [
            'groupId' => '%group%',
            'positionId' => '%pos%',
        ])?>
    </template>

<?php $this->footer(['scripts' => [['src' => BASE_DIR . 'assets/admin.js']]]); ?>