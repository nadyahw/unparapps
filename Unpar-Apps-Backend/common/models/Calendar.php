<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $notif_date
 * @property string $note
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_date'], 'required'],
            [['start_date', 'end_date', 'notif_date'], 'safe'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'notif_date' => 'Notif Date',
            'note' => 'Note',
        ];
    }
}
