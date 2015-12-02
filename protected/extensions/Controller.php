<?php
class Controller extends CController{
    public function categories()
    {
        return Category::model()->findAll();
    }


}