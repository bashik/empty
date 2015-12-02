<?php
class BImageActiveRecord extends BActiveRecord
{   
    public function image ($attribute,$params)
    {
    	$oldImage = '.' . $this->$attribute;
    	
    	$newImage = CUploadedFile::getInstance($this, $attribute);
    	if (isset($params['baseAttr']) && !$newImage && !$this->$attribute)
    	{
    		$newImage = CUploadedFile::getInstance($this, $params['baseAttr']);
    	}
    	
    	if (!$newImage)
    	{
    		$req = isset($params['req']) ? $params['req'] : $this->isNewRecord;
    		if ($req)
    		{
    			$this->addError($attribute, $this->getAttributeLabel($attribute) . ' должно быть загружено');
    		}
    		
    		return false;
    	}
    	$typeList = array (
    		1 => 'gif',
    		2 => 'jpg',
    		3 => 'png'
    	);
    	
    	list ($width, $height, $type) = getimagesize($newImage->tempName);
    	    	
    	$typeName = isset($typeList[$type]) ? $typeList[$type] : 'undifined';
    	
    	if (isset($params['types']))
    	{
    		if (strpos($params['types'], $typeName) === false)
    		{
    			$this->addError($attribute, $this->getAttributeLabel($attribute) . ' - к загрузке разрешены только следующие форматы: ' . $params['types']);
    			return false;
    		}
    	}
    	
    	$size = $newImage->size;
    	if (isset($params['maxSize']) && $size > $params['maxSize'])
    	{
    		$maxSize = $params['maxSize'];
    		$viewSize = '';
	    	if ($maxSize < 1024)
	    	{
	    		$viewSize = $size . ' байт';
	    	}
	    	elseif ($maxSize < 1024 * 1024)
	    	{
	    		$viewSize = number_format($maxSize / 1024, 3) .  ' Кбайт';
	    	} 
	    	else
	    	{
	    		$viewSize = number_format($maxSize / 1024 / 1024, 3) .  ' Мбайт';
	    	} 
    		
    		$this->addError($attribute, $this->getAttributeLabel($attribute) . ' - к загрузке разрешены файлы размером не более: ' . $viewSize);
    		return false;
    	}

    	$minWidth = isset($params['minWidth']) ? $params['minWidth'] : 0;
		$minHeight = isset($params['minHeight']) ? $params['minHeight'] : 0;
		$maxHeight = isset($params['maxHeight']) ? $params['maxHeight'] : 800;
		$maxWidth = isset($params['maxWidth']) ? $params['maxWidth'] : 400;
		
		if ($minWidth > $width)
		{
			$this->addError($attribute, $this->getAttributeLabel($attribute) . ' - к загрузке разрешены изображение шириной не менее: ' . $minWidth);
    		return false;
		}
    	
		if ($minHeight > $height)
		{
			$this->addError($attribute, $this->getAttributeLabel($attribute) . ' - к загрузке разрешены изображение высотой не менее: ' . $minHeight);
    		return false;
		}
		$dir = strtolower($this->tableName()) . '_img';
		$path = './upload/' . $dir;
		$url = '/upload/' . $dir;
		if (!file_exists($path))
		{
			if (!mkdir($path, 0777))
			{
				$this->addError($attribute, $this->getAttributeLabel($attribute) . ' - не удалось создать каталог');
    			return false;
			}
			chmod($path, 0777);
		}
		
		$pathToFile = tempnam($path, strtolower($this->tableName()) . '_');
		unlink($pathToFile);
		$pathToFile .= '.' . $typeName;
		$nameFile = basename($pathToFile);
		$newImage->saveAs($pathToFile, false);
		chmod($pathToFile, 0766);
		$this->$attribute = $url . '/' . $nameFile;
		
		if ($oldImage != '.' && file_exists($oldImage))
		{
			unlink($oldImage);
		}
		
		if ($width > $maxWidth || $height > $maxHeight)
		{
			$image = Yii::app()->image->load($pathToFile);
			$image->resize($maxWidth, $maxHeight);
			$image->save();
		}
		
    	return true;
    }
    
    public function afterValidate()
    {
    	if ($this->getErrors())
    	{
    		foreach ($this->rules() AS $rule)
    		{
    			if ($rule[1] == 'image')
    			{
    				$attr = $rule[0];
    				if (file_exists('.' .  $this->$attr) && $this->$attr)
    				{
    					unlink('.' .  $this->$attr);
    				}
    			}
    		}
    	}
    	return true;
    }
    
    public function afterDelete()
    {
    	foreach ($this->rules() AS $rule)
    	{
    		if ($rule[1] == 'image')
    		{
    			$attr = $rule[0];
    			if ($this->$attr && file_exists('.' .  $this->$attr))
    			{
    				unlink('.' .  $this->$attr);
    			}
    		}
    	}
    }
	public function getSafeAttributeNames()
	{
		$safeList = parent::getSafeAttributeNames();
		$safeRetList = array();
		foreach ($safeList AS $safe)
		{
			if (array_pop(explode('_', $safe )) != 'img')
			{
				$safeRetList []= $safe;				
			}
		}
		return $safeRetList;		
	}    
}