<?php
use manage\models\Property;
use manage\models\State;
?>
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Property';
$this->params['breadcrumbs'][] = $this->title;
$address = $model->address.','.$model->city.','.State::getStateById($model->state).','.$model->zip.',USA';
?>
<section class="banner banner_inner"><!--banner-->
  <ul>
    <li> <img src="<?php echo Yii::$app->request->baseUrl;?>/images/inner-banner.jpg" alt="">
      <div class="text_bg">
        <div class="innertitle">
          <h1>property details </h1>
        </div>
      </div>
    </li>
  </ul>
</section>
<div class="container_section"> 
<section class="inner_container">
      <div class="container">
        <div class="col-md-8 col-md-8 col-sm-8 col-xs-12 ">
          <div class="portfolio_details">
           <h2><?php echo $model->address; ?> </h2>
          

    <div  class="portfolio_img">
     <img src="<?php echo Yii::$app->request->baseUrl.'/manage/images/propertyimage/'.$propertyImages->image_loc; ?>" alt="">
     
  
    </div>
    


  <div class="content clearfix">
        <p><?php echo $model->description; ?></p>
<h4 class="additional-title">Additional Details</h4>
        <ul class="additional-details clearfix"> 
        <li>
            <strong>Address:</strong>
            <span><?php echo $model->address; ?></span>
        </li>
        <li>
            <strong>State:</strong>
            <span><?php echo State::getStateById($model->state); ?></span>
        </li> 
        <li>
            <strong>City:</strong>
            <span><?php echo $model->city; ?></span>
        </li>
        
        <li>
            <strong>Zip:</strong>
            <span><?php echo $model->zip; ?></span>
        </li>
        <li>
            <strong>Price:</strong>
            <span><?php echo $model->price; ?></span>
        </li> 
        <!--<li>
            <strong>Property Type:</strong>
            <span><?php //echo ($model->property_type == 'Y')? 'Yes' : 'No'; ?></span>
        </li>-->
        <li>
            <strong>Featured:</strong>
            <span><?php echo ($model->featured == 'Y')? 'Yes' : 'No'; ?></span>
        </li>       
         <li>
            <strong>Area:</strong>
            <span><?php echo $model->area; ?></span>
        </li>
        <li>
            <strong>Baths:</strong>
            <span><?php echo $model->baths; ?></span>
        </li> 
        <li>
            <strong>Beds:</strong>
            <span><?php echo $model->beds; ?></span>
        </li>
        <li>
            <strong>Parking:</strong>
            <span><?php echo $model->parking; ?></span>
        </li>       
        </ul>
        <div class="common-note">
            <h4 class="common-note-heading">Common Note</h4><p>A common note across all properties to describe some policies or terms that are applicable on all the properties. This common note can be disabled from theme options.</p>        </div>
            </div>
  
  </div>
  
        </div>
        
        <?= $this->render('//helper/sidebar') ?>
        
      </div>
    </section>
   
   <div class="map">
    <div class="container">
    <!--<h2>Get in touch</h2>-->
    <div class="boder"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/boder2.png"  alt=""></div>
    <p></p>
    <a  href="contact.html"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span></a>
    </div>
      <iframe src="https://maps.google.com/maps?q=<?php echo urlencode($address);?>&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>