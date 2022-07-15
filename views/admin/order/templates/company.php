<div class="js-group-container">
    <div class="row my-2 align-items-center">
        <div class="col-auto">
            <h3>Компания: <?=htmlentities($company->name ?? 'не указана')?></h3>
        </div>
    </div>
    <?if (!empty($company->orders)):?>
        <? foreach ($company->orders as $order):?>
            <?$this->render('admin/order/templates/order', [
                'companyId' => $company->id ?? 0,
                'order' => $order,
                'positions' => $order->positions ?? [],
            ])?>
        <?endforeach;?>
        <div class="float-end">
            <b>Итого: <?=$company->orders_sum?> руб.</b>
        </div>
        <div class="clearfix"></div>
    <?endif;?>
</div>
