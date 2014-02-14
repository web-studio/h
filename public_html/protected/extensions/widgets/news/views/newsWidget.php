    <?php foreach ($news as $new): ?>

        <div style="background-color: #f8f8f8; border: 1px solid #e3e2e2; padding: 10px">
            <h5><strong><?php echo $new[title] ?></strong></h5>
            <?php echo $new[description] ?></br></br>
            <span style="position: absolute; right:20px"><?php echo User::formatDate($new[created_time],true) ?></span></br>
            <strong>
                <?php echo CHtml::link('read more...',Yii::app()->createAbsoluteUrl('/news/' . $new[id]))?>
            </strong>
        </div></br>

    <?php endforeach ?>
