<?php

declare(strict_types=1);

namespace ITYetti\DatabaseProfiler\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    const XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_BACK = 'ityetti_database_profiler/general/enable_on_back';
    const XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_FRONT = 'ityetti_database_profiler/general/enable_on_front';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $config;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $config
     */
    public function __construct(
        ScopeConfigInterface $config
    ) {
        $this->config = $config;
    }

    /**
     * @param $field
     * @param null $storeId
     * @return string|null
     */
    private function getConfigValue($field, $storeId = null): string|null
    {
        return $this->config->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param null $storeId
     * @return string|null
     */
    public function isEnableOnFrontend($storeId = null): string|null
    {
        return $this->getConfigValue(self::XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_FRONT, $storeId);
    }

    /**
     * @param null $storeId
     * @return string|null
     */
    public function isEnableOnBackend($storeId = null): string|null
    {
        return $this->getConfigValue(self::XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_BACK, $storeId);
    }
}
