<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <meta charset="utf-8" />
    <title><?php echo CHtml::encode($this->metaTitle) ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->metaDescription) ?>">
    <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords) ?>">
    <?php Yii::app()->clientScript->registerCoreScript('cookie'); ?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link media="screen" charset="utf-8" rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/base.css" />
    <link media="screen" charset="utf-8" rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/skeleton.css" />
    <link media="screen" charset="utf-8" rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/layout.css" />
    <link media="screen" charset="utf-8" rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/child.css" />
    <!--[if (IE 6)|(IE 7)]>
    <link rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/ie.css" type="text/css" media="screen" />
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--script type="text/javascript" language="javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/jquery-1-8-2.js"></script-->
    <script type="text/javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/default.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/jquery.carousel.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/jquery.color.animation.js"></script>


</head>

<body><div class="page-wrapper">
<div class="slug-pattern"><div class="overlay"><div class="slug-cut"></div></div></div>
<div class="header">
    <div class="nav">


        <div class="container">

            <!-- Standard Nav (x >= 768px) -->
            <div class="standard">

                <div class="five column alpha">
                    <div class="logo">
                        <a href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>"><img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/logo.png" /></a><!-- Large Logo -->
                    </div>
                </div>

                <div class="eleven column omega tabwrapper">
                    <div class="menu-wrapper">
                        <ul class="tabs menu">
                            <li>
                                <?php echo CHtml::link('Home', Yii::app()->createAbsoluteUrl('/')) ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('About Us', Yii::app()->createAbsoluteUrl('/about')) ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Referral', Yii::app()->createAbsoluteUrl('/referral-program')) ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('FAQ', Yii::app()->createAbsoluteUrl('/faq')) ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Contacts', Yii::app()->createAbsoluteUrl('/contacts')) ?>
                            </li>
                            <?php if ( !Yii::app()->user->isGuest ) : ?>
                                <?php if ( Yii::app()->user->role == 'admin' ) : ?>
                                    <li>
                                        <?php echo CHtml::link('Admin', Yii::app()->createAbsoluteUrl('/admin')) ?>
                                    </li>
                                    <li>
                                        <?php echo CHtml::link('Logout', Yii::app()->createAbsoluteUrl('/site/logout')) ?>
                                    </li>
                                <?php endif ?>
                                <?php if ( Yii::app()->user->role == 'user' ) : ?>
                                    <li>
                                        <?php echo CHtml::link('My account', Yii::app()->createAbsoluteUrl('/private')) ?>
                                    </li>
                                    <li>
                                        <?php echo CHtml::link('Logout', Yii::app()->createAbsoluteUrl('/site/logout')) ?>
                                    </li>
                                <?php endif ?>
                            <?php else : ?>

                                <li>
                                    <?php echo CHtml::link('Login', Yii::app()->createAbsoluteUrl('/site/enter')) ?>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Standard Nav Ends, Start of Mini -->

            <div class="mini">
                <div class="twelve column alpha omega mini">
                    <div class="logo">
                        <a href="index.html"><img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/logo.png" /></a><!-- Small Logo -->
                    </div>
                </div>

                <div class="twelve column alpha omega navagation-wrapper">
                    <select class="navagation">
                        <option value="" selected="selected">Site Navigation</option>
                    </select>
                </div>
            </div>
            <!-- Start of Mini Ends -->
        </div>

    </div>

    <div class="shadow"></div>
    <div class="container">
        <div class="page-title">
            <div class="rg"></div>

        </div>
    </div>
</div>

<div class="body">
<div class="body-round"></div>
<div class="body-wrapper">
<div class="side-shadows"></div>
<div class="content">
<div class="container callout standard">

    <div class="twelve columns">
        <h4><?php echo $this->pageTitle ?></h4>
        <p class="link-location"><a href="index.html">Home</a> / <a href="#">My account</a></p>
    </div>


</div>
<div class="callout-hr"></div>
<div class="container">
<?php echo $content ?>



    <div class="sixteen columns">
        <span class="hr lip-quote"></span>
        <blockquote class="standard bottom">
            <?php  $this->widget('ext.widgets.statements.StatementsWidget');?>

        </blockquote>
    </div>
</div>
</div>
</div><div class="footer style-2">
        <div class="background"><div class="stitch"></div></div>
        <div class="foot-nav-bg"></div>
        <div class="content">
            <div class="patch"></div>
            <div class="pattern">
                <div class="container">
                    <div class="stitch"></div>
                    <div class="sixteen columns">
                        <div class="first column alpha">

                            <div class="left">
                                <div class="logo">
                                    <a href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>"><img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/logo.png" /></a><!-- Large Logo -->
                                </div>
                            </div>
                        </div>
                        <div class="column ct">

                        </div>
                        <div class="last column omega">

                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="sixteen columns alpha omega">
                    <div class="foot-nav-bg"></div>
                    <div class="foot-nav">
                        <div class="copy">
                            Copyright © 2014 <?php echo ( date('Y', time()) > 2014)? ' - '.date('Y', time()):'' ?>
                            <?php echo Yii::app()->name ?>
                        </div>
                        <div class="nav">

                            <?php echo CHtml::link('Home', Yii::app()->createAbsoluteUrl('/')) ?>

                            <?php echo CHtml::link('About Us', Yii::app()->createAbsoluteUrl('/about')) ?>

                            <?php echo CHtml::link('Referral', Yii::app()->createAbsoluteUrl('/referral-program')) ?>

                            <?php echo CHtml::link('FAQ', Yii::app()->createAbsoluteUrl('/faq')) ?>

                            <?php echo CHtml::link('Contacts', Yii::app()->createAbsoluteUrl('/contacts')) ?>

                            <?php if ( !Yii::app()->user->isGuest ) : ?>
                                <?php if ( Yii::app()->user->role == 'admin' ) : ?>

                                    <?php echo CHtml::link('Admin', Yii::app()->createAbsoluteUrl('/admin')) ?>

                                    <?php echo CHtml::link('Logout', Yii::app()->createAbsoluteUrl('/site/logout')) ?>

                                <?php endif ?>
                                <?php if ( Yii::app()->user->role == 'user' ) : ?>

                                    <?php echo CHtml::link('My account', Yii::app()->createAbsoluteUrl('/private')) ?>

                                    <?php echo CHtml::link('Logout', Yii::app()->createAbsoluteUrl('/site/logout')) ?>

                                <?php endif ?>
                            <?php else : ?>


                                <?php echo CHtml::link('Login', Yii::app()->createAbsoluteUrl('/site/enter')) ?>

                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.slidewrap2').carousel({
            slider: '.slider',
            slide: '.slide',
            slideHed: '.slidehed',
            nextSlide : '.next',
            prevSlide : '.prev',
            addPagination: false,
            addNav : false
        });
    });
</script>
</div>
</body>

</html>