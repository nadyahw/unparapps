<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $thumbnail
 * @property string $tipe
 * @property string $create_date
 * @property string $update_date
 */
class News extends \yii\db\ActiveRecord
{
    const TIPE_EVENT =0;
    const TIPE_BEASISWA =1;
    const STATUS_AKTIF =1;
    const STATUS_TIDAK =0;
    public $imageFiles;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content','status','tipe'], 'required'],
            [['content'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            // [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['title', 'thumbnail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'thumbnail' => 'Thumbnail',
            'tipe'=>'Tipe',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'status'=>'Status',
        ];
    }

    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->create_date = date('Y-m-d H:i:s');

        }else{
            $this->update_date = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
