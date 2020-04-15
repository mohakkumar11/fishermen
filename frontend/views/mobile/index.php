<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use admin\models\User;
use admin\models\Post;
use kartik\file\FileInput;
use yii\bootstrap\Progress;
use yii\bootstrap\Button;
use yii\widgets\LinkPager;
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/css/responsive.css");
$this->registerCssFile("@web/css/animate.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerJsFile("@web/js/jquery.min.js");
$this->registerJsFile("@web/js/popper.js");
$this->registerJsFile("@web/js/bootstrap.min.js");
$this->registerJsFile("@web/lib/slick/slick.min.js");
$this->registerJsFile("@web/js/script.js");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>WorkWise Html Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
</head>
<body>
Mobile Detect
<?php
//echo Yii::$app->basePath.'\views\mobile\Mobile_Detect.php';
//require_once Yii::$app->basePath.'\views\mobile\namespaced\Detection\Mobile_Detect.php';
// Include and instantiate the class.
require_once Yii::$app->basePath.'\views\mobile\Mobile_Detect.php';
//require_once 'Mobile_Detect.php';

$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
/*if ( $detect->isMobile() ) {
 
}
 
// Any tablet device.
if( $detect->isTablet() ){
 
}
 
// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet() ){
 
}
 
// Check for a specific platform with the help of the magic methods:
if( $detect->isiOS() ){
 
}
 
if( $detect->isAndroidOS() ){
 
}
 */
// Alternative method is() for checking specific properties.
// WARNING: this method is in BETA, some keyword properties will change in the future.
if($detect->is('Chrome'))
{
	echo "chrome";
}
else
{
	echo "chrm";
}

//$detect->is('iOS');
//$detect->is('UC Browser');
// [...]
 
// Batch mode using setUserAgent():
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
// [...]
);
/*foreach($userAgents as $userAgent){
 
  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.
 
}
 */
// Get the version() of components.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone'); // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
// [...]

?>
</body>
 
</html>
