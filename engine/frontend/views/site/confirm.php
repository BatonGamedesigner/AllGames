<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Подтверждение регистрации';
$this->params['breadcrumbs'][] = $this->title;

/*$this->registerJs(<<<EOF

setTimeout(function(){
    document.getElementById("form-signup").reset();
}, 200);
EOF
);*/
?>

<h1><?=$this->title?></h1>
<section>

    <div class="h1">Вам на почту отправлено письмо для подтверждения регистрации</div>

    <p>Для теста сылка подтверждения:
        <a href="<?=Url::to(['site/confirmation', 'code'=>$user->code_signup])?>">
            Нажмите для подтверждения регистрации
        </a>
    </p>
</section>
