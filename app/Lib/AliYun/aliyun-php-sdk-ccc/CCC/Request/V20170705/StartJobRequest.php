<?php

namespace CCC\Request\V20170705;

/**
 * Request of StartJob
 *
 * @method string getJobJson()
 * @method array getCallingNumbers()
 * @method string getInstanceId()
 * @method string getGroupId()
 * @method string getSelfHostedCallCenter()
 * @method string getScenarioId()
 */
class StartJobRequest extends \RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'StartJob'
        );
    }

    /**
     * @param string $jobJson
     *
     * @return $this
     */
    public function setJobJson($jobJson)
    {
        $this->requestParameters['JobJson'] = $jobJson;
        $this->queryParameters['JobJson'] = $jobJson;

        return $this;
    }

    /**
     * @param array $callingNumbers
     *
     * @return $this
     */
    public function setCallingNumbers(array $callingNumbers)
    {
        $this->requestParameters['CallingNumbers'] = $callingNumbers;
        foreach ($callingNumbers as $i => $iValue) {
            $this->queryParameters['CallingNumber.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $groupId
     *
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

        return $this;
    }

    /**
     * @param string $selfHostedCallCenter
     *
     * @return $this
     */
    public function setSelfHostedCallCenter($selfHostedCallCenter)
    {
        $this->requestParameters['SelfHostedCallCenter'] = $selfHostedCallCenter;
        $this->queryParameters['SelfHostedCallCenter'] = $selfHostedCallCenter;

        return $this;
    }

    /**
     * @param string $scenarioId
     *
     * @return $this
     */
    public function setScenarioId($scenarioId)
    {
        $this->requestParameters['ScenarioId'] = $scenarioId;
        $this->queryParameters['ScenarioId'] = $scenarioId;

        return $this;
    }
}
