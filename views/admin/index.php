<?php

use app\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Панель администратора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ФИО заявителя',
                'value' => function ($data) {
                    return $data->user->getFullName();
                },
            ],
            [
                'label' => 'Изменить статус',
                'format' => 'html',
                'value' => function ($data) {
                    if ($data->status->code==='new') {
                        return Html::a('Подтвердить', ['admin/success', 'id' => $data->id], ['class' => 'profile-link'])." ".
                            Html::a('Отклонить', ['admin/cancel', 'id' => $data->id], ['class' => 'profile-link']);
                    }
                    return "Нельзя изменить статус";
                },
            ],
            'status.name',
            'auto_number',
            'text:ntext',
        ],
    ]); ?>


</div>
