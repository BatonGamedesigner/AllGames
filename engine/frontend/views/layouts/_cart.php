<?php

$count = $_SESSION['cart']['total_count'];
$sum = $_SESSION['cart']['total_sum'];
?>

<a class="badge" href="/cart/">
    <? if ($count > 0) : ?>
        <div class="badge__image badge__image_active">
            <div class="badge__number"><?= $count ?></div>
        </div>
        <div class="badge__label badge__label_small">Корзина: <?= number_format($sum, 0, '', '&nbsp;') ?>&nbsp;&#8381;
        </div>
    <? else: ?>
        <div class="badge__image">
            <svg class="badge__icon">
                <use xlink:href="#icon-shopping-cart"></use>
            </svg>
        </div>
        <div class="badge__label badge__label_small">Корзина: пуста</div>
    <? endif; ?>
</a>

