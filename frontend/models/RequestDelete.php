<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request_delete".
 *
 * @property int $id
 * @property string $name
 */
class RequestDelete extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_delete';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
			[['id', 'fid', 'pid'], 'safe'],
            //[['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fid' => 'Followers id',
			'pid' => 'Post id',
        ];
    }
}
