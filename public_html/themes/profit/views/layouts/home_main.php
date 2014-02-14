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
    <link href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/css/animate.min.css" type="text/css" media="screen" charset="utf-8" />
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
    <script type="text/javascript" src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/js/jquery.nivo.slider.pack.js"></script>


</head>

<body><div class="page-wrapper">

<div class="slug-pattern slider-expand"><div class="overlay"><div class="slug-cut"></div></div></div>
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
            <div class="nivoWrapper">
                <div class="nivo-crop"></div>
                <div class="preload">
                    <center><img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/design/preloader.gif" /></center>
                </div>
                <div class="nivo hide">
                    <img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/nivo/target.jpg" class="scale-with-grid" />
                    <img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/nivo/business-room.jpg" class="scale-with-grid" title="
                                <b>Responsive Theme</b>
                                <p>Go Ahead, try Resizing your Browser! Quisque mauris nisi, porttitor at hendrerit eu, condimentum sed nunc. Quisqe iaculis eleifend facilisis. Vivamus in nisi et ante malesuada ullamcorper. Phasellus sed erat velit, sit amet sodales neque. Morbi quis erat eros. Sed nec ligula ligula, id euismod mauris. Vestibulum in turpis metus.                  </p>

                            " />
                    <img src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/nivo/agent.jpg" class="scale-with-grid" />
                    <img title="
                                <b>The Nivo Slider</b>
                                <p>Integer viverra ante sit amet orci rhoncus sit amet consectetur odio sollicitudi
n. Proin luctus pharetra turpis et scelerisque. Pellentesque eget velit quis sem
fringilla blandit quis quis enim.</p>
                            " src="<?php echo Yii::app()->getRequest()->getHostInfo() ?>/images/nivo/girl.jpg" class="scale-with-grid" />
                </div>
                <div class="nivo-crop-bottom"></div>
            </div>
            <div class="container callout">

                <div class="twelve columns">
                    <h4>Welcome to <span>YES-PROFIT.com</span> - We Build <span>Professional</span> Website Designs!</h4>
                    <p class="subtitle">Enzyme is a unique and responsive theme. Sed volutpat lacinia fringilla.</p>
                </div>

            </div>
            <div class="callout-hr"></div>
            <div class="container">

                <div class="sixteen columns">
                    <div class="title-wrapper">
                        <div class="section-title">
                            <h4 class="title">Our <strong>Programs</strong></h4>
                        </div>
                        <span class="divider"></span>
                        <div class="clear"></div>
                    </div>
                    <div class="four columns alpha">
                        <ul class="pricing">
                            <li class="title">Basic</li>
                            <li class="price">
                                <sup>$</sup>
                                <span>13</span>
                                <span class="decimal">99</span>
                                <span class="divider">/</span>
                                <span class="rate">month</span>
                            </li>
                            <li>MySQL</li>
                            <li><strong>16</strong> GB WebSpace</li>
                            <li><strong>7</strong> Domain</li>
                            <li><strong>100</strong> Databases</li>
                            <li><strong>24X7</strong> Support</li>
                            <li class="purchase"><div class="button-wrap"><a href="#" class="medium-button button"><span>Buy Now!</span></a></div></li>
                        </ul>
                    </div>
                    <div class="four columns">
                        <ul class="pricing">
                            <li class="title">Premium</li>
                            <li class="price">
                                <sup>$</sup>
                                <span>19</span>
                                <span class="decimal">97</span>
                                <span class="divider">/</span>
                                <span class="rate">month</span>
                            </li>
                            <li>MySQL</li>
                            <li><strong>19</strong> GB WebSpace</li>
                            <li><strong>8</strong> Domain</li>
                            <li><strong>100</strong> Databases</li>
                            <li><strong>24X7</strong> Support</li>
                            <li class="purchase"><div class="button-wrap"><a href="#" class="medium-button button"><span>Buy Now!</span></a></div></li>
                        </ul>
                    </div>
                    <div class="four columns">
                        <ul class="pricing">
                            <div class="recommended"></div>
                            <li class="title">Platinum</li>
                            <li class="price">
                                <sup>$</sup>
                                <span>69</span>
                                <span class="decimal">95</span>
                                <span class="divider">/</span>
                                <span class="rate">month</span>
                            </li>
                            <li>MySQL</li>
                            <li><strong>25</strong> GB WebSpace</li>
                            <li><strong>15</strong> Domain</li>
                            <li><strong>Unlimited</strong> Databases</li>
                            <li><strong>24X7</strong> Support</li>
                            <li class="purchase"><div class="button-wrap"><a href="#" class="medium-button button"><span>Buy Now!</span></a></div></li>
                        </ul>
                    </div>
                    <div class="four columns omega">
                        <ul class="pricing">
                            <li class="title">Point Made :)</li>
                            <li class="price">
                                <sup>$</sup>
                                <span>99</span>
                                <span class="decimal">95</span>
                                <span class="divider">/</span>
                                <span class="rate">month</span>
                            </li>
                            <li>MySQL</li>
                            <li><strong>25</strong> GB WebSpace</li>
                            <li><strong>15</strong> Domain</li>
                            <li><strong>Unlimited</strong> Databases</li>
                            <li><strong>24X7</strong> Support</li>
                            <li class="purchase"><div class="button-wrap"><a href="#" class="medium-button button"><span>Buy Now!</span></a></div></li>
                        </ul>
                    </div>
                    <div class="clear"></div>

                    <div class="two-thirds column alpha">
                        <div class="title-wrapper">
                            <div class="section-title">
                                <h4 class="title">Why Choose Us?</h4>
                            </div>
                            <span class="divider"></span>
                            <div class="clear"></div>
                        </div>
                        <p class='p1'>
                            YES-PROFIT is a financial company specializing on rendering of services of  internet trading for private,
                            professional and institutional clients. We offer an access to invest instruments from field leaders
                            ensuring our clients with exclusion conditions.
                        </p>
                        <p class='p1'>
                            YES-PROFIT gives its clients an opportunity to make a profit that is exceeding even the most courageous bank
                            proposal  on deposit. We offer the most convenient and simple control system of your investment.
                            At the same time the wide choice of various strategies allows investors to select a comfort means
                            to make a profit.
                        </p>
                        <p class='p1'>
                            Our mission is to promote the development of efficient investment vehicle. So we lead a constant search
                            and introduction of innovation financial means. With the help of them we give an opportunity to
                            investors to increase their assets. Because of the introduction of the cutting-edge technology
                            in revenue we help to invest your money more  profitably.
                        </p>
                    </div>
                    <div class="one-third column omega">
                        <div class="title-wrapper">
                            <div class="section-title">
                                <h4 class="title">Last News</h4>
                            </div>
                            <span class="divider"></span>
                            <div class="clear"></div>
                        </div>


                                   <?php  $this->widget('ext.widgets.news.NewsWidget');?>
                      <!--  <li>
                            <div class="quote">
                                <p>
                                    I got the HTML files&hellip; Thank you so much, I appreciate your quick response and attention. I recommend you! A++ Service!
                                </p>
                            </div>
                            <div class="source">
                                <img src="images/testimonial.jpg" />
                                <strong>movilwebs
                                    <a href="#">Contact Me</a>
                                </strong>
                                <div class="clear"></div>
                            </div>
                        </li>    -->

                    </div>
                    <div class="clear"></div>
                </div>

                <div class="clear"></div>
                <div class="sixteen columns">
                    <span class="hr remove-bottom"></span>
                    <blockquote class="standard bottom">
                        "Persist – don’t take no for an answer. If you’re happy to sit at your desk and not take any risk, you’ll be sitting at your desk for the next 20 years." <br />- David Rubenstein (Net Worth $2.8 Billion)
                    </blockquote>
                </div>
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
    <!--
    $(window).load(function(){
        $(".nivo.hide").fadeIn(1000);
        // Setup Slider
        $('.nivo').nivoSlider({
            effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
            slices: 15, // For slice animations
            boxCols: 8, // For box animations
            boxRows: 4, // For box animations
            animSpeed: 500, // Slide transition speed
            pauseTime: 6000, // How long each slide will show
            startSlide: 0, // Set starting Slide (0 index)
            directionNav: true, // Next & Prev navigation
            controlNav: false, // 1,2,3... navigation
            controlNavThumbs: false, // Use thumbnails for Control Nav
            pauseOnHover: true, // Stop animation while hovering
            manualAdvance: false, // Force manual transitions
            prevText: 'Prev', // Prev directionNav text
            nextText: 'Next', // Next directionNav text
            randomStart: false, // Start on a random slide
            beforeChange: function(){}, // Triggers before a slide transition
            afterChange: function(){}, // Triggers after a slide transition
            slideshowEnd: function(){}, // Triggers after all slides have been shown
            lastSlide: function(){}, // Triggers when last slide is shown
            afterLoad: function(){} // Triggers when slider has loaded
        });

    });
    $(document).ready(function() {
        $('.slidewrap, .slidewrap2').carousel({
            slider: '.slider',
            slide: '.slide',
            slideHed: '.slidehed',
            nextSlide : '.next',
            prevSlide : '.prev',
            addPagination: false,
            addNav : false
        });
        $('.slide.testimonials').contentSlide({'nav': false});
    });
    // -->
</script>
</div>
</body>

</html>