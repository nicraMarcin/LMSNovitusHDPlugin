<?php

/**
 * InitHandler
 *
 * @author MarcinRomanowski <marcin@nicram.net>
 */

class InitHandler
{

	/**
	 * Sets plugin Smarty templates directory
	 *
	 * @param Smarty $hook_data Hook data
	 * @return \Smarty Hook data
	 */
	public function smartyInit(Smarty $hook_data)
	{
		global $SMARTY;
		$template_dirs = $hook_data->getTemplateDir();
		$plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSNovitusHDPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
		array_unshift($template_dirs, $plugin_templates);
		$hook_data->setTemplateDir($template_dirs);
		$SMARTY->assign('plugin_name', LMSNovitusHDPlugin::PLUGIN_DIRECTORY_NAME);
		return $hook_data;
	}

	/**
	 * Sets plugin Smarty modules directory
	 *
	 * @param array $hook_data Hook data
	 * @return array Hook data
	 */
	public function modulesDirInit(array $hook_data = [])
	{
		$plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSNovitusHDPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
		array_unshift($hook_data, $plugin_modules);
		return $hook_data;
	}


	/**
	 * @param array $hook_data
	 * @return array
	 */
	public function menuEntry(array $hook_data = [])
	{

		$novitusmenu = [
			'novitus' => [
				'name' => trans('Fiscal Printer'),
				'img' => '../plugins/' . LMSNovitusHDPlugin::PLUGIN_DIRECTORY_NAME . '/img/fiscalprinter.png',
				'tip' => trans('Fiscal Printer'),
				'accesskey' => 'n',
				'prio' => 1,
				'submenu' => [
					[
						'name' => trans('Info'),
						'link' => '?m=novitushd&type=info',
						'tip' => trans('Printer info'),
						'prio' => 10,
					],
					[
						'name' => trans('Print Invoices'),
						'link' => '?m=novitushd&type=invoice',
						'tip' => trans('Print Invoices'),
						'prio' => 20,
					],
					[
						'name' => trans('Printer actions'),
						'link' => '?m=novitushd&type=actions',
						'tip' => trans('Printer actions'),
						'prio' => 30,
					],
					[
						'name' => trans('Printer config'),
						'link' => '?m=novitushd&type=config',
						'tip' => trans('Printer config'),
						'prio' => 40,
					]
				],
			],
		];

		$hook_data = array_merge(array_slice($hook_data, 0, 4), $novitusmenu, array_slice($hook_data, 4));
		return $hook_data;
	}

}