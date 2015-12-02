<?php
class Comments extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'otzivi';
    }

    public function rules()
    {
        return array(
            array('name, text', 'required'),
            array('date', 'safe'),

        );
    }

    public function attributeLabels() {
        return array(
            'date' => 'Дата',
            'name' => 'Ваше имя',
            'text' => 'Комментарий',
        );
    }

}