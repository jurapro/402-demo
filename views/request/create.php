<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = 'Формирование заявления';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
