<?php

namespace Iot\Request\V20180120;

/**
 * Request of DisableThing
 *
 * @method string getIotId()
 * @method string getDeviceName()
 * @method string getProductKey()
 */
class DisableThingRequest extends \RpcAcsRequest
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
            'DisableThing'
        );
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
