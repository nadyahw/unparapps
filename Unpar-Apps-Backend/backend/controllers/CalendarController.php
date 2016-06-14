<?php

namespace backend\controllers;

use Yii;
use common\models\Calendar;
use common\models\CalendarSearch;
use common\models\Gadget;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CalendarController implements the CRUD actions for Calendar model.
 */
class CalendarController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['push'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Calendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CalendarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Calendar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Calendar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Calendar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Calendar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Calendar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPush(){
        $models = Calendar::find()->where(['notif_date' => date('Y-m-d')])->all();
        $tokens = Gadget::find()->all();
        foreach($tokens as $token){
            foreach($models as $model){
                $start_date = date('d M Y', strtotime($model->start_date));
                $date = $start_date;
                if($model->end_date != null){
                    $end_date = date('d M Y', strtotime($model->end_date));
                    $date .= " s/d " . $end_date;
                }
                if($token->type == 'ios'){
                    Yii::$app->apnsGcm->send(\bryglen\apnsgcm\ApnsGcm::TYPE_APNS, $token->code, $date, [
                        'start_date' => $model->start_date,
                        'end_date' => $model->end_date,
                        'note' => $model->note,
                        'title' => $model->name,
                        'url' => '#/kalendar',
                    ], [
                        //'timeToLive' => 3,
                        'sound' => 'default',
                        'badge' => 1,
                    ]);
                }else{
                    Yii::$app->apnsGcm->send(\bryglen\apnsgcm\ApnsGcm::TYPE_GCM, $token->code, $date, [
                        'start_date' => $model->start_date,
                        'end_date' => $model->end_date,
                        'note' => $model->note,
                        'title' => $model->name,
                        'url' => '#/kalendar',
                    ], [
                        'timeToLive' => 3,
                    ]);
                }

                echo $token->code."<br>";
            }
        }
    }

    /**
     * Finds the Calendar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calendar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Calendar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
