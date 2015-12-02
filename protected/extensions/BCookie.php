<?php
class BCookie
{
	static function setCookieFromGet($name, array $values, $default = NULL, $pref = false)
	{
		$pref = !$pref ? Yii::app()->getController()->getId() . '_' . Yii::app()->getController()->getAction()->getId() : $pref;
		
		if (!isset($_GET['clear']))
		{		
		    if (isset($_GET[$name]) && in_array($_GET[$name], $values))
			{
				setcookie($pref . '_' . $name, $_GET[$name]);
				$_COOKIE[$pref . '_' . $name] = $_GET[$name]; 
				return $_GET[$name];
			}
			if (isset($_COOKIE[$pref . '_' . $name]) && in_array($_COOKIE[$pref . '_' . $name], $values))
			{
				return $_COOKIE[$pref . '_' . $name];
			}
		}
		
		setcookie($pref . '_' . $name, is_null($default) ? array_shift($values) : $default);
		return is_null($default) ? array_shift($values) : $default;	
	}
	
	static function setCookieNotCheck($name, $default, $pref = false)
	{
		$pref = !$pref ? Yii::app()->getController()->getId() . '_' . Yii::app()->getController()->getAction()->getId() : $pref;
		
		if (!isset($_GET['clear']))
		{		
		    if (isset($_GET[$name]))
			{
				setcookie($pref . '_' . $name, $_GET[$name]);
				$_COOKIE[$pref . '_' . $name] = $_GET[$name]; 
				return $_GET[$name];
			}
			if (isset($_COOKIE[$pref . '_' . $name]))
			{
				return $_COOKIE[$pref . '_' . $name];
			}
		}
		
		setcookie($pref . '_' . $name, $default);
		return is_null($default) ? array_shift($values) : $default;	
	}

		
	static function setCookieFromArrayPM($list, $name, $pattern, $default = NULL)
	{
		$pref = Yii::app()->getController()->getId() . '_' . Yii::app()->getController()->getAction()->getId();
		
		if (!isset($_GET['clear']))
		{		
		    if (isset($list[$name]) && preg_match($pattern, $list[$name]))
			{
				setcookie($pref . '_' . $name, $list[$name]);
				return $list[$name];	
			}
			if (isset($_COOKIE[$pref . '_' . $name]) && preg_match($pattern, $_COOKIE[$pref . '_' . $name]))
			{
				return $_COOKIE[$pref . '_' . $name];
			}
		}
		
		setcookie($pref . '_' . $name, $default);	
		return $default;	
	}
	
	static function setCookieFromArray($list, $name, array $values, $default = NULL)
	{
		$pref = Yii::app()->getController()->getId() . '_' . Yii::app()->getController()->getAction()->getId();
		
		if (!isset($_GET['clear']))
		{		
		    if (isset($list[$name]) && in_array($list[$name], $values))
			{
				setcookie($pref . '_' . $name, $list[$name]);
				return $list[$name];	
			}
			if (isset($_COOKIE[$pref . '_' . $name]) && in_array($_COOKIE[$pref . '_' . $name], $values))
			{
				return $_COOKIE[$pref . '_' . $name];
			}
		}
		
		setcookie($pref . '_' . $name, is_null($default) ? array_shift($values) : $default);
		return is_null($default) ? array_shift($values) : $default;		
	}
	
	
}