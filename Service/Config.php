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
    private $config;

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
     * @return mixed
     */
    private function getConfigValue($field, $storeId = null)
    {
        return $this->config->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function isEnableOnFrontend($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_FRONT, $storeId);
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function isEnableOnBackend($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_ITYETTI_DATABASE_PROFILER_ENABLE_ON_BACK, $storeId);
    }
}
