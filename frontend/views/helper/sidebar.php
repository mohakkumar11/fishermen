<?php
use manage\models\Property;
use manage\models\PropertyImage;
use yii\helpers\Url;
	$propertySql = "SELECT * FROM property p
	  INNER JOIN property_image i ON p.id = i.property_id 
	  WHERE i.is_default = 'Y' 
	  ORDER BY i.id DESC LIMIT 2";
  	$properties = Yii::$app->db->createCommand($propertySql)->queryAll();
?>
<div class="col-md-4 col-md-4 col-sm-4 col-xs-12 ">
 	<section  class="Featured_Properties_Widget">
      <h3 class="title">Featured Properties</h3>           
      <ul class="featured-properties">
 		<?php foreach($properties as $property){ ?>
               <li> 
               <figure><a href="<?php echo Url::to(['property/details','id' => $property['property_id']]);?>"> <img src="<?= Yii::$app->request->baseUrl.'/manage/images/propertyimage/'.$property['image_loc']; ?>" width="350" height="214" "  alt=""></a></figure>
    <h4><a href="<?php echo Url::to(['property/details','id' => $property['property_id']]);?>"><?php echo $property['address']; ?></a></h4>
                  <p><?php echo substr($property['description'],0,70); ?>… <a href="<?php echo Url::to(['property/details','id' => $property['property_id']]);?>">Read More</a></p>
                  <span class="price">$<?php echo $property['price']; ?> Per Month</span>
                  </li>
     <?php } ?>
      </ul>
    </section>
</div>