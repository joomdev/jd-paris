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

if (!COM_TZ_PORTFOLIO_PLUS_JVERSION_4_COMPARE) {
    JHtml::_('formbehavior.chosen', 'select');
} else {
    JHtml::_('formbehavior.chosen', 'select[multiple]');
}

$layoutData = array(
    'params'   => array(
        'url'        => '',
        'width'      => '400px',
        'height'     => '800px',
    )
);
$listOrder	    = $this->escape($this->state->get('list.ordering'));
$xml        = simplexml_load_file(COM_TZ_PORTFOLIO_PLUS_ADMIN_PATH.'/tz_portfolio_plus.xml');
$iframeHtml = JLayoutHelper::render('joomla.modal.iframe', $layoutData);

$doc    = JFactory::getDocument();
$doc -> addScript(TZ_Portfolio_PlusUri::base(true, true).'/js/server-list.min.js', array('version' => 'auto'));
$doc -> addScriptDeclaration('(function($){
    "use strict";
    $(document).ready(function(){
        $("#adminForm").tppServerList({
            "view"      : "template",
            "iframeHtml": "' . str_replace('"', '\\"',trim($iframeHtml)) . '",
            "formToken" : "'.JSession::getFormToken().'",
            "ajax"              : {
                "data"          : {
                    "limitstart": '.$this -> state -> get('list.start', 0).'
                }
            },
            "installNow":{
                "loadingHtml"   : "<span class=\\"loading\\"><span class=\\"tps tp-sync-alt text-update tp-spin\\"></span> '
                                .JText::_('COM_TZ_PORTFOLIO_PLUS_INSTALLING').'</span>",
                "installedHtml" : "<span class=\\"installed\\"><span class=\\"tps tp-check\\"></span> '
                                .JText::_('COM_TZ_PORTFOLIO_PLUS_INSTALLED').'</span>",
                "ajax"              : {
                    "data"          : {
                        "task"      : "template.ajax_install"
                    }
                }
            }
        });
    });
})(jQuery);');

$dataServer = $this -> state -> get('list.dataserver');
?>
<div class="tpContainer">
    <button type="button" data-toggle="collapse" data-target="#tpp-template__upload"
            class="btn btn-success pull-left float-left hasTooltip tpp-extension__btn-collapse" title="<?php echo JText::_('JTOOLBAR_UPLOAD');
            ?>"><span class="icon-upload"></span> <?php echo JText::_('JTOOLBAR_UPLOAD'); ?></button>
    <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
    ?>
</div>

<div class="tpp-extension__upload-form collapse" id="tpp-template__upload">
    <fieldset class="adminForm">
        <legend><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_UPLOAD_AND_INSTALL_TEMPLATE');?></legend>
        <div class="form-horizontal">
            <div class="control-group">
                <div class="control-label"><?php echo $this -> form -> getLabel('install_package');?></div>
                <div class="controls"><?php echo $this -> form -> getInput('install_package');?></div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="button" class="btn btn-primary btn-small" onclick="Joomla.submitbutton('template.install')">
                        <?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_UPLOAD_AND_INSTALL');?></button>
                </div>
            </div>
        </div>
    </fieldset>
</div>

<div class="tpp-extension__list">
    <div class="alert alert-warning alert-no-items" style="display: none;" data-tpp-error>
        <?php echo JText::sprintf('COM_TZ_PORTFOLIO_PLUS_ERROR_LOADING_FROM_SERVER', $xml -> authorUrl, $xml->forumUrl); ?>
    </div>
    <div class="tpp-extension__list-inner">
        <div class="loading" data-tpp-loading>
            <span class="tps tp-circle-notch tp-spin"></span><span><?php echo JText::_('COM_TZ_PORTFOLIO_PLUS_SETUP_LOADING');?>...</span>
        </div>
        <div class="tpp-extension__flexbox" data-tpp-extension-list></div>
    </div>
    <div data-tpp-pagination></div>
</div>