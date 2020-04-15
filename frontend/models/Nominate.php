<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request_delete".
 *
 * @property int $id
 * @property string $name
 */
class Nominate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nominate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
			[['id', 'leaderID', 'followerID'], 'safe'],
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
            'followerID' => 'Followers id',
			'leaderID' => 'Leaders id',
        ];
    }
}
