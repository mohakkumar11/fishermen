<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use admin\models\Settings;
use admin\models\User;
$id = 0;
$uid=0;
$settings = Settings::find()->all();
$changepassword = User::find()->all();
if(!empty($changepassword))
 {
	 $uid = $changepassword[0]->id;
 }

 if(!empty($settings))
 {
	 $id = $settings[0]->settings_id;
 }

		
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <!--<div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>-->
            <!--<div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>-->
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
						[
                            
                        ],
						[
                            'label' => 'Dashboard',
                            'icon' => 'fa fa-tachometer icon-2x',
							'url' => '#',
                            'items' => [
                                 
                                 
                            ]
                        ], 
						
						[
                            'label' => 'Post',
                            'icon' => 'fa fa-file',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Post List',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/post/index'],
        							'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create Post',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/post/create'],
        							'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						
						
						[
                            'label' => 'Pages',
                            'icon' => 'fa fa-file',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Pages List',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/pages/index'],
                                ],
                                [
                                    'label' => 'Create Pages',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/pages/create'],
                                ]
                            ]
                        ],
						[
                            'label' => 'Settings',
                            'icon' => 'fa fa-cog',
                           'url' => ($id>0)?['/settings/update?id='.$id]:['/settings/create'],
                        ],
						[
                            'label' => 'User',
                            'icon' => 'fa fa-users',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'User List',
                                    'icon' => 'fa fa-users',
                                    'url' => ['/user/index'],
        							'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create User',
                                    'icon' => 'fa fa-users',
                                    'url' => ['/user/create'],
        							'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
