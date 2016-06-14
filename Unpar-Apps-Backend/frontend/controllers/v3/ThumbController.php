<?php
namespace frontend\controllers\v3;

use yii\rest\ActiveController;

class ThumbController extends ActiveController{
    public $modelClass = 'common\models\LikeStatus';
    private $code = 'common\models\Gadget';

}
