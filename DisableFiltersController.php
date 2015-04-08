<?php
/* Security measure */
if (!defined('IN_CMS')) {
    exit();
}

class DisableFiltersController extends PluginController
{
    public function __construct()
    {
        $this->setLayout('backend');
        $settings         = Plugin::getSetting('parts', 'disable_filters');
        $this->settings   = $this->isJSON($settings) ? json_decode($settings, true) : $settings;
		$this->page_parts = $this->get_distinct_parts();
    }
	
    function get_distinct_parts()
    {

		// if available use the Record:find method (Wolf CMS 0.8.0 and higher)
        if (method_exists('Record', 'find') && is_callable(array('Record','find'))) {
            $result = Record::find(array('select' => "DISTINCT(name)",'from' => TABLE_PREFIX . "page_part"));
        } else {
            $result = Record::query("SELECT DISTINCT(name) FROM " . TABLE_PREFIX . "page_part")->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
    function isJSON($string)
    {
        return is_string($string) && is_object(json_decode($string)) ? false : true;
    }
    
    function settings()
    {
        $this->display('disable_filters/views/settings', array(
            'settings' => $this->settings,
            'page_parts' => $this->page_parts
        ));
    }
    
    function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $settings = isset($_POST['settings']) ? $_POST['settings'] : null;
            $setvalue = is_array($settings) ? json_encode($settings, true) : ' ';
            if (Plugin::setSetting('parts', $setvalue, 'disable_filters')) {
                Flash::set('success', __('The settings have been saved.'));
            } else {
                Flash::set('error', __('An error occured trying to save the settings.'));
            }
        } else {
            Flash::set('error', __('Could not save settings, no settings found.'));
        }
        redirect(get_url('plugin/disable_filters/settings'));
    }
    
} // end class
