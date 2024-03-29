<?php

declare(strict_types=1);

namespace ITYetti\DatabaseProfiler\ViewModel;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Zend_Db_Profiler;
use Magento\Framework\Serialize\SerializerInterface;
use ITYetti\DatabaseProfiler\Service\Config;

class Profiler implements ArgumentInterface
{
    /**
     * @var ResourceConnection
     */
    private ResourceConnection $resource;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * Profiler constructor.
     *
     * @param ResourceConnection $resource
     * @param SerializerInterface $serializer
     * @param Config $config
     */
    public function __construct(
        ResourceConnection $resource,
        SerializerInterface $serializer,
        Config $config
    ) {
        $this->resource = $resource;
        $this->serializer = $serializer;
        $this->config = $config;
    }

    /**
     * @return Zend_Db_Profiler
     */
    private function getProfiler(): Zend_Db_Profiler
    {
        return $this->resource->getConnection('read')->getProfiler();
    }

    /**
     * @return Phrase
     */
    public function getTotalElapsedSecs(): Phrase
    {
        $profiler = $this->getProfiler();
        $totalElapsedSecs = $profiler->getTotalElapsedSecs();
        $fixedFormat = number_format($totalElapsedSecs, 5, '.', '');
        return __("Time [Total: " . $fixedFormat . " secs]");
    }

    /**
     * @return Phrase
     */
    public function getTotalNumQueries(): Phrase
    {
        $profiler = $this->getProfiler();
        $totalNumQueries = $profiler->getTotalNumQueries();
        return __("SQL [Total: " . $totalNumQueries . " queries]");
    }

    /**
     * @return array|false
     */
    public function getQueries(): false|array
    {
        return $this->getProfiler()->getQueryProfiles();
    }

    /**
     * @param $params
     * @return string
     */
    public function getSerializedParams($params): string
    {
        return $this->serializer->serialize($params);
    }

    /**
     * @return string|null
     */
    public function isEnabledOnFrontend(): string|null
    {
        return $this->config->isEnableOnFrontend();
    }

    /**
     * @return string|null
     */
    public function isEnabledOnBackend(): string|null
    {
        return $this->config->isEnableOnBackend();
    }
}
