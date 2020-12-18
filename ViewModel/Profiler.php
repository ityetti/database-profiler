<?php

declare(strict_types=1);

namespace ITYetti\DatabaseProfiler\ViewModel;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Zend_Db_Profiler;
use Magento\Framework\Serialize\SerializerInterface;

class Profiler implements ArgumentInterface
{
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        ResourceConnection $resource,
        SerializerInterface $serializer
    ) {
        $this->resource = $resource;
        $this->serializer = $serializer;
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
    public function getQueries()
    {
        return $this->getProfiler()->getQueryProfiles();
    }

    /**
     * @param $params
     * @return bool|string
     */
    public function getSerializedParams($params)
    {
        return $this->serializer->serialize($params);
    }
}
