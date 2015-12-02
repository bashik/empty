<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
<head>
    <title>ФЕРРУМ - Художественная ковка | Изготовление кованных изделий в Томске</title>
<!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="css/font-awesome.min.css" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="--><?php //echo $this->createUrl('/css/bootstrap.min.css'); ?><!--">-->
<!--    <link rel="stylesheet" href="--><?php //echo $this->createUrl('/css/font-awesome.min.css'); ?><!--">-->
    <link rel="stylesheet" href="<?php echo $this->createUrl('/css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo $this->createUrl('/css/style.css'); ?>">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>


</head>
<body>
    <div class="main">
        <div class="header">
            <div class="logo">
                <img src="<?php echo $this->createUrl('/img/news/logo.png')?>" class="head-logo" width="341" height="152"/>
            </div>
            <div class="head-announce">
                <p>ИЗГОТОВЛЕНИЕ КОВАННЫХ ИЗДЕЛИЙ И МЕТАЛЛОКОНСТРУКЦИЙ В ТОМСКЕ.</p>
                <p>Томск ул.Говорова 70/2</br> ТЕЛ: <span> +7(3822)50-26-34</span><br>ТЕЛ: <span> 8-909-538-80-05</span></p>
            </div>

            <?=$content?>


            <div class="nav-menu">
                <img src="<?php echo $this->createUrl('img/news/nav.png')?>" />
                <ul class="menu" id="accordion">
                    <li><a href="<?php echo $this->createUrl('/pages/index')?>">ГЛАВНАЯ</a></li>
                    <li><a href="<?php echo $this->createUrl('portfolio/portfolio');?>">НАШИ РАБОТЫ</a></li>
                        <ul class="menu-doch">
                            <?php foreach($this->categories() as $category):?>
                                <li><a href="<?php echo $this->createUrl('portfolio/portfolio', array('cat_id' => $category->id));?>"><?php echo $category->name;?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <li><a href="<?php echo $this->createUrl('/pages/comment')?>">ОТЗЫВЫ О НАС</a></li>
                </ul>
            </div>

            <img src="<?php echo $this->createUrl('/img/news/lustra.png')?>" class="lustra" />

    </div>
<!--    <footer>-->
        <div class="footer">
            <p>Copyright: 2015  Кованные изделия в Томске<br />
                Автор сайта: Санников А.В.</p>
                <div class="phone">
                    <p align="right">ИП Пасаженников г.Томск ул. Говорова 70/2<br> тел: +7(3822)50-26-34<br>
                        тел: 8-909-538-80-05
                    </p>
                </div>
        </div>
<!--    </footer>-->
</body>
</html>