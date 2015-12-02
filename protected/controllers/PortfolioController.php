<?php
class PortfolioController extends Controller{



    //    ярпюмхжю онпртнкхн
    public function actionPortfolio($cat_id = 0)
    {
        if ($cat_id) {
            $model = Category::model()->findByPk(intval($cat_id));
        } else  {
            $model = Category::model()->find();
        }

//        $model = Category::model()->findAll();
        $this->render('portfolio',array('model' => $model));
    }
    //    ярпюмхжю онпртнкхн

}