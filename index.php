<?php
/* Security measure */
if (!defined('IN_CMS')) {
    exit();
}

Plugin::setInfos(array(
    'id' => 'disable_filters',
    'title' => __('Disable filters'),
    'description' => __('Disables filters for specific partnames'),
    'version' => '0.1.0',
    'license' => 'GPLv3',
    'author' => 'svanlaere',
    'website' => 'http://svanlaere.nl/',
    'update_url' => 'http://svanlaere.nl/plugin-versions.xml',
    'require_wolf_version' => '0.7.7'
));

Plugin::addController('disable_filters', __('Disable filters'), 'admin_view', false);

Observer::observe('view_page_edit_tabs', 'df_inject_javascript');
Observer::observe('part_edit_before_save', 'df_set_filter_none');

function df_parts_names()
{
    return json_decode(Plugin::getSetting('parts', 'disable_filters'), true);
}

function df_set_filter_none(&$part)
{
    if (is_array(df_parts_names())) {
        if (in_array($part->name, df_parts_names()) && (!empty($part->filter_id))) {
            $part->filter_id == NULL;
        }
        return $part;
    }
}

function df_inject_javascript()
{
    if (is_array(df_parts_names())) {
        echo new View(PLUGINS_ROOT . DS . 'disable_filters/views/javascript', array(
            'parts' => json_encode(df_parts_names())
        ));
    }
}
