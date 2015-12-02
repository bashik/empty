<div class="container">
    <h2 align="center">Портфолио</h2>
    <div class="hovergallery">
        <?php foreach($model->portfolio as $portfolio):?>
            <img src="<?php echo $this->createUrl($portfolio->normal_img);?>" />
        <?php endforeach;?>
    </div>
</div>


