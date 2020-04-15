<?php
use manage\models\Property;
use manage\models\PropertyImage;
use yii\helpers\Url;
?>
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Property';
$this->params['breadcrumbs'][] = $this->title;
$propertyModels = $model;
?>
<section class="banner banner_inner"><!--banner-->
  <ul>
    <li> <img src="images/inner-banner.jpg" alt="">
      <div class="text_bg">
        <div class="innertitle">
          <h1>Featured Properties</h1>
        </div>
      </div>
    </li>
  </ul>
</section>
<div class="container_section">

  <section class="recent_row featured_properties">
    <div class="container">
    <div class="row">
    <?php
	$image = '';
	foreach($model as $property)
	{
		
	?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="hovereffect"> <img src="<?= Yii::$app->request->baseUrl.'/manage/images/propertyimage/' . $property['image_loc'] ?>" alt="" height="400"></div>
          <div class="recent_bg">
          <div class="title_w">
		 	<div class="title"><a href="<?php echo Url::to(['property/details','id' => $property['id']]);?>"><?php echo $property['address'];?></a></div>
          <div class="price"><?php echo $property['price'];?></div>
          </div>
          <div class="property-amenities"><span class="area"><?php echo $property['area'];?><strong></strong>Area</span><span class="baths"><strong><?php echo $property['baths'];?></strong>Baths</span><span class="beds"><strong><?php echo $property['beds'];?></strong>Beds</span><span class="parking"><strong><?php echo $property['parking'];?></strong>Parking</span></div>
          </div>
          
          
        </div>
      
     <?php
	  }
	  ?>
      
    </div>
    
    </div>
  </section><!--Recent Listed-End-->
  
  
</div>