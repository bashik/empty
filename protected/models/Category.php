<?php
class Category extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'portfolio'=>array(self::HAS_MANY, 'Portfolio', 'category_id'),
        );
    }

//    public function tableName()
//    {
//        return 'portfolio';
//
//    }


}