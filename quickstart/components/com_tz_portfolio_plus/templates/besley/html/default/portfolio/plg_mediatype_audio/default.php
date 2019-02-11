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

$params = $this->params;
if($params -> get('mt_show_cat_audio',1)):
    if($item   = $this -> item) {
        if (isset($this->audio) && $audio = $this->audio) {
?>
<div class="tpGallery" itemprop="audio" itemscope itemtype="http://schema.org/AudioObject" style="background-image: url('<?php echo $audio -> thumbnail; ?>');">
    <div class="ImageOverlayMg">
        <div class="besley-title">
            <h3 class="TzPortfolioTitle name" itemprop="name">
                <?php if($params->get('cat_link_titles',1)) : ?>
                    <a href="<?php echo $item ->link; ?>"  itemprop="url">
                        <?php echo $item -> title; ?>
                    </a>
                <?php else : ?>
                    <?php echo $item -> title; ?>
                <?php endif; ?>
            </h3>

            <div class="iconhover">
                <span class="white-rounded"><a class="popup-item" href="<?php echo $audio -> thumbnail;?>" data-size="960x166" data-type="video" data-video='<div class="wrapper"><div class="video-wrapper"><iframe class="pswp__video" width="960" height="166" src="<?php echo $audio->url; ?>" frameborder="0" allowfullscreen></iframe></div></div>'><i class="fa fa-search"></i></a></span>
                <span class="white-rounded"><a href="<?php echo $item->link; ?>"><i class="fa fa-link"></i></a></span>
            </div>
        </div>
    </div>
</div>
<?php }
    }
endif;