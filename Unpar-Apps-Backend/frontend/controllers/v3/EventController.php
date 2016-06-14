<?php

namespace frontend\controllers\v3;

use yii\rest\ActiveController;
use common\models\Event;
use yii\data\ActiveDataProvider;

class EventController extends ActiveController{
    public $modelClass = 'common\models\Event';

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
            'query' => Event::find()->where('start_date >= CURDATE()', ['status'=>'1'])->orderBy('start_date ASC'),
            'pagination' => [
                'defaultPageSize' => 3,
            ]
        ]);
        return $activeData;
    }
}
