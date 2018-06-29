<?php
use backend\models\Base;

?>
<? if ($ourTeams): ?>
    <section class="member section section_small">
        <div class="wrapper">
            <div class="title"><?= \Yii::t('app', 'Наша команда') ?></div>
            <div class="member__container">
                <? foreach ($ourTeams as $member): ?>
                    <div class="member__item">
                        <img class="member__icon" src="<?= $member->getSrcPhoto(['suffix' => '_sm', 'index' => 0]) ?>"
                             alt="<?= hp($member->name) ?>">
                        <div class="member__name"><?= hp($member->name) ?></div>
                        <div class="member__type"><?= hp($member->post) ?></div>
                        <div class="member__message">
                            <?= hp($member->anons) ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </section>
<? endif ?>