<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aspiration".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $create_date
 * @property string $img
 *
 * @property LikeStatus[] $likeStatuses
 */
class Aspiration extends \yii\db\ActiveRecord
{
    const STATUS_AKTIF =1;
    const STATUS_TIDAK =0;
    public $like;
    public $dislike;
    public $img_base64;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aspiration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['status','create_date','like','dislike','img_base64'], 'safe'],
            [['name', 'content', 'img'], 'string', 'max' => 255],
        ];
    }

    public function fields(){
        $parent = parent::fields();
        array_push($parent, 'like');
        array_push($parent, 'dislike');
        $parent['img_url'] = function(){
            return "http://wilianto.com/Unpar-Apps-Backend/frontend/web/".$this->img;
        };
        return $parent;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'create_date' => 'Create Date',
            'img' => 'Img',
            'status'=>'Status',
            'like'=>'Like',
            'dislike'=>'Dislike',
        ];
    }

    public function afterFind(){
        $this->like =LikeStatus::find()->where(['status' =>LikeStatus::LIKE,'id_aspirasi'=>$this->id])->count();
        $this->dislike =LikeStatus::find()->where(['status' =>LikeStatus::DISLIKE,'id_aspirasi'=>$this->id])->count();
    }

    public function beforeSave($insert){
            if($this->isNewRecord){
                $this->create_date = date('Y-m-d H:i:s');
                $this->status = self::STATUS_AKTIF;
                $original_string = 'abcdefghijklmnopqrstuvwxyz';
                $random_string = substr(str_shuffle($original_string), 0, 5);
                if($this->img_base64 != ''){
                    $this->img = "aspiration_image/".date('YmdHis').$random_string.".jpg";
                }
            }else{
                $this->create_date = date('Y-m-d H:i:s');
            }
            return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes){
        // $data = 'img';
        if($this->img_base64 != ''){
        $data = base64_decode($this->img_base64);
            // $random_string = get_random_string($original_string, 4);
            file_put_contents($this->img, $data);
        }
        //cek file to save from script jpg injection
        // if(!empty($this->img)
        // && exif_imagetype($this->img) != IMAGETYPE_JPEG
        // && exif_imagetype($this->img) != IMAGETYPE_PNG
        // && exif_imagetype($this->img) != IMAGETYPE_GIF){
        //     unlink($this->img);
        // }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikeStatuses()
    {
        return $this->hasMany(LikeStatus::className(), ['id_aspirasi' => 'id']);
    }
}
