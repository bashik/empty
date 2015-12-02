<div class="container">
    <h2 align="center">Отзывы о нас !</h2>
    <?php foreach($rows as $comment):?>
    <div class="comment">
        <span class="date"><?php echo $comment->date;?></span><span class="name"><?php echo $comment->name;?></span>
        <p><?php echo $comment->text?></p>
    </div>
    <?endforeach;?>


    <h3>Добавить новый комментарий</h3>
    <div class="form">
        <?php echo CHtml::beginForm(); ?>

        <?php echo CHtml::errorSummary($model); ?>

        <div class="row">
            <?php echo CHtml::activeLabel($model,'date',array('class'=>'comment-date-label')); ?>
            <?php echo CHtml::activeDateField($model,'date',array('class'=>'comment-date-input')); ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabel($model,'name',array('class'=>'comment-name-label')); ?>
            <?php echo CHtml::activeTextField($model,'name',array('class'=>'comment-name-input')); ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabel($model,'text',array('class'=>'comment-text-label')); ?>
            <?php echo CHtml::activeTextArea($model,'text',array('class'=>'comment-text-textarea')); ?>
        </div>





        <div class="row submit">
            <?php echo CHtml::submitButton('Сохранить',array('class'=>'comment-submit')); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->
</div>



