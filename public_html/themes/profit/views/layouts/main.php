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
                                <a href="index.html" class="active"><span>Home</span></a>
                            </li>
                            <li>
                                <a href="#">About us</a>
                            </li>
                            <li>
                                <a href="blog.html">Referral</a>
                            </li>
                            <li>
                                <a href="portfolio-standard-3.html">
                                    FAQ
                                </a>
                            </li>
                            <li>
                                <a href="portfolio-standard-3.html">
                                    Contacts
                                </a>
                            </li>
                            <li>
                                <?php echo CHtml::link('Login', Yii::app()->createAbsoluteUrl('/site/enter')) ?>
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
        <div class="blur"></div>
        <div class="pattern">
            <div class="container">
                <div class="stitch"></div>
                <div class="sixteen columns">
                    <div class="first column alpha">

                        <div class="left">
                            <div class="logo-caption"></div>
                            <h5>Enzyme</h5>
                            <p>
                                Integer eu ante in arcu viverra vehicula donec tempus consequat faucibus. Donec ne thomp nibh egestas suscipit. Donec sed lacus at massa lorem
                                pharetra id eleifend leo.
                            </p>
                            <p class="extra">
                                Pellentesque quis felis neque, id adipiscing nunc. Ipsum elit, vitae tempus tellus. Class aptent taciti sociosq desis torquent per conubia nostra, per inceptos himenae dolar eget lacinia sem.
                            </p>
                        </div>
                    </div>
                    <div class="column ct">
                        <h5>Recent Tweets:</h5>
                        <ul class="twitter" id="twitter_update_list"><li>Twitter is loading</li></ul>
                    </div>
                    <div class="last column omega">
                        <h5>Join our Mailing List</h5>

                        <div class="input-wrapper">
                            <input type="text" placeholder="Email..." id="email" name="email" />
                        </div>
                        <div class="right">
                            <a href="#" class="button color"><span>Join</span></a>
                        </div>
                        <div class="clear"></div>
                        <span class="hr"></span>
                        <h5>Stay in Touch</h5>
                        <ul class="sm foot">
                            <li class="facebook"><a href="#facebook">Facebook</a></li>
                            <li class="twitter"><a href="#twitter">LinkedIn</a></li>
                            <li class="linkedin"><a href="#linkedin">Pinterest</a></li>
                            <li class="pinterest"><a href="#pinterest">Pinterest</a></li>
                            <li class="dribbble"><a href="#dribbble">Pinterest</a></li>
                            <li class="flickr"><a href="#flickr">Pinterest</a></li>
                            <li class="flavors"><a href="#flavors">Pinterest</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sixteen columns alpha omega">
                <div class="foot-nav-bg"></div>
                <div class="foot-nav">
                    <div class="copy">
                        Coptyright © 2011-2012 Enzyme. By Empirical Themes - Remove upon purchase
                    </div>
                    <div class="nav">
                        <a href="#">Home</a>
                        <a href="#">Portfolio</a>
                        <a href="#">Contact Us</a>
                        <a href="#">Terms of Use</a>
                        <a href="#">Privacy</a>
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