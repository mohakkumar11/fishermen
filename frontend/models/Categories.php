<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $countryId
 * @property string $status
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'countryId'], 'required'],
            [['countryId'], 'integer'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'countryId' => 'Country',
            'status' => 'Status',
        ];
    }
	public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'countryId']);
    }
}
