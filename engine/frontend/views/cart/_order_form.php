<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $order backend\models\Order */
/* @var $form ActiveForm */


//
//$this->registerJsFile('https://www.google.com/recaptcha/api.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\YiiAsset']);

?>
<!-- order-form start -->
<?php $form = ActiveForm::begin(['options' => ['class' => "form"]]); ?>
    <section class="page__sheet page__section-main">
        <h2 class="title title_top">Оформление заказа</h2>
        <h3 class="title title_size_s">Введите ваши данные</h3>
        <div class="page__section-xs">
            <div class="form form_size_m">
                <div class="form__field">
                    <?= $form->field($order, 'fio')
                        ->textInput(['placeholder' => 'ФИО*'])
                        ->label(false);
                    ?>
                </div>
                <div class="form__field">
                    <?= $form->field($order, 'tel')
                        ->textInput(['placeholder' => 'Ваш телефон*'])
                        ->label(false);
                    ?>
                </div>
                <div class="form__field">
                    <?= $form->field($order, 'address')
                        ->textInput(['placeholder' => 'Ваш адрес', 'id' => 'suggest'])
                        ->label(false);
                    ?>
                </div>
                <div class="form__field">
                    <?= $form->field($order, 'text')
                        ->textarea(['placeholder' => 'Комментарий к заказу здесь вы можете указать информацию о получателе: этаж, код от домофона или любую полезную информацию для нас ', 'rows' => 6])
                        ->label(false);
                    ?>
                </div>
                <div class="form__field">
                    <?= $form->field($order, 'agree',
                        [
                            'template' => '<div class="checkbox">{input}{label}</div>{hint}{error}',
                        ])
                        ->checkbox([
                            'class' => 'checkbox__input',
                            'id' => 'agreement',
                        ], false)
                        ->label('Я согласен(а) на обработку <a class="link" href="' . $this->params[Page::PAGE_PREFIX . Page::PRIVACY]['linkOut'] . '">персональных данных.</a>', ['class' => 'checkbox__label', 'for' => 'agreement']); ?>
                </div>
            </div>
        </div>
        <div class="page__section-l">
            <h3 class="title title_size_s">Способ доставки</h3>
            <div class="page__section-xs">
                <div class="methods">
                    <div class="methods__item">
                        <input class="methods__input" id="delivery-self" name="Order[delivery]" value="1" type="radio" checked>
                        <label class="methods__label" for="delivery-self">
                            <div class="type">
                                <div class="type__title">
                                    Самовывоз (только г. Пенза)
                                </div>
                                <div class="type__container">
                                    <img class="type__image" src="/img/type__image_self.jpg" alt="Самовывоз">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="methods__item methods__item_large">
                        <input class="methods__input" id="delivery-company" name="Order[delivery]" value="2" type="radio">
                        <label class="methods__label" for="delivery-company">
                            <div class="type">
                                <div class="type__title">
                                    Транспортная компания
                                </div>
                                <div class="type__container type__container_complex">
                                    <div class="type__column">
                                        <img class="type__image" src="/img/type__image_pek.png" alt="ПЭК">
                                    </div>
                                    <div class="type__column">
                                        <img class="type__image" src="/img/type__image_del-linii.png"
                                             alt="Деловые линии">
                                    </div>
                                    <div class="type__column">
                                        <img class="type__image" src="/img/type__image_zheldor.png"
                                             alt="Желдорэкспедиция">
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>
        <div class="page__section-l">
            <h3 class="title title_size_s">Оплата заказа</h3>
            <div class="page__section-xs">
                <table class="checklist">
                    <tr class="checklist__row checklist__row_top">
                        <td class="checklist__cell">Всего в корзине:</td>
                        <td id="total-count"
                            class="checklist__cell"><?= \backend\models\Base::goodsInclination($_SESSION['cart']['total_count']) ?></td>
                    </tr>
                    <tr class="checklist__row">
                        <td class="checklist__cell">Общая сумма:</td>
                        <td class="checklist__cell">
                                <span id="total-price"
                                      class="price"><?= number_format($_SESSION['cart']['total_sum'], 0, '', '&nbsp;') ?>&nbsp;р.</span>
                        </td>
                    </tr>
                </table>
            </div>
            <?= Html::submitButton('Оформить заказ', ['class' => 'button']) ?>
            <div class="page__section-xs">
                <div class="info-label">
                    Наш менеджер свяжется с Вами, уточнит информацию и выставит счёт для оплаты любым удобным для
                    Вас способом.
                </div>
            </div>
        </div>
    </section>
<?php ActiveForm::end(); ?>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU&amp;load=SuggestView&amp;onload=onLoad"></script>
<script>
    function onLoad(ymaps) {
        var suggestView = new ymaps.SuggestView('suggest');
    }
</script>
<!-- order-form end -->