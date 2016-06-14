<?php

namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use common\models\Calendar;
use yii\data\ActiveDataProvider;

class CalendarController extends ActiveController{
    public $modelClass = 'common\models\Calendar';

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
            	'Origin' => ['*'],
            	'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'X-Pagination-Page-Count'],
            ],
        ];
        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Calendar::find()->orderBy('start_date'),
            'pagination' => [
                'defaultPageSize' => 10,
            ]
        ]);
        return $activeData;
    }
}
