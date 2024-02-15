<?php

namespace app\controllers;

use app\models\Request;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['*'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'success', 'cancel'],
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return \Yii::$app->user->identity->isAdmin();
                            }
                        ],
                    ],
                ],
            ]
        );
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find(),

            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSuccess($id)
    {
        $model = $this->findModel($id);

        if ($model->status->code==='new') {
            $model->status_id = 2;
            $model->save();
        }

        return $this->redirect('index');
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($model->status->code==='new') {
            $model->status_id = 3;
            $model->save();
        }

        return $this->redirect('index');
    }

    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
