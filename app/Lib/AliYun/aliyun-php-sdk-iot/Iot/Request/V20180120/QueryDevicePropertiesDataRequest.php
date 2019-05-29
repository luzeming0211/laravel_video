<?php

namespace Iot\Request\V20180120;

/**
 * Request of QueryDevicePropertiesData
 *
 * @method string getAsc()
 * @method array getIdentifiers()
 * @method string getIotId()
 * @method string getPageSize()
 * @method string getEndTime()
 * @method string getDeviceName()
 * @method string getStartTime()
 * @method string getProductKey()
 */
class QueryDevicePropertiesDataRequest extends \RpcAcsRequest
{

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Iot',
            '2018-01-20',
            'QueryDevicePropertiesData'
        );
    }

    /**
     * @param string $asc
     *
     * @return $this
     */
    public function setAsc($asc)
    {
        $this->requestParameters['Asc'] = $asc;
        $this->queryParameters['Asc'] = $asc;

        return $this;
    }

    /**
     * @param array $identifiers
     *
     * @return $this
     */
    public function setIdentifiers(array $identifiers)
    {
        $this->requestParameters['Identifiers'] = $identifiers;
        foreach ($identifiers as $i => $iValue) {
            $this->queryParameters['Identifier.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $iotId
     *
     * @return $this
     */
    public function setIotId($iotId)
    {
        $this->requestParameters['IotId'] = $iotId;
        $this->queryParameters['IotId'] = $iotId;

        return $this;
    }

    /**
     * @param string $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

        return $this;
    }

    /**
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $deviceName
     *
     * @return $this
     */
    public function setDeviceName($deviceName)
    {
        $this->requestParameters['DeviceName'] = $deviceName;
        $this->queryParameters['DeviceName'] = $deviceName;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $productKey
     *
     * @return $this
     */
    public function setProductKey($productKey)
    {
        $this->requestParameters['ProductKey'] = $productKey;
        $this->queryParameters['ProductKey'] = $productKey;

        return $this;
    }
}
