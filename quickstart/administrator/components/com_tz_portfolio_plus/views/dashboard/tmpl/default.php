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

$xml	        = simplexml_load_file(COM_TZ_PORTFOLIO_PLUS_ADMIN_PATH.'/tz_portfolio_plus.xml');

$this->document->addStyleSheet(TZ_Portfolio_PlusUri::base() . '/vendor/intro/introjs.min.css', array('version' => 'v=2.9.3'));
$this->document->addScript(TZ_Portfolio_PlusUri::base() . '/vendor/intro/intro.min.js', array('version' => 'v=2.9.3'));
$this->document->addScript(TZ_Portfolio_PlusUri::base() . '/js/introguide.min.js', array('version' => 'v=2.9.3'));

if(JFactory::getLanguage() -> isRtl()) {
    $this->document->addStyleSheet(TZ_Portfolio_PlusUri::base() . '/vendor/intro/introjs-rtl.min.css', array('version' => 'v=2.9.3'));
}

$this -> document -> addScriptDeclaration('
(function($){
    "use strict";    
    $(document).ready(function(){
        tppIntroGuide("'.$this -> getName().'", [
                {
                    /* Step 1: Video tutorial */
                    element: $("#toolbar-youtube")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_VIDEO_TUTORIALS'))
                        .'</div>'.$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_GUIDE_VIDEO_TUTORIALS_DESC')).'",
                    position: "left"
                },
                {
                    /* Step 2: Document */
                    element: $("#toolbar-help")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape('JHELP').'</div>'.
                        $this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_GUIDE_HELP_DESC')).'",
                    position: "left"
                },
                {
                    /* Step 3: Options */
                    element: $("#toolbar-options")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape(JText::_('JOPTIONS')).'</div>'
                        .$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_GUIDE_GLOBAL_CONFIGURATION_DESC')).'",
                    position: "left"
                },
                {
                    /* Step 4: Sidebar */
                    element: $("#j-sidebar-container")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape(JText::_('JTOGGLE_SIDEBAR_LABEL')).'</div>'
                        .$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_GUIDE_SIDEBAR_DESC')).'",
                    position: "right"
                },
                {
                    /* Step 5: Quick link */
                    element: $(".tpQuicklink")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_QUICK_LINKS')).'</div>'
                        .$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_GUIDE_QUICK_LINK_DESC')).'",
                    position: "top"
                },
                {
                    /* Step 6: Information */
                    element: $(".tpInfo")[0],
                    intro: "<div class=\\"head\\">'.$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INFORMATION')).'</div>'
                        .$this -> escape(JText::_('COM_TZ_PORTFOLIO_PLUS_INTRO_INFORMATION_DESC')).'",
                    position: "left"
                }], '.(TZ_Portfolio_PlusHelper::introGuideSkipped($this -> getName())?1:0).', "'.JSession::getFormToken().'");
                
        var compareVersion = function (curVer, onVer) {
            for (var i=0; i< curVer.length || i< onVer.length; i++){
                if (curVer[i] < onVer[i]) {
                    return true;
                }
            }
            return false;
        };
        $.ajax({
            url: "index.php?option=com_tz_portfolio_plus",
            type: "POST",
            dataType: "json",
            data: {
                task: "dashboard.checkupdate"
            },
            success: function(result){
                if(result && result.success == true && result.data){
                    var latestVersion = result.data;
                    var currentVersion = $(".local-version span").attr("data-local-version");
                    $(".latest-version span").attr("data-online-version",latestVersion).html(latestVersion);
                    $(".checking").css("display", "none");
                    if (compareVersion(currentVersion, latestVersion)) {
                        $(".requires-updating").css("display","block");
                        $(".local-version span").addClass("oldversion");
                    } else {
                        $(".latest").css("display","block");
                    }
                }
            },
            beforeSend: function() {
                $(".checking").css("display", "block");
            }
        });
        $.ajax({
            url: "index.php?option=com_tz_portfolio_plus",
            type: "POST",
            dataType: "json",
            data: {
                task: "dashboard.feedblog"
            },
            success: function(result){
                if(result.data){
                    $(".tpDashboard .tpInfo").after(result.data);
                }
            }            
        });
    });
})(jQuery);
');
?>

<?php echo JHtml::_('tzbootstrap.addrow');?>
    <?php if(!empty($this -> sidebar)){?>
        <div id="j-sidebar-container" class="span2 col-md-2">
            <?php echo $this -> sidebar; ?>
        </div>
    <?php } ?>

    <?php echo JHtml::_('tzbootstrap.startcontainer', '10', !empty($this -> sidebar),
        array('containerclass' => false));?>

        <div class="tpDashboard">
            <div class="tpHeadline">
                <h2 class="reset-heading"><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_DASHBOARD'); ?></h2>
                <p><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_DASHBOARD_DESC'); ?></p>
            </div>
            <?php echo JHtml::_('tzbootstrap.addrow');?>
                <div class="span7 col-md-7">
                    <div class="tp-widget free-license">
                        <span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_GET_FREE_PERSONAL_LICENSE'); ?></span>
                        <a href="<?php echo $xml -> freelicenseUrl; ?>" class="btn btn-danger" target="_blank"><?php
                            echo JText::_('COM_TZ_PORTFOLIO_PLUS_GET_NOW'); ?></a>
                    </div>
                    <div class="tpQuicklink">
                        <?php
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=articles', 'icon-64-articles.png', 'COM_TZ_PORTFOLIO_PLUS_ARTICLES');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=categories', 'icon-64-categories.png', 'COM_TZ_PORTFOLIO_PLUS_CATEGORIES');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=featured', 'icon-64-featured.png', 'COM_TZ_PORTFOLIO_PLUS_FEATURED');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=fields', 'icon-64-fields.png', 'COM_TZ_PORTFOLIO_PLUS_FIELDS');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=groups', 'icon-64-groups.png', 'COM_TZ_PORTFOLIO_PLUS_FIELD_GROUPS');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=tags', 'icon-64-tags.png', 'COM_TZ_PORTFOLIO_PLUS_TAGS');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=addons', 'icon-64-addons.png', 'COM_TZ_PORTFOLIO_PLUS_ADDONS');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=template_styles', 'icon-64-styles.png', 'COM_TZ_PORTFOLIO_PLUS_TEMPLATE_STYLES');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=templates', 'icon-64-templates.png', 'COM_TZ_PORTFOLIO_PLUS_TEMPLATES');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=extension&layout=upload', 'icon-64-modules.png', 'COM_TZ_PORTFOLIO_PLUS_EXTENSIONS');
                        $this->_quickIcon('index.php?option=com_tz_portfolio_plus&view=acls', 'icon-64-security.png', 'COM_TZ_PORTFOLIO_PLUS_ACL');
                        $this->_quickIcon('index.php?option=com_config&view=component&component=com_tz_portfolio_plus&return=' . urlencode(base64_encode(JUri::getInstance())), 'icon-64-configure.png', 'COM_TZ_PORTFOLIO_PLUS_CONFIGURE');
                        ?>
                    </div>
                    <?php echo $this -> loadTemplate('statistics'); ?>
                    <?php echo $this -> loadTemplate('license'); ?>
                </div>
                <div class="span5 col-md-5">
                    <div class="tpInfo">
                        <div class="tpDesc">
                            <?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_DESCRIPTION_2'); ?>
                        </div>
                        <div class="tpVersion">
                            <b class="checking">
                                <i class="tps tp-circle-notch tp-spin"></i> <?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_CHECKING_FOR_UPDATES'); ?></b>
                            <b class="latest"><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_SOFTWARE_IS_UP_TO_DATE'); ?></b>
                            <b class="requires-updating">
                                <?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_REQUIRES_UPDATING'); ?>
                                <a href="http://www.tzportfolio.com/" class="btn btn-default btn-sm btn-secondary"><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_UPDATE_NOW'); ?></a>
                            </b>
                            <div class="versions-meta">
                                <div class="text-muted local-version"><?php echo JText::sprintf('COM_TZ_PORTFOLIO_PLUS_INSTALLED_VERSION', '');?> <span data-local-version="<?php echo $xml->version; ?>"><?php echo $xml->version; ?></span></div>
                                <div class="text-muted latest-version"><?php echo JText::sprintf('COM_TZ_PORTFOLIO_PLUS_LATEST_VERSION', '');?> <span data-online-version="">N/A</span></div>
                            </div>
                        </div>
                        <div class="tpDetail">
                            <ul>
                                <li><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_AUTHOR'); ?>:</span> <a href="<?php echo $xml -> authorUrl;?>" target="_blank"><?php echo $xml->author; ?></a></li>
                                <li><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_COPYRIGHT'); ?>:</span> <?php echo $xml->copyright; ?></li>
                                <li><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_SUPPORT'); ?>:</span> <a href="<?php echo $xml->forumUrl; ?>" title="<?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_SUPPORT'); ?>" target="_blank"><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_SUPPORT_DESC'); ?></a></li>
                                <li><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_GROUP'); ?>:</span> <a href="<?php echo $xml->facebookGroupUrl; ?>" target="_blank"><?php echo $xml->facebookGroupUrl; ?></a></li>
                                <li><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_FANPAGE'); ?>:</span> <a href="<?php echo $xml->facebookUrl; ?>" target="_blank"><?php echo $xml->facebookUrl; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php echo JHtml::_('tzbootstrap.endrow');?>
        </div>
    <?php echo JHtml::_('tzbootstrap.endcontainer');?>
<?php echo JHtml::_('tzbootstrap.endrow');?>