<?php
class CommentsController extends CController{


//    //    �������� ������������
    public function actionAdd()
    {
        $model = new Comments();
        if(isset($_POST['comments'])){
            $model->attributes = $_POST['comments'];
            if($model->save()){
                $this->redirect($this->createUrl('comments/index'));
            }
        }
        $this->render('add',array('model' => $model));
    }
//    //    �������� ������������
    public function actionComment()
    {
        $rows = Comments::model()->findAll();
        $this->render('index',array('rows' => $rows));
    }




}