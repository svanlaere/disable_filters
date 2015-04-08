<?php
if (!defined('IN_CMS')) {
    exit();
}

if (version_compare(PHP_VERSION, '5.3.0') <= 0) {
    Plugin::deactivate('disable_filters');
    Flash::set('error', __('This plugin requires PHP 5.3 or higher'));
}