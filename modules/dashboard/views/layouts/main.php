<?php

use \Yii;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\DashboardAsset;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\models\ContactMessage;

/* @var $this \yii\web\View */
/* @var $content string */

DashboardAsset::register($this);
?>

<? $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?= Html::csrfMetaTags() ?>
		<title>Dashboard - <?= Html::encode($this->title) ?></title>
		<? $this->head() ?>

        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    </head>

    <body class="side_menu_active side_menu_expanded">
    	<? $this->beginBody() ?>
        <div id="page_wrapper">

            <!-- header -->
            <header id="main_header">
                <div class="container-fluid">
                    <div class="brand_section">
                        <a href="<?= Url::toRoute('/site/index') ?>" class="white back-to-site"><h4><?= Yii::$app->name ?></h4></a>
                    </div>
                </div>
            </header>

            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
            	<?= Breadcrumbs::widget([
					'options'            => [],
					'links'              => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					'activeItemTemplate' => "<li><span>{link}</span></li>",
					'homeLink'           => [
						'label' => 'Dashboard',
						'url'   => Url::toRoute('default/index')
        			]
	            ]) ?>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                	<div class="row">
                		<div class="col-md-12">
		                	<? 
		                		if (Yii::$app->session->hasFlash('error')) 
		                		{
		                			echo Alert::widget ( [
									    'options' => [
									        'class' => 'alert-danger'
									    ],
									    'body' => Yii::$app->session->getFlash('error')
									] );
		                		} 
		        			?>

		        			<? 
		                		if (Yii::$app->session->hasFlash('success')) 
		                		{
		                			echo Alert::widget ( [
									    'options' => [
									        'class' => 'alert-success'
									    ],
									    'body' => Yii::$app->session->getFlash('success')
									] );
		                		} 
		        			?>
	        			</div>
        			</div>

        			<div class="row">
                    	<?= $content ?>
                    </div>
                </div>
            </div>
            
            <!-- main menu -->
            <nav id="main_menu">
                <div class="menu_wrapper">
	                <?= Menu::widget([
	                	'itemOptions' => ['class' => 'first_level'],
	                	'linkTemplate' => '<a href="{url}"><span class="menu-title">{label}</span></a>',
						'items' => [
						    ['label' => 'Home', 'url' => ['default/index']],
						    ['label' => 'Pages', 'url' => ['pages/index']],
						    
						    ['label' => 'Posts', 'url' => 'javascript:void(0)', 'items' => [
						        ['label' => 'Posts list', 'url' => ['posts/index']],
						        ['label' => 'Create new post', 'url' => ['posts/create']],
						        ['label' => 'Categories list', 'url' => ['post-categories/index']],
						        ['label' => 'Create new category', 'url' => ['post-categories/create']],
						    ]],

						    ['label' => 'Users', 'url' => 'javascript:void(0)', 'items' => [
						        ['label' => 'Users list', 'url' => ['users/index']],
						        ['label' => 'Create new user', 'url' => ['users/create']],
						    ]],

						    [
						    	'label' => 'Contact messages', 
						    	'template' => '<a href="{url}"><span class="menu-title">{label}</span><span class="label label-danger">'. ContactMessage::countOfNewMessages(). '</span></a>',
						    	'url' => 'javascript:void(0)',
						    	'items' => [
							        ['label' => 'All mesages', 'url' => ['contact-messages/index']],
							        ['label' => 'New message', 'url' => ['contact-messages/only-new']],
							    ]
					    	],

						    ['label' => 'Log out', 'url' => ['/site/logout']],
						],
					]) ?>
                </div>
            </nav>

        </div>

    </body>
    <? $this->endBody() ?>
</html>
<? $this->endPage() ?>