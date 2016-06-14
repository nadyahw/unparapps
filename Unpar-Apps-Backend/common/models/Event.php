<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $start_date
 * @property string $end_date
 * @property string $notif_date
 * @property string $place
 * @property integer $status
 * @property string $img
 */
class Event extends \yii\db\ActiveRecord
{
    const STATUS_AKTIF =1;
    const STATUS_TIDAK =0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'start_date', 'status'], 'required'],
            [['start_date', 'end_date', 'notif_date', 'organizer'], 'safe'],
            [['status'], 'integer'],
            [['title', 'content', 'place', 'img'], 'string', 'max' => 255],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'notif_date' => 'Notif Date',
            'place' => 'Place',
            'status' => 'Status',
            'img' => 'Img',
        ];
    }
}
