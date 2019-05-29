<?php

namespace Iot\Request\V20180120;

/**
 * Request of NotifyAddThingTopo
 *
 * @method string getGwProductKey()
 * @method string getGwDeviceName()
 * @method string getGwIotId()
 * @method string getDeviceListStr()
 */
class NotifyAddThingTopoRequest extends \RpcAcsRequest
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
            'NotifyAddThingTopo'
        );
    }

    /**
     * @param string $gwProductKey
     *
     * @return $this
     */
    public function setGwProductKey($gwProductKey)
    {
        $this->requestParameters['GwProductKey'] = $gwProductKey;
        $this->queryParameters['GwProductKey'] = $gwProductKey;

        return $this;
    }

    /**
     * @param string $gwDeviceName
     *
     * @return $this
     */
    public function setGwDeviceName($gwDeviceName)
    {
        $this->requestParameters['GwDeviceName'] = $gwDeviceName;
        $this->queryParameters['GwDeviceName'] = $gwDeviceName;

        return $this;
    }

    /**
     * @param string $gwIotId
     *
     * @return $this
     */
    public function setGwIotId($gwIotId)
    {
        $this->requestParameters['GwIotId'] = $gwIotId;
        $this->queryParameters['GwIotId'] = $gwIotId;

        return $this;
    }

    /**
     * @param string $deviceListStr
     *
     * @return $this
     */
    public function setDeviceListStr($deviceListStr)
    {
        $this->requestParameters['DeviceListStr'] = $deviceListStr;
        $this->queryParameters['DeviceListStr'] = $deviceListStr;

        return $this;
    }
}
