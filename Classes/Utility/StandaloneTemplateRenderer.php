<?php
namespace Qbus\Qbtools\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Axel Wüstemann <awu@qbus.de>, Qbus Werbeagentur GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 * @package QbTools
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class StandaloneTemplateRenderer {
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;
	
	
	/**
	 * returns a rendered standalone template
	 *
	 * @param \string $templatePath		the template path relative to templateRootPath (UpperCamelCase)
	 * @param \array $variables			variables to be passed to the Fluid view
     * @param \string $rootPath		the template path relative to templateRootPath (UpperCamelCase)
	 * @return \string
	 */
	public function renderTemplate($template, $variables, $rootPath) 
	{
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $view->setLayoutRootPath($rootPath  . '/Layouts');
        $view->setPartialRootPath($rootPath . '/Partials');
		$view->setTemplatePathAndFilename($rootPath . '/Templates/' . $template);
		$view->assignMultiple($variables);
		return $view->render();
	}
	
	/**
	 * returns a standalone template
	 *
	 * @param \string $templatePath		the template path relative to templateRootPath (UpperCamelCase)
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView
	 */
	public function buildTemplate($templatePath) 
	{
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $templatePath;
		$view->setTemplatePathAndFilename($templatePathAndFilename);
		
		return $view;
	}
}