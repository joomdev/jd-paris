<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

$item   = $this -> item;
$image  = $this -> image;
$params = $this -> params;

if($item && $image && isset($image -> url) && !empty($image -> url)):
?>
    <?php
    $href   = null;
    $class  = null;
    $rel    = null;
    ?>
    <div class="tz_portfolio_plus_image">
        <?php if($params -> get('image_lightbox_enable', 1)){ ?>
        <a class="image-title" data-thumb="<?php
        echo (isset($image -> url_detail) && !$image -> url_detail)?$image -> url_detail:$image -> url;
        ?>" data-id="image<?php echo time();?>"<?php echo $params -> get('image_lightbox_caption_enable', 1)?' data-caption="'.(($image -> caption)?($image -> caption):$item -> title).'
        "':'';?> href="<?php
        echo (isset($image -> url_detail) && !$image -> url_detail)?$image -> url_detail:$image -> url; ?>">
        <?php } ?>
        <?php if(isset($image -> url_detail) && trim($image -> url_detail)):?>
            <img src="<?php echo $image -> url_detail;?>"
                 alt="<?php echo ($image -> caption)?($image -> caption):$item -> title;?>"
                 title="<?php echo ($image -> caption)?($image -> caption):$item -> title;?>" itemprop="image"/>
        <?php else : ?>
            <img src="<?php echo $image -> url;?>" alt="<?php echo ($image -> caption)?($image -> caption):$item -> title; ?>"
                 title="<?php echo ($image -> caption)?($image -> caption):$item -> title; ?>"
                 itemprop="image">
        <?php endif; ?>
        <?php if($params -> get('image_lightbox_enable', 1)){ ?>
        </a>
        <?php } ?>
    </div>
<?php endif;