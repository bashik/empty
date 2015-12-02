<?php
class PagesController extends Controller{
    //   цкюбмюъ ярпюмхжю яюирю
    public function actionIndex()
    {
        $rows = Pages::model()->findByPk(1);
        $this->render('index',array('model' => $rows));
    }
    //   цкюбмюъ ярпюмхжю яюирю

//    //    ярпюмхжю йнллемрюпхеб
    public function actionComment()
    {
        $rows = Comments::model()->findAll();
        $model = new Comments();
        if (isset($_POST['Comments'])) {
            $model->attributes = $_POST['Comments'];
            if ($model->save()) {
                $this->redirect($this->createUrl('pages/comment'));
            }
        }
        $this->render('comment',array('rows' => $rows,'model' => $model));
    }
//    //    ярпюмхжю йнллемрюпхеб


//    //    ярпюмхжю онпртнкхн
//    public function actionPortfolio($cat_id = 0)
//    {
//        if ($cat_id) {
//            $model = Category::model()->findByPk(intval($cat_id));
//        } else {
//            $model = Category::model()->find();
//        }
//
////        $rows = Portfolio::model()->findAll();
//        $this->render('portfolio',array('model' => $model));
//    }
//    //    ярпюмхжю онпртнкхн

}