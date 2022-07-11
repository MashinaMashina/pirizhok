<div class="js-position-container">
    <div class="row my-2 lign-items-center">
        <div class="col-6">
            <input type="text" placeholder="Название блюда" class="form-control"
                   name="groups[<?=$groupId?>][positions][<?=$positionId?>][name]" value="<?=htmlentities($positionName ?? '')?>">
        </div>
        <div class="col-2">
            <input type="text" placeholder="Выход" class="form-control"
                   name="groups[<?=$groupId?>][positions][<?=$positionId?>][weight]" value="<?=htmlentities($positionWeight ?? '')?>">
        </div>
        <div class="col-2">
            <input type="number" placeholder="Цена в руб." class="form-control"
                   name="groups[<?=$groupId?>][positions][<?=$positionId?>][price]" value="<?=htmlentities($positionPrice ?? '')?>">
        </div>
    </div>
</div>
