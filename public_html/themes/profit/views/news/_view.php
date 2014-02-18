
<div style="margin: 0 20px 20px 20px;padding: 10px">

        <div class="blog">

            <h5><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></h5>
            <div class="info">
                DATE: <a href="#"><?php echo User::formatDate(CHtml::encode($data->created_time),true); ?></a>
            </div>

            <p><?php echo CHtml::encode($data->description); ?></p>
            <div class="foot">
                <p class="right"><?php echo CHtml::link('Read More',array('view','id'=>$data->id)); ?></p>
                <div class="clear"></div>
            </div>
        </div><!-- Blog Ends -->






</div>