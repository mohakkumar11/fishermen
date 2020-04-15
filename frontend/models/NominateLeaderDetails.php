<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nominated_leader".
 *
 * @property int $id
 * @property string $name
 */
class NominateLeaderDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nominated_leader_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
			[['id', 'nominated_leader_id', 'FID', 'addedon'], 'safe'],
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
