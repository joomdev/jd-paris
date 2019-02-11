<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Carousel Module

# ------------------------------------------------------------------------

# Author:    DuongTVTemPlaza

# Copyright: Copyright (C) 2011-2018 tzportfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - http://tzportfolio.com/forum

# Family website: http://www.templaza.com

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;
$tzTemplate = TZ_Portfolio_PlusTemplate::getTemplateById($params -> get('template_id'));
$tplParams = $tzTemplate->params;
$ratio      =   $tplParams->get('ratio','5:3');
list($rwidth,$rheight)  =   explode(':', $ratio);
$doc = JFactory::getDocument();
$doc -> addStyleSheet(JUri::root() . '/components/com_tz_portfolio_plus/templates/'.$tzTemplate -> template.'/css/photoswipe/photoswipe.css');
$doc -> addStyleSheet(JUri::root() . '/components/com_tz_portfolio_plus/templates/'.$tzTemplate -> template.'/css/photoswipe/default-skin/default-skin.css');
$doc -> addScript(JUri::root() . '/components/com_tz_portfolio_plus/templates/'.$tzTemplate -> template.'/js/photoswipe.min.js');
$doc -> addScript(JUri::root() . '/components/com_tz_portfolio_plus/templates/'.$tzTemplate -> template.'/js/photoswipe-ui-default.min.js');
$doc -> addScript(JUri::root() . '/components/com_tz_portfolio_plus/templates/'.$tzTemplate -> template.'/js/lightbox.min.js');
$doc->addScriptDeclaration('
(function($){
            "use strict";
            $(document).ready(function(){ 
                $(\'#module__' . $module->id . ' .owl-item\').map(function () {
                    var colHeight = ($(this).width() * '.$rheight.')/'.$rwidth.';
                    $(this).find(\'.TzArticleMedia\').height(colHeight);
                });
                $("#module__' . $module->id . ' .owl-carousel").on(\'resized.owl.carousel\', function(event) {
                    $(\'#module__' . $module->id . ' .owl-item\').map(function () {
                        var colHeight = ($(this).width() * '.$rheight.')/'.$rwidth.';
                        $(this).find(\'.TzArticleMedia\').height(colHeight);
                    });
                })
                jQuery(\'.besleylightbox\').remove();
                besley_lightbox();
            });
            
        })(jQuery);
');
if($list){
?>
<div id="module__<?php echo $module -> id;?>" class="tplBesley tpp-module-carousel tpp-module__carousel<?php echo $moduleclass_sfx;?>">
    <div class="owl-carousel owl-theme element">
        <?php foreach($list as $i => $item){
            ?>
            <div class="TzInner">
                <?php
                if(isset($item->event->onContentDisplayMediaType)){
                    ?>
                    <div class="TzArticleMedia">
                        <?php echo $item->event->onContentDisplayMediaType;?>
                    </div>
                    <?php
                }
                if(!isset($item -> mediatypes) || (isset($item -> mediatypes) && !in_array($item -> type,$item -> mediatypes))){
                    if($params->get('show_title',1) or $params -> get('show_readmore',1) or $params -> get('show_author', 1) or $params->get('show_created_date', 1) or $params -> get('show_modified_date', 1) or $params -> get('show_publish_date', 1)
                        or $params->get('show_hit', 1) or $params->get('show_tag', 1)
                        or $params->get('show_category_main', 1) or $params->get('show_category_sec', 1)
                        or !empty($item -> event -> beforeDisplayAdditionInfo)
                        or !empty($item -> event -> afterDisplayAdditionInfo)) {
                        ?>
                        <div class="TzPortfolioDescription">
                            <?php
                            if ($params -> get('show_title', 1)) {
                                echo '<h3 class="TzPortfolioTitle"><a href="' . $item->link . '">' . $item->title . '</a></h3>';
                            }

                            //Call event onContentBeforeDisplay on plugin
                            if(isset($item -> event -> beforeDisplayContent)) {
                                echo $item->event->beforeDisplayContent;
                            }

                            if($params -> get('show_author', 1) or $params->get('show_created_date', 1) or $params -> get('show_modified_date', 1) or $params -> get('show_publish_date', 1)
                                or $params->get('show_hit', 1) or $params->get('show_tag', 1)
                                or $params->get('show_category_main', 1) or $params->get('show_category_sec', 1)
                                or !empty($item -> event -> beforeDisplayAdditionInfo)
                                or !empty($item -> event -> afterDisplayAdditionInfo)) {
                                ?>
                                <div class="muted tpMeta">
                                    <?php
                                    if (isset($item->event->beforeDisplayAdditionInfo)) {
                                        echo $item->event->beforeDisplayAdditionInfo;
                                    }

                                    if($params -> get('show_author', 1)){ ?>
                                        <div class="TzPortfolioCreatedby">
                                            <span class="tp tp-pencil"></span>
                                            <a href="<?php echo $item -> authorLink;?>"><?php echo $item -> author;?></a>
                                        </div>
                                    <?php } ?>
                                <?php if($params -> get('show_created_date', 1)){ ?>
                                    <div class="TzPortfolioDate">
                                        <span class="tp tp-clock-o"></span>
                                        <?php echo JHtml::_('date', $item -> created, JText::_('DATE_FORMAT_LC'));?>
                                    </div>
                                <?php } ?>
                                <?php if($params -> get('show_modified_date', 1)){ ?>
                                    <div class="TzPortfolioModified">
                                        <span class="tp tp-pencil-square-o"></span>
                                        <?php echo JHtml::_('date', $item -> modified, JText::_('DATE_FORMAT_LC'));?>
                                    </div>
                                <?php } ?>
                                <?php if($params -> get('show_publish_date', 1)){ ?>
                                    <div class="published">
                                        <span class="tp tp-clock-o"></span>
                                        <?php echo JHtml::_('date', $item -> publish_up, JText::_('DATE_FORMAT_LC'));?>
                                    </div>
                                <?php } ?>
                                    <?php if ($params->get('show_hit', 1)) {
                                        ?>
                                        <div class="TzPortfolioHits">
                                            <i class="tp tp-eye"></i>
                                            <?php echo $item->hits; ?>
                                            <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $item->hits; ?>" />
                                        </div>
                                        <?php
                                    }
                                    if ($params->get('show_tag', 1)) {
                                        if (isset($tags[$item->content_id])) {
                                            echo '<div class="tz_tag"><i class="fa fa-tag" aria-hidden="true"></i> ';
                                            foreach ($tags[$item->content_id] as $t => $tag) {
                                                echo '<a href="' . $tag->link . '">' . $tag->title . '</a>';
                                                if ($t != count($tags[$item->content_id]) - 1) {
                                                    echo ', ';
                                                }
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    if($params -> get('show_category_main', 1) || $params -> get('show_category_sec', 1)){ ?>
                                        <div class="TZcategory-name">
                                            <span class="tp tp-folder-open"></span>
                                            <?php if($params -> get('show_category_main', 1)){ ?>
                                                <a href="<?php echo $item -> category_link; ?>"><?php echo $item -> category_title;
                                                ?></a><?php
                                            }
                                            if($params -> get('show_category_sec', 1) && $item -> second_categories
                                                && count($item -> second_categories)){
                                                foreach($item -> second_categories as $secCategory){
                                                    ?><span class="tpp-module__carousel-separator">,</span>
                                                    <a href="<?php echo $secCategory -> link; ?>"><?php echo $secCategory -> title; ?></a>
                                                <?php }
                                            } ?>
                                        </div>
                                    <?php }
                                    if(isset($item -> event -> afterDisplayAdditionInfo)){
                                        echo $item -> event -> afterDisplayAdditionInfo;
                                    }
                                    ?>
                                </div>
                                <?php
                            }

                            if ($params->get('show_introtext', 1)) {
                                ?>
                                <div class="TzPortfolioIntrotext" itemprop="description"><?php echo $item->introtext;?></div>
                            <?php }

                            if(isset($item -> event -> contentDisplayListView)) {
                                echo $item->event->contentDisplayListView;
                            }
                            if($params -> get('show_readmore',1)){
                                ?>
                                <a href="<?php echo $item->link?>"
                                   class="btn btn-primary readmore"><?php echo $params -> get('readmore_text','Read More');?></a>
                            <?php }
                            ?>
                        </div>
                    <?php }
                } ?>

            </div>
        <?php } ?>
    </div>
</div>
<?php
}