<?php

namespace Mlipski\StagePassword\Plugin;

use Mlipski\StagePassword\Model\Session;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\FrontControllerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Backend\Helper\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;


class RedirectionPlugin
{
    protected $responseFactory;
    protected $url;
    protected $session;
    protected $backendHelper;
    protected $scopeConfig;

    public function __construct(
        ResponseFactory $responseFactory,
        UrlInterface $url,
        Data $backendHelper,
        ScopeConfigInterface $scopeConfig,
        Session $session
    ) {
        $this->responseFactory = $responseFactory;
        $this->url = $url;
        $this->backendHelper = $backendHelper;
        $this->scopeConfig = $scopeConfig;
        $this->session = $session;
    }

    public function beforeDispatch(FrontControllerInterface $subject, RequestInterface $request)
    {
        $isActiveStagePassword = $this->scopeConfig->getValue('stage_password/stage_password_credencials/enabled', ScopeInterface::SCOPE_STORE);
        
        if($isActiveStagePassword) {
            $usersUri = $_SERVER['REQUEST_URI'];
            $magentoAdminUriWithSlash = "/".$this->backendHelper->getAreaFrontName();

            $magentoAdminUriWithSlashLength = strlen($magentoAdminUriWithSlash);
            $cutUsersUri = substr($usersUri, 0, $magentoAdminUriWithSlashLength);
            

            if(!($cutUsersUri == $magentoAdminUriWithSlash)) {
                if ($_SERVER['REQUEST_URI'] != '/StagePassword/Index/Index/' && !($this->session->getData('stagepassword') == "true")) {
                    $redirectionUrl = $this->url->getUrl('StagePassword/Index/Index/');
                    $response = $this->responseFactory->create();
                    $response->setRedirect($redirectionUrl)->sendResponse();
                    exit;
                }
            }
        }
    }
}
