<div class="container">
    <h2 align="center"><h2 align="center"><?php echo $model->name ;?></h2></h2>
    <div class="hovergallery">
        <?php foreach($model->portfolio as $portfolio):?>
<!---->
<!--                    --><?php //foreach($model->portfolio as $item):?>
<!--                        <img src="--><?php //echo $this->createUrl($item->normal_img);?><!--" />-->
<!--                    --><?php //endforeach;?>
            <img src="<?php echo $this->createUrl($portfolio->normal_img);?>" />
        <?php endforeach;?>

    </div>
</div>


