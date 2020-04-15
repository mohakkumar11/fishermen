<?php
use manage\models\Pages;
use frontend\models\ContactForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php
$this->title = $pages-> title;
?>
<section class="banner banner_inner"><!--banner-->
  <ul>
    <li> <img src="images/inner-banner.jpg" alt="">
      <div class="text_bg">
        <div class="innertitle">
          <h1><?php echo $pages->title;?></h1>
        </div>
      </div>
    </li>
  </ul>
</section>
<div class="container_section"> 
<section class="inner_container">
      <div class="container">
      <div class="breadcrumbs">
    <?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
    </div>
        <div class="col-md-8 col-md-8 col-sm-8 col-xs-12 ">
          <section class="contact">
     
        <h2>Reinhard Real Estate</h2>
        <p><?php echo $pages->description;?></p>
   
           
		  <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['action'=>'contact/email']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
				
                <?= $form->field($model, 'lastname') ?>

                <?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
               

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </section>
        </div>        
        <?= $this->render('//helper/sidebar') ?>        
      </div>
    </section>   
</div>