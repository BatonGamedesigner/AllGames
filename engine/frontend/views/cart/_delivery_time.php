<?php

$checked = 0;
$deliveryTimes = \backend\models\OrderTime::find()->select('value')->column();
?>
<? if (!empty($deliveryTimes)): ?>

        <? foreach ($deliveryTimes as $i => $time): ?>
            <? $params = null ?>
            <? if (!empty($curTimes) && in_array($time, $curTimes))
            {
                $params = 'disabled';
                $checked += 1;
            } elseif ($i == $checked) {
                $params = 'checked';
            }
            ?>
            <div class="input-quantity-list__item">
                <div class="input-quantity">
                    <input id="quantity-<?= $i ?>" class="input-quantity__input time" type="radio" name="time" value="<?= $time ?>"
                            <?= $params ?>>
                    <label for="quantity-<?= $i ?>" class="input-quantity__label"><?= $time ?></label>
                </div>
            </div>
        <? endforeach; ?>

<? endif; ?>