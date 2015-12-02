<?php
class BFile 
{
    public static $baseImgPath = '/images';
    public static $validImgFormat = array('jpg', 'gif');
    private static $formatMap = array (
                1 => 'gif', 
                2 => 'jpg', 
                3 => 'png', 
                4 => 'swf', 
                5 => 'pds', 
                6 => 'bmp', 
                7 => 'tiff', 
                8 => 'tiff', 
                9 => 'jpc', 
                10 => 'jp2', 
                11 => 'jpx'
            );
    public static $validImgWidth = 1000;
    public static $validImgHeight = 1000;
    public static $validImgSize = 500;
    public static $lastError = false;
    
    public static $imgErrors = array (
                'notFoundFile' => 'Файл не найден',
                'moreWidth'  =>  'Ширина изображения больше чем [err]px',
    			'moreHeight' =>  'Высота изображения больше чем [err]px',
    			'moreSize'   =>  'Размер изображения больше чем [err]кб',
                'notValidType' => 'Разрешены к загрузке файлы только следующих типов: [err]'               
            );

    public static function uploadImg($id, $in) {
        if (!isset($_FILES[$id])) {
            return false;
        }
        $file = $_FILES[$id];
        $img = getimagesize($file['tmp_name']);
        $upload = move_uploaded_file($file['tmp_name'], getcwd() . 
                    self::$baseImgPath . $in . '.' . self::$formatMap[$img[2]]);
        if ($upload) {
            return self::$formatMap[$img[2]];
        }
        return false;  
    } 
    
    public static function is_not_valid($id) {
        if (!isset($_FILES[$id])) {
            self::$lastError = 'notFoundFole';
            return self::$imgErrors['notFoundFile'];
        }
        $file = $_FILES[$id];
        list($width, $height, $type) = getimagesize($file['tmp_name']);
        $type = self::$formatMap[$type];
        $size = $file['size'] / 1024;
        if (!in_array($type, self::$validImgFormat)) {
            return self::setErrorImg(implode(', ', self::$validImgFormat), 'notValidType');
        }
        if ($width > self::$validImgWidth) {
            return self::setErrorImg(self::$validImgWidth, 'moreWidth');
        }
        if ($height > self::$validImgHeight) {
            return self::setErrorImg(self::$validImgHeight, 'moreHeight');
        }
        
        return false;
        
    }
    public static function setErrorImg($value, $err) {
        self::$lastError = $err;
        return str_replace("[err]", $value, self::$imgErrors[$err]);
    }
    
    public static function resizeImage($imageFrom, $imageTo, $fitWidth=600, $fitHeight=600, $quality=75) {

         $imageFrom = getcwd() . self::$baseImgPath . $imageFrom;
         $imageTo = getcwd() . self::$baseImgPath . $imageTo;
         
         $os = $originalSize = getimagesize($imageFrom);
                           
         if ($originalSize <=0 && $originalSize > 3) {
             return false;
         }
         
         if($originalSize[0]>$fitWidth || $originalsize[1]>$fitHeight) {
             $h=$originalSize;
             if (($h[0]/$fitWidth)>($h[1]/$fitHeight)) {
                 $fitHeight = $h[1] * $fitWidth / $h[0];
             } else {
                 $fitWidth= $h[0] * $fitHeight / $h[1];
             }

             if($os[2]==2 || ($os[2]>=9 && $os[2]<=12)) {
                 $i = ImageCreateFromJPEG($imageFrom);
             } elseif ($os[2] == 3) {
                 $i = ImageCreateFromPng($imageFrom);
             } elseif ($os[2] == 1) {
                 $i = imagecreatefromgif($imageFrom); 
             }

             $o = ImageCreateTrueColor($fitWidth, $fitHeight);
             imagecopyresampled($o, $i, 0, 0, 0, 0, $fitWidth, $fitHeight, $h[0], $h[1]);
             imagejpeg($o, $imageTo, $quality); 
             chmod($imageTo,0666);
             imagedestroy($o);
             imagedestroy($i);
             return true;
         }
         
         if($originalSize[0]<=$fitWidth && $originalSize[1]<=$fitHeight) {
             if($os[2]==2 || ($os[2]>=9 && $os[2]<=12)) {
                 $i = ImageCreateFromJPEG($imageFrom);
             } elseif ($os[2] == 3) {
                 $i = ImageCreateFromPng($imageFrom);
             } elseif ($os[2] == 1) {
                 $i = imagecreatefromgif($imageFrom); 
             }
             imagejpeg($i, $imageTo, $quality); 
             chmod($imageTo,0666);
             return true;
         }
     } 
}