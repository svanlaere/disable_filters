<?php
/* Security measure */
if (!defined('IN_CMS')) {
    exit();
}
/**
 * Disable filters plugin - Polish
 */
return array(
    'Disable filters' => 'Wyłącz filtry',
	'Disables filters for specific partnames' => 'Wtyczka umożliwia wyłączenie filtrów dla wybranych część strony (zakładek).',
    'Select the part for which you want to disable the filters' => 'Wybierz zakładki, dla których filtry będą niedostępne.',
	'This plugin requires PHP 5.3 or higher' => 'Ta wtyczka wymaga PHP w wersji 5.3 lub nowszej.',
);