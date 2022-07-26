<div class="js-position-container">
    <div class="row my-2 lign-items-center">
        <div class="col-6">
            <input type="text" placeholder="Название блюда" class="form-control"
                   name="orders[<?=$companyId?>][<?=$orderId?>][<?=$positionId?>][name]"
                   value="<?=htmlentities($position->name ?? '')?>">
        </div>
        <div class="col-2">
            <input type="text" placeholder="Выход" class="form-control"
                   name="orders[<?=$companyId?>][<?=$orderId?>][<?=$positionId?>][weight]"
                   value="<?=htmlentities($position->weight ?? '')?>">
        </div>
        <div class="col-2">
            <input type="number" placeholder="Цена в руб." class="form-control"
                   name="orders[<?=$companyId?>][<?=$orderId?>][<?=$positionId?>][price]"
                   value="<?=htmlentities($position->price ?? '')?>">
        </div>
        <div class="col-2">
            <input type="number" placeholder="кол-во" class="form-control"
                   name="orders[<?=$companyId?>][<?=$orderId?>][<?=$positionId?>][count]"
                   value="<?=htmlentities($position->count ?? 1)?>" step="0.01">
        </div>
    </div>
</div>
