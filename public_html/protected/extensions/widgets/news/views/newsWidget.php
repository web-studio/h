<div class="style-2 slide testimonials">
    <?php foreach ($news as $new): ?>

        <div class="quote">
            <h5><strong><?php echo $new[title] ?></strong></h5>
            <?php echo $new[description] ?></br></br>
            <span style="position: absolute; right:30px"><?php echo User::formatDate($new[created_time],true) ?></span></br>
            <strong>
                <?php echo CHtml::link('read more...',Yii::app()->createAbsoluteUrl('/news/' . $new[id]))?>
            </strong>
        </div></br>

    <?php endforeach ?>
</div>
