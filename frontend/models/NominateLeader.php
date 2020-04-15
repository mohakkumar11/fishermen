<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nominated_leader".
 *
 * @property int $id
 * @property string $name
 */
class NominateLeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nominated_leader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
			[['id', 'country', 'category', 'leader_name', 'total_nominated'], 'safe'],
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
            'country' => 'country',
			'category' => 'category',
			'leader_name' => 'Leader Name',
			'total_nomincated' => 'total_nomincated'
        ];
    }
}
