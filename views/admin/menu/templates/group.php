<div class="js-group-container">
    <div class="row my-2 align-items-center">
        <div class="col-auto">
            <input type="text" placeholder="Заголовок группы" class="form-control"
                   name="groups[<?=$groupId?>][name]" value="<?=htmlentities($groupName ?? '')?>">
        </div>
    </div>
    <div class="js-menu-positions">
        <?if (!empty($positions)):?>
            <? $i = -10000; foreach ($positions as $position): $i--;?>
                <?$this->render('admin/menu/templates/position', [
                    'groupId' => $groupId,
                    'positionId' => $position->id ?? $i,
                    'positionName' => $position->name ?? '',
                    'positionPrice' => $position->price ?? '',
                    'positionWeight' => $position->weight ?? '',
                ])?>
            <?endforeach;?>
        <?endif;?>
    </div>
    <div class="menu-controls">
        <button class="btn btn-success btn-sm js-add-position" data-num="<?=$groupId?>" type="button">Добавить позицию</button>
    </div>
</div>
