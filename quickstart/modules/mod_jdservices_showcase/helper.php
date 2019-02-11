<?php

/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die;
JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
class modJDServicesShowcaseHelper {

   public static function formatGrid($services = []) {
      $services = (array) $services;
      $return = [];
      switch (count($services)) {
         case 1:
         case 2:
         case 3:
            $services = array_chunk($services, 1);
            foreach ($services as $serviceCol) {
               $return[] = $serviceCol;
            }
            break;
         case 4:
            $services = array_chunk($services, 2);
            $return[] = $services[0];
            $return[] = [$services[1][0]];
            $return[] = [$services[1][1]];
            break;
         case 5:
            $services = array_chunk($services, 3);
            $return[] = [$services[0][0], $services[0][1]];
            $return[] = [$services[0][2]];
            $return[] = $services[1];
            break;
         case 6:
            $services = array_chunk($services, 2);
            $return[] = $services[0];
            $return[] = $services[1];
            $return[] = $services[2];
            break;
      }
      return $return;
   }

   function get_post($id,$order,$sort){

      // Get a db connection.
      $db = JFactory::getDbo();

      // Create a new query object.
      $query = $db->getQuery(true);

      // Select all records from the user profile table where key begins with "custom.".
      // Order it by the ordering field.
      $query->select("*");
      $query->from($db->quoteName('#__content'));
      $query->where($db->quoteName('id') . ' = '. $db->quote($id));


      // Reset the query using our newly populated query object.
      $db->setQuery($query);

      // Load the results as a list of stdClass objects (see later for more options on retrieving data).
      $results = $db->loadObjectList();
      $items = array();
      foreach($results as $result){
         $items['title']=$result->title;
         $items['intro']=$result->introtext;
         $items['images']=$result->images;
         $items['link']=JRoute::_(ContentHelperRoute::getArticleRoute($result->id, $result->catid, $result->language));
          
      }
      
      return $items;
   }
}
