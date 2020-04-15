<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $featuredimage
 * @property string $metatitle
 * @property string $metakeywords
 * @property string $metadescription
 * @property string $status
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description', 'status'], 'string'],
			 [['title', 'description', 'featuredimage', 'metatitle', 'metakeywords', 'metadescription'], 'safe'],
            [['title', 'featuredimage', 'metatitle', 'metakeywords', 'metadescription'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'featuredimage' => 'Featuredimage',
            'metatitle' => 'Metatitle',
            'metakeywords' => 'Metakeywords',
            'metadescription' => 'Metadescription',
            'status' => 'Status',
        ];
    }
}
