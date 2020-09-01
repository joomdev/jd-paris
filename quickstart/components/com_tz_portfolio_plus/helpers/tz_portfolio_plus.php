<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# Author:    DuongTVTemPlaza

# Copyright: Copyright (C) 2011-2018 TZ Portfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - https://www.tzportfolio.com/help/forum.html

# Family website: http://www.templaza.com

# Family Support: Forum - https://www.templaza.com/Forums.html

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

use Joomla\Filesystem\File;

jimport('joomla.filesystem.file');

class TZ_Portfolio_PlusFrontHelper{

    protected static $cache = array();

    public static function getImageURLBySize($url, $size = 'o'){
        if(!$url){
            return false;
        }
        $newUrl     = $url;
        if($size) {
            $newUrlExt  = \JFile::getExt($url);
            $newUrl     = str_replace('.' . $newUrlExt, '_' . $size . '.' . $newUrlExt, $newUrl);
        }

        return $newUrl;

    }

    public static function scriptExists($funcRegex, $flags = 0){
        $storeId    = __METHOD__;
        $storeId   .= ':'.$funcRegex;
        $storeId   .= ':'.$flags;
        $storeId    = md5($storeId);

        if(isset(self::$cache[$storeId])){
            return self::$cache[$storeId];
        }

        $doc    = JFactory::getDocument();
        if(preg_match($funcRegex, $doc -> _script["text/javascript"], $match, $flags)){
            return true;
        }
        return false;
    }
}