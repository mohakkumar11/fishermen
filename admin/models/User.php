<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $auth_key
 * @property string $password_hash
 * @property string $confirm_password
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string $status
 * @property string $dob
 * @property string $created_at
 * @property string $updated_at
 * @property string $address1
 * @property string $usertype
 * @property int $partyId
 * @property int $countryId
 * @property int $stateId
 * @property string $address2
 * @property string $city
 * @property string $zip
 * @property string $user_pic
 * @property int $total_followers
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'gender', 'email', 'password_hash', 'usertype'], 'required'],
			//[['password_hash'],'required','on'=>['create']],
            [['gender', 'status'], 'string'],
            [['phone', 'partyId', 'countryId', 'stateId'], 'integer'],
			[['phone'], 'string', 'max' => 10,  'min' => 10 , 'tooShort' => 'Please Enter a valid Phone number'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'first_name', 'last_name', 'password_hash', 'confirm_password', 'password_reset_token', 'email', 'dob', 'address1', 'usertype', 'address2', 'city', 'user_pic'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['zip'], 'string', 'max' => 100],
            [['email'], 'unique'],
			[['email'], 'email'],
            [['password_reset_token'], 'unique'],
			[['first_name', 'last_name','confirm_password', 'password_reset_token', 'email', 'dob', 'address1', 'address2', 'city', 'stateId', 'countryId', 'partyId', 'user_pic', 'total_followers'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'confirm_password' => 'Confirm Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone' => 'Phone Number',
            'status' => 'Status',
            'dob' => 'Dob',
            'created_at' => 'Createdate',
            'updated_at' => 'Updatedate',
            'address1' => 'Permanent Address',
            'usertype' => 'Usertype',
            'partyId' => 'Party Name',
            'countryId' => 'Country',
            'stateId' => 'State',
            'address2' => 'Alternative Address',
            'city' => 'City',
            'zip' => 'Zip',
			'user_pic' => 'User Photo',
			'total_followers' => 'Total Followers',
        ];
    }
	public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
	public static function Statelists()
    {
		$us_state_names = array(
		'AL'=>'ALABAMA',
		'AK'=>'ALASKA',
		'AS'=>'AMERICAN SAMOA',
		'AZ'=>'ARIZONA',
		'AR'=>'ARKANSAS',
		'CA'=>'CALIFORNIA',
		'CO'=>'COLORADO',
		'CT'=>'CONNECTICUT',
		'DE'=>'DELAWARE',
		'DC'=>'DISTRICT OF COLUMBIA',
		'FM'=>'FEDERATED STATES OF MICRONESIA',
		'FL'=>'FLORIDA',
		'GA'=>'GEORGIA',
		'GU'=>'GUAM GU',
		'HI'=>'HAWAII',
		'ID'=>'IDAHO',
		'IL'=>'ILLINOIS',
		'IN'=>'INDIANA',
		'IA'=>'IOWA',
		'KS'=>'KANSAS',
		'KY'=>'KENTUCKY',
		'LA'=>'LOUISIANA',
		'ME'=>'MAINE',
		'MH'=>'MARSHALL ISLANDS',
		'MD'=>'MARYLAND',
		'MA'=>'MASSACHUSETTS',
		'MI'=>'MICHIGAN',
		'MN'=>'MINNESOTA',
		'MS'=>'MISSISSIPPI',
		'MO'=>'MISSOURI',
		'MT'=>'MONTANA',
		'NE'=>'NEBRASKA',
		'NV'=>'NEVADA',
		'NH'=>'NEW HAMPSHIRE',
		'NJ'=>'NEW JERSEY',
		'NM'=>'NEW MEXICO',
		'NY'=>'NEW YORK',
		'NC'=>'NORTH CAROLINA',
		'ND'=>'NORTH DAKOTA',
		'MP'=>'NORTHERN MARIANA ISLANDS',
		'OH'=>'OHIO',
		'OK'=>'OKLAHOMA',
		'OR'=>'OREGON',
		'PW'=>'PALAU',
		'PA'=>'PENNSYLVANIA',
		'PR'=>'PUERTO RICO',
		'RI'=>'RHODE ISLAND',
		'SC'=>'SOUTH CAROLINA',
		'SD'=>'SOUTH DAKOTA',
		'TN'=>'TENNESSEE',
		'TX'=>'TEXAS',
		'UT'=>'UTAH',
		'VT'=>'VERMONT',
		'VI'=>'VIRGIN ISLANDS',
		'VA'=>'VIRGINIA',
		'WA'=>'WASHINGTON',
		'WV'=>'WEST VIRGINIA',
		'WI'=>'WISCONSIN',
		'WY'=>'WYOMING',
		'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
		'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
		'AP'=>'ARMED FORCES PACIFIC'
		);
		return $us_state_names;
	}
}

