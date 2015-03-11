<?php
use yii;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\DashboardAsset;
use yii\helpers\Url;
use yii\bootstrap\Alert;

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
						    
						    ['label' => 'Posts', 'url' => 'javascript:void(0)', 'items' => [
						        ['label' => 'List', 'url' => ['posts/index']],
						        ['label' => 'Create new', 'url' => ['posts/new']],
						    ]],

						    ['label' => 'Log out', 'url' => ['/site/logout']],
						],
					]) ?>
					<? /*
                    <ul>
                        <li class="first_level">
                            <a href="dashboard.html">
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="menu-title">Forms</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Forms</li>
                                <li><a href="forms-regular_elements.html">Regular Elements</a></li>
                                <li><a href="forms-extended_elements.html">Extended Elements</a></li>
                                <li><a href="forms-gridforms.html">Gridforms</a></li>
                                <li><a href="forms-validation.html">Validation</a></li>
                                <li><a href="forms-wizard.html">Wizard</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="menu-title">Pages</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Pages</li>
                                <li><a href="pages-chat.html">Chat</a></li>
                                <li><a href="pages-contact_list.html">Contact List</a></li>
                                <li><a href="error_404.html">Error 404</a></li>
                                <li><a href="pages-help_faq.html">Help/Faq</a></li>
                                <li><a href="pages-invoices.html">Invoices</a></li>
                                <li><a href="login_page.html">Login Page</a></li>
                                <li><a href="login_page2.html">Login Page 2</a></li>
                                <li><a href="pages-mailbox.html">Mailbox</a></li>
                                <li><a href="pages-mailbox_compose.html">Mailbox (compose)</a></li>
                                <li><a href="pages-mailbox_message.html">Mailbox (details)</a></li>
                                <li><a href="pages-search_page.html">Search Page</a></li>
                                <li><a href="pages-user_list.html">User List</a></li>
                                <li><a href="pages-user_profile.html">User Profile</a></li>
                                <li><a href="pages-user_profile2.html">User Profile 2</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="menu-title">Components</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Components</li>
                                <li><a href="components-bootstrap.html">Bootstrap</a></li>
                                <li><a href="components-gallery.html">Gallery</a></li>
                                <li><a href="components-grid.html">Grid</a></li>
                                <li><a href="components-icons.html">Icons</a></li>
                                <li><a href="components-notifications_popups.html">Notifications/Popups</a></li>
                                <li><a href="components-typography.html">Typography</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="menu-title">Plugins</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Plugins</li>
                                <li><a href="plugins-ace_editor.html">Ace Editor</a></li>
                                <li><a href="plugins-calendar.html">Calendar</a></li>
                                <li><a href="plugins-charts.html">Charts</a></li>
                                <li><a href="plugins-gantt_chart.html">Gantt Chart</a></li>
                                <li><a href="plugins-google_maps.html">Google Maps</a></li>
                                <li><a href="plugins-tables_footable.html">Tables</a></li>
                                <li><a href="plugins-vector_maps.html">Vector Maps</a></li>
                            </ul>
                        </li>
                        <li class="first_level has_submenu">
                            <a href="javascript:void(0)">
                                <span class="menu-title">Sub menu</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Sub menu</li>
                                <li><a href="javascript:void(0)">01. Lorem ipsum</a></li>
                                <li class="has_submenu">
                                    <a href="javascript:void(0)">02. Lorem ipsum</a>
                                    <ul>
                                        <li class="has_submenu">
                                            <a href="javascript:void(0)">02.1 Lorem ipsum dolor sit amet</a>
                                            <ul>
                                                <li><a href="javascript:void(0)">02.1.1 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.2 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.3 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.4 Lorem ipsum</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0)">02.2 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">02.3 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">02.4 Lorem ipsum</a></li>
                                    </ul>
                                </li>
                                <li class="has_submenu">
                                    <a href="javascript:void(0)">03. Lorem ipsum</a>
                                    <ul>
                                        <li><a href="javascript:void(0)">03.1 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.2 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.3 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.4 Lorem ipsum</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">04. Lorem ipsum</a></li>
                            </ul>
                        </li>
                    </ul>
                    */ ?>
                </div>
            </nav>

        </div>

    </body>
    <? $this->endBody() ?>
</html>
<? $this->endPage() ?>