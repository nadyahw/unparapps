<?php

namespace frontend\controllers\v3;
use Yii;
use yii\rest\ActiveController;
use common\models\Directory;
use yii\data\ActiveDataProvider;

class DirectoryController extends ActiveController{
    public $modelClass = 'common\models\Directory';

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
        $category = Yii::$app->request->get('category_id');
        $activeData = new ActiveDataProvider([
            'query' => Directory::find()->where(['category_id'=>$category])->orderBy('name'),
            'pagination' => [
                'defaultPageSize' => 2,
            ]
        ]);
        return $activeData;
    }
}
