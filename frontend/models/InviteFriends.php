<?php 
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\validators\EmailValidator;
    
class InviteFriends extends \yii\db\ActiveRecord
{
        public $to_address;
        public $message;
        
        public function rules()
        {
            return [
			//['to_address', 'email'],
			['to_address', 'checkEmailList'],
                //[['to_address','message'],'required'],
               
            ];
        }
        
       
        
        public function attributeLabels()
        {
            return [
                'to_address'=>'To',
                'message'=>'Message'
            ];
        }
		public function checkEmailList($attribute, $params) {die;
			$emails = $this->email;
	
			//convert email list to string to an array so we can loop through it using ";"  as a delimiter.
	
			//if it is in an array do nothing i.e. using somthing like select2
	
			if (is_array($emails)) {
	
				$emails = explode(';', $emails);
	
			}
	
			//declair email validator
	
			$validator = new EmailValidator;
	
			foreach ($emails as $email) {
	
				if (!$validator->validate($email)) {
	
					$this->addError($attribute, "'.$email.' is not a valid email.");
	
				}
	
			}
	}
}