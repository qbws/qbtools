<?php
namespace Qbus\Qbtools\ViewHelpers\Widget;

/**
 * TODO: accept required as string-list
 * TODO: accept required list with conditions?
 * TODO: accept recipient as simple string containing only the mail address
 */
class MailformViewHelper extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper
{
    /**
     * @var bool
     */
    protected $ajaxWidget = true;

    /**
     * @bar bool
     */
    protected $storeConfigurationInSession = false;

    /**
     * @var \Qbus\Qbtools\ViewHelpers\Widget\Controller\MailformController
     */
    protected $controller;

    /**
     * @param  \Qbus\Qbtools\ViewHelpers\Widget\Controller\MailformController $controller
     * @return void
     */
    public function injectController(\Qbus\Qbtools\ViewHelpers\Widget\Controller\MailformController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param  array  $recipient    = array('email': "mail@address", 'name' => "Full Name");
     * @param  array  $sender       = array('email': "mail@address", 'name' => "Full Name");
     * @param  array  $required     = array("firstname", "lastname", "email");
     * @param  string $mailTemplate
     * @return string
     */
    public function render($recipient, $sender = null, $required = array('firstname', 'lastname', 'email', 'message'),
            $mailTemplate = 'EXT:qbtools/Resources/Private/Templates/Mailform/Mail.txt')
    {

        /* <f:renderChildren> does not include the variable context from the  subrequest-controller,
         * therefore we set the desired variables here. */
        $this->viewHelperVariableContainer->add('TYPO3\\CMS\\Fluid\\ViewHelpers\\FormViewHelper', 'fieldNamePrefix', 'msg');
        $result = $this->initiateSubRequest();
        $this->viewHelperVariableContainer->remove('TYPO3\\CMS\\Fluid\\ViewHelpers\\FormViewHelper', 'fieldNamePrefix');

        return $result;
    }
}
