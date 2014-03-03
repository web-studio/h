<?php
$this->pageTitle = 'Contacts';

$this->breadcrumbs=array(
    'Contacts',
);
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <div class="container callout standard">

        <div class="four columns button-wrap">
            <div class="wrapper search">
                <form action="">
                    <input type="text" class="search-box" name="" value="" placeholder='Search...' />
                    <input type="image" src="images/design/search-icon.png" class="searchbox-submit" value=""/>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="contact eleven columns">
            <div class="standard-form compressed style-2">
                <h5 class="semi title style-2">Contact Form</h5>
                <div class="form-result"></div>
                <form action="#" class="contactForm" id="contactus" name="contactus">
                    <input type="text" class="input" id="name" name="name" placeholder="Name *" />
                    <input type="text" class="input" id="email" name="email" placeholder="Email *" />
                    <input type="text" class="input extend" id="subject" name="subject" placeholder="Subject" />
                    <textarea name="comment" id="comment" rows="10" cols="65" placeholder="Message *" ></textarea>
                    <div class="submit">
                        <a class="button color" href="javascript:contactUsSubmit();"><span>Submit</span></a>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>

        <div class="five columns">
            <h5 class="semi">On the Map</h5>
            <div class="maps">
                <iframe width="100%" height="140" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=google&amp;aq=&amp;sll=37.6,-95.665&amp;sspn=38.949025,86.572266&amp;ie=UTF8&amp;hq=google&amp;hnear=&amp;t=m&amp;cid=10048610331046050672&amp;ll=40.744071,-74.002533&amp;spn=0.02276,0.036564&amp;z=14&amp;output=embed"></iframe><div class="clear"></div>
            </div>

            <h5 class="semi">Contact Info</h5>
            <p>
                12345 Random Rd,<br />
                Baltimore MD, 21212
                <span class="hr"></span>
                Phone: 1.800.555.6789<br />
                Fax: 1.800.555.6789<br />
                Email: example@ex.com<br />
                Web: www.ex.com
            </p>

        </div>
        <div class="clear"></div>
        <div class="sixteen columns">
            <span class="hr lip-quote"></span>
            <blockquote class="standard bottom">
                "Making the simple complicated is commonplace; making the complicated simple, awesomely simple, that's creativity" <br />- Charles Mingus
            </blockquote>
        </div>

    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>