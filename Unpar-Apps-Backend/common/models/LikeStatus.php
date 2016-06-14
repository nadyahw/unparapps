<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "like_status".
 *
 * @property integer $id
 * @property integer $id_aspirasi
 * @property integer $id_gadget
 * @property integer $status
 *
 * @property Aspiration $idAspirasi
 * @property Gadget $idGadget
 */
class LikeStatus extends \yii\db\ActiveRecord
{
    const LIKE =1;
    const DISLIKE =0;
    public $code;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_aspirasi', 'status','code'], 'required'],
            [['id_aspirasi', 'id_gadget', 'status'], 'integer'],
            [['id_aspirasi'], 'exist', 'skipOnError' => true, 'targetClass' => Aspiration::className(), 'targetAttribute' => ['id_aspirasi' => 'id']],
            [['id_gadget'], 'exist', 'skipOnError' => true, 'targetClass' => Gadget::className(), 'targetAttribute' => ['id_gadget' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aspirasi' => 'Id Aspirasi',
            'id_gadget' => 'Id Gadget',
            'status' => 'Status',
        ];
    }


    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $gadget =Gadget::find()->where(['code' => $this->code])->all();
                if(isset($gadget[0])){
                    $this->id_gadget = $gadget[0]->id;
                }else{
                    return false;
                }
                $aspirasi=self::find()->where(['id_gadget'=>$this->id_gadget,'id_aspirasi'=>$this->id_aspirasi])->all();

                if(count($aspirasi)==0){
                    return true;
                }else{
                    if($this->status == $aspirasi[0]->status){
                        $aspirasi[0]->delete();
                        return false;
                    }else{
                      $aspirasi[0]->delete();
                      return true;
                    }
                }
            }
        }


        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAspirasi()
    {
        return $this->hasOne(Aspiration::className(), ['id' => 'id_aspirasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGadget()
    {
        return $this->hasOne(Gadget::className(), ['id' => 'id_gadget']);
    }
}
