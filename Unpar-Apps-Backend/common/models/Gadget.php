<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gadget".
 *
 * @property integer $id
 * @property string $code
 * @property string $type
 */
class Gadget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gadget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'type'], 'required'],
            [['code'], 'unique'],
            [['code', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'type' => 'Type',
        ];
    }
}
