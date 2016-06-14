<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use common\models\Category;
use yii\data\ActiveDataProvider;

class CategoryController extends ActiveController{
    public $modelClass = 'common\models\Category';

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
            'query' => Category::find()->orderBy('name'),

        ]);
        return $activeData;
    }
}
