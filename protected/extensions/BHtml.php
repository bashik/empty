<?php
class BHtml extends CHtml 
{
    public static function select($value, $inner, $name, $cmp = false, $rows = false, $base = array(), $htmlOption = array())
    {
        $htmlOption ['id'] = $name;
        $htmlOption ['name'] = $name;
        $html = self::tag('select', $htmlOption, false, false);
        
        foreach ($base AS $key=>$val) {
            $opt = array('value'=>$key);
            if ($cmp == $key) {
                $opt['selected'] = 'selected';
            } 
            $html .= self::tag('option', $opt, $val);           
        }
        if ($rows) {
            foreach ($rows AS $row) {
                $opt = array('value'=>$row->$value);
                if ($cmp == $row->$value) {
                    $opt['selected'] = 'selected';
                }
                $html .= self::tag('option', $opt,$row->$inner);
            }
        }
        return $html . '</select>';
    }
    
    public static function activeSelect($form, $name, $options = array(), $htmlOption = array(), $flKey = false) 
    {
        self::resolveNameID($form, $name, $htmlOption);
        
        $html = self::tag('select', $htmlOption, false, false);
        
        foreach ($options AS $key=>$val) {
            if ($flKey) {
                $key = $val;
            }
            $opt = array('value'=>$key);
            if ($form->$name == $key) {
                $opt['selected'] = 'selected';
            } 
            $html .= self::tag('option', $opt, $val);           
        }
        
        return $html . '</select>';
    }
    
    public static function listSelect($value, $name, $options = array(), $htmlOption = array(), $flKey = false) 
    {
        $htmlOption['name'] = isset($htmlOption['name']) ? $htmlOption['name'] : $name;
        
        $html = self::tag('select', $htmlOption, false, false);
        
        foreach ($options AS $key=>$val) {
            if ($flKey) {
                $key = $val;
            }
            $opt = array('value'=>$key);
            if ($value == $key) {
                $opt['selected'] = 'selected';
            } 
            $html .= self::tag('option', $opt, $val);           
        }
        
        return $html . '</select>';
    }
    
    public static function activeCheckboxListOld($model, $id, $name, $val, $chname = false, $all = true)
    {
        if (!$chname)
        {
            $chname = $id;
        }
        $selectName = 'Любая';
        $list = self::checkBoxList($model, $id, $name, $val, &$selectName, $chname, $all);
        return self::textField($name, $selectName, array('readonly' => 'readonly', 'name' => $name, 'class' => 'checkboxInput')) .
               self::link('выбрать', '#TB_inline?height=200&width=250&inlineId=' . $id . '_' . $name . '&modal=false', array('class' => 'thickbox')) .
               $div = '<div title="Выбрать категорию" style="display: none;" id="' . $id . '_' . $name . '">' .
               '<div class="checkBoxList" />' .
               '<ul>' . $list  . '</ul>' .
               $div .= '</div></div>';

    }
    
    public static function checkBoxList ($model, $id, $name, $val, $selectName, $chname, $all)
    {
        $li = '<li>';
        $li .= $model->$name;
        if (!$model->child || ($model->$id == 0 && $all))
        {
            $li .= self::radioButton($chname, $model->$id == $val ,
                            array(
                                'id' => 'ch' . $model->$id, 'value' => $model->$id,
                                'onchange' => "return setList(this,'{$name}');"
                            )
            );
            if ($model->$id == $val)
            {
                $selectName = $model->$name;
            }
            $li .= '<input type="hidden" value="' . $model->$name . '" id = "val_ch' . $model->$id . '" />';
        }
       
        if ($model->child)        {
            $li .= '<ul>';
            foreach ($model->child AS $row)
            {
                $li .= self::checkBoxList ($row, $id, $name, $val, &$selectName, $chname, $all);
            }
            $li .= '</ul>';
        }
        $li .= '</li>';
        return $li;
    }
}