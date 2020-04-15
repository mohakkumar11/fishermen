<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $userId
 * @property string $message
  * @property string $image_messge
   * @property string $video_message
 * @property string $imagename
 * @property string $videoname
 * @property string $addedon
 * @property string $status
 * @property double $totalvotetodelete
 * @property string $to_address
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'to_address'], 'required'],
			[['imagename'],'required','on'=>['create']],
			[['videoname'],'required','on'=>['create']],
            [['userId'], 'integer'],
            [['message', 'status'], 'string'],
            [['addedon'], 'string'],
            [['totalvotetodelete'], 'number'],
            [['imagename', 'videoname', 'to_address'], 'string', 'max' => 255],
			//[['imagename'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg'],
			[['videoname'], 'file','extensions' => 'mp4','maxFiles' => 1, 'maxSize' => 1024*1024*30 ],
			[['userId', 'message', 'imagename', 'videoname', 'addedon', 'totalvotetodelete', 'image_messge','video_message', 'to_address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User Name',
            'message' => 'Message',
			 'image_messge' => 'Message',
			  'video_message' => 'Message',
            'imagename' => 'Upload Image',
            'videoname' => 'Upload Video',
            'addedon' => 'Addedon',
            'status' => 'Status',
            'totalvotetodelete' => 'Total Vote To Delete',
        ];
    }
	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
