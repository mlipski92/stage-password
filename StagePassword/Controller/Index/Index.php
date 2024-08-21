<?php
namespace Mlipski\StagePassword\Controller\Index;

use Mlipski\StagePassword\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $session;
    protected $responseFactory;
    protected $url;
    protected $scopeConfig;

    public function __construct(
        ResponseFactory $responseFactory,
        PageFactory $pageFactory,
        UrlInterface $url,
        Session $session,
        ScopeConfigInterface $scopeConfig,
        Context $context
    ) {
        $this->responseFactory = $responseFactory;
        $this->_pageFactory = $pageFactory;
        $this->url = $url;
        $this->session = $session;
        $this->scopeConfig = $scopeConfig;
        return parent::__construct($context);
    }

    public function execute()
    {


        $correctStagePasswordLogin = $this->scopeConfig->getValue('stage_password/stage_password_credencials/login', ScopeInterface::SCOPE_STORE); 
        $correctStagePasswordPassword = $this->scopeConfig->getValue('stage_password/stage_password_credencials/password', ScopeInterface::SCOPE_STORE); 

        $stagePasswordLogin = $this->getRequest()->getParam('login', false);
        $stagePasswordPassword = $this->getRequest()->getParam('password', false);
        if ($stagePasswordLogin != null && $stagePasswordPassword != null) {
            if ($correctStagePasswordLogin == $stagePasswordLogin && $correctStagePasswordPassword == $stagePasswordPassword) {
                $this->session->setData('stagepassword', 'true');

                $redirectionUrl = $this->url->getBaseUrl();
                $response = $this->responseFactory->create();
                $response->setRedirect($redirectionUrl)->sendResponse();
                exit;

            } else {
                echo "<div class='stagepassword-error'>Wrong credencials, try again!</div>";
            }
        }

        return $this->_pageFactory->create();
    }
}
