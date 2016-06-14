<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directory".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $office_hour
 * @property string $note
 * @property string $photo
 * @property integer $category_id
 *
 * @property Category $category
 */
class Directory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'office_hour'], 'required'],
            [['address', 'note'], 'string'],
            [['category_id'], 'integer'],
            [['name', 'phone', 'office_hour', 'photo'], 'string', 'max' => 255]
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
            'address' => 'Address',
            'phone' => 'Phone',
            'office_hour' => 'Office Hour',
            'note' => 'Note',
            'photo' => 'Photo',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
