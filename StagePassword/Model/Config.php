<?php
declare(strict_types=1);

namespace Mlipski\Post\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const XML_PATH_MLIPSKI_STAGEPASSWORD_ENABLED = "stage_password/stage_password_credencials/enabled";
    public const XML_PATH_MLIPSKI_STAGEPASSWORD_LOGIN = "stage_password/stage_password_credencials/login";
    public const XML_PATH_MLIPSKI_STAGEPASSWORD_PASSWORD = "stage_password/stage_password_credencials/password";

    public function __construct(protected ScopeConfigInterface $scopeConfig)
    {}

    /**
     * @param $storeId
     * @return bool
     */
    public function isStagePasswordEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_MLIPSKI_STAGEPASSWORD_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return string
     */
    public function getStagePassworLogin($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MLIPSKI_STAGEPASSWORD_LOGIN,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getStagePassworPassword($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MLIPSKI_STAGEPASSWORD_PASSWORD,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
