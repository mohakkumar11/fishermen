<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request_delete".
 *
 * @property int $id
 * @property string $name
 */
class FollowerDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follower_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
			[['id', 'LID', 'FID', 'postId'], 'safe'],
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
            'FID' => 'Followers id',
			'LID' => 'Leaders id',
        ];
    }
}
