<?php
namespace frontend\models;
use admin\models\LeaderInvite;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password_hash;
	public $confirm_password;
	public $first_name;
	public $last_name;
	public $phone_no;
	public $gender;
	public $address1;
	public $city;
	public $state;
    public $nation;
	public $user_pic;
	public $zip;
	public $address2;
	public $stateId;
	public $countryId;
	public $dob;
	public $auth_key;
	public $usertype;
	public $password_reset_token;

    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
            ['username', 'trim'],
           // ['username', 'required'],
   			//[['first_name', 'last_name', 'gender'], 'required'],
			[['first_name'], 'required'],
			//['address1', 'required', 'message' => 'Address cannot be blank.'],

           // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            //[['password_hash', 'confirm_password'],'required', 'on' => 'signup'],
            ['password_hash', 'string', 'min' => 6],
			[['password_hash'],'required',  'message' => 'Password cannot be blank'],
			[['confirm_password'],'required',  'message' => 'Repeat Password cannot be blank'],
			['confirm_password', 'compare', 'compareAttribute'=>'password_hash', 'message'=>"Password and Repeat Password Does not match." ],
			[['first_name', 'last_name','confirm_password', 'password_reset_token', 'email', 'dob', 'address1', 'address2', 'city', 'stateId', 'countryId', 'partyId', 'user_pic', 'zip', 'usertype'], 'safe'],
			 ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
       if (!$this->validate()) {
            return null;
        }
		
        $user = new User(); 
		
		//$model1 = new LeaderInvite();
 		$query = $_SERVER['QUERY_STRING'];
		/*$model1 = LeaderInvite::find()->orderBy(['id'=>SORT_DESC,])->all();
		foreach($model1 as $led){
		$led1= $led['code']; 
		}
		if($query==$led1){
		$user->usertype = 'L'; 
		}*/  
	   $model1 = LeaderInvite::find()->orderBy(['id'=>SORT_DESC,])->all();
		  foreach($model1 as $led)
		  {
		  $led1= $led['code']; 
			if($query==$led1)
			{
				$user->usertype = 'L'; 
			}
		  }
		//$user->usertype = 'F';
		 	
		//$model->scenario = 'signup';
        $user->username = $this->email;
        $user->email = $this->email;
		$user->first_name = $this->first_name;
		
		 
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        
		
        return $user->save() ? $user : null;
    }
}
