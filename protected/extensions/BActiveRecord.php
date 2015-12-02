<?php
class BActiveRecord extends CActiveRecord
{
    public function findAllByPage($criteria = false, $limit = 20, $with = false) {
        $page = isset($_GET['pages']) ? intval($_GET['pages']) : 0;
        
        if (is_string($criteria)) {          
            $order = $criteria;
            $criteria = new CDbCriteria;
            $criteria->order = $order;
            
        } elseif (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $order = $criteria->order;
        $criteria->order = '';

        if ($with)
        {
	    $maxPage = $this->with($with)->count($criteria) / $limit;
        }
        else
        {
            $maxPage = $this->count($criteria) / $limit;
        }
        

        $criteria->order = $order;
        
        $page = ($maxPage <= $page) ? floor($maxPage)-1 : $page;
    
        $criteria->offset = $page * $limit;
        $criteria->limit = $limit;
        
        if ($with)
        {
        	$rows = $this->with($with)->findAll($criteria);
        }
        else
        {
        	$rows = $this->findAll($criteria);
        }
        
        return array(
            'maxPage'  => $maxPage, 
            'thisPage' => $page, 
            'rows'  => $rows
        );
    }
    
    public function up($attr, $param = array()) 
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "{$attr} > {$this->$attr}"; 
		$criteria->order     = $attr;
		if ($param)
		{
		    $criteria->addColumnCondition($param);
		}
		
    	$model = $this->find($criteria);
		if ($model)
		{
		    
			$num = $this->$attr;
			$this->$attr = $model->$attr;
			$model->$attr = $num;
			$this->save();
			$model->save();	
		}
				
    }
    
    public function down($attr, $param = array()) 
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "{$attr} < {$this->$attr}"; 
		$criteria->order     = "{$attr} DESC";
		if ($param)
		{
		    $criteria->addColumnCondition($param);
		}
        
    	$model = $this->find($criteria);		
		if ($model)
		{
			$num = $this->$attr;
			$this->$attr = $model->$attr;
			$model->$attr = $num;
			$this->save();
			$model->save();	
		}
				
    }
}