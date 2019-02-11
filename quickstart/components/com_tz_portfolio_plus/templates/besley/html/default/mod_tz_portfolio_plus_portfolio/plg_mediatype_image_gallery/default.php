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

if($params -> get('mt_show_image_gallery',1)):
    list($width, $height) = getimagesize($slider -> url[0]);
    ?>
    <div class="tz_portfolio_plus_image_gallery" style="background-image: url('<?php echo $slider -> url[0];?>');">
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
                    <span class="white-rounded"><a class="popup-item" href="<?php echo $slider -> url[0];?>" data-size="<?php echo $width.'x'.$height; ?>"><i class="fa fa-search"></i></a></span>
                    <span class="white-rounded"><a href="<?php echo $item->link; ?>"><i class="fa fa-link"></i></a></span>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;?>