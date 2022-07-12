<?php $this->header(['styles' => [['href' => BASE_DIR . 'assets/admin.css']]]); ?>

    <main class="flex-shrink-0">
        <div class="container content-container">
            <h2 class="mt-5">Список меню</h2>

            <ul>
                <li><a href="<?=BASE_DIR?>admin">Панель администратора</a></li>
            </ul>

            <?foreach ($orders as $order):?>
                <a href="<?=BASE_DIR?>admin/order/edit/<?=intval($order->menu_id)?>"><?=htmlentities($order->date)?></a>
                <? if (!$order->confirm): ?>
                    <span class="text-danger">Есть не подтвержденные заказы</span>
                <? else: ?>
                    <span class="text-secondary">Подтверждено</span>
                <? endif; ?>
                <span class="text-muted">последний заказ <?=date('H:i d.m.Y', $order->updated_at ?? 0)?></span><br>
            <?endforeach;?>
        </div>
    </main>

<?php $this->footer(); ?>