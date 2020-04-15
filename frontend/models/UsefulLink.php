<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "helplink".
 *
 * @property integer $id
 * @property string $url
 * @property string $zipcode
 */
class usefullink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helplink';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'zipcode'], 'required'],
            [['url', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'zipcode' => 'Zipcode',
        ];
    }
}
