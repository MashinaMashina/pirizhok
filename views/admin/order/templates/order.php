<div class="js-group-container">
    <div class="row my-2 align-items-center">
        <div class="col-auto">
            Заказчик: <b><?=htmlentities($order->user_name ?? 'без имени')?></b>
            <span class="text-muted"><?=$order->sum?> руб.</span>
        </div>
    </div>
    <div class="js-menu-positions">
        <?if (!empty($order->positions)):?>
            <? foreach ($order->positions as $k => $position): ?>
                <?$this->render('admin/order/templates/position', [
                    'companyId' => $companyId ?? 0,
                    'orderId' => $order->id,
                    'positionId' => $k,
                    'position' => $position,
                ])?>
            <?endforeach;?>
        <?endif;?>
    </div>
    <div class="menu-controls">
        <button class="btn btn-light btn-sm js-add-position" data-num="<?=$companyId ?? 0?>" data-order="<?=$order->id?>" type="button">Добавить позицию</button>
    </div>
</div>
