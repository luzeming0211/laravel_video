<?php

namespace Ecs\Request\V20140526;

/**
 * Request of CreateNetworkInterface
 *
 * @method string getResourceOwnerId()
 * @method string getClientToken()
 * @method string getSecurityGroupId()
 * @method string getDescription()
 * @method string getResourceGroupId()
 * @method array getTags()
 * @method string getNetworkInterfaceName()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getVSwitchId()
 * @method string getPrimaryIpAddress()
 */
class CreateNetworkInterfaceRequest extends \RpcAcsRequest
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
            'Ecs',
            '2014-05-26',
            'CreateNetworkInterface',
            'ecs'
        );
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $clientToken
     *
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $securityGroupId
     *
     * @return $this
     */
    public function setSecurityGroupId($securityGroupId)
    {
        $this->requestParameters['SecurityGroupId'] = $securityGroupId;
        $this->queryParameters['SecurityGroupId'] = $securityGroupId;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $resourceGroupId
     *
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;

        return $this;
    }

    /**
     * @param array $tags
     *
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->requestParameters['Tags'] = $tags;
        foreach ($tags as $i => $iValue) {
            $this->queryParameters['Tag.' . ($i + 1) . '.Key'] = $tags[$i]['Key'];
            $this->queryParameters['Tag.' . ($i + 1) . '.Value'] = $tags[$i]['Value'];
        }

        return $this;
    }

    /**
     * @param string $networkInterfaceName
     *
     * @return $this
     */
    public function setNetworkInterfaceName($networkInterfaceName)
    {
        $this->requestParameters['NetworkInterfaceName'] = $networkInterfaceName;
        $this->queryParameters['NetworkInterfaceName'] = $networkInterfaceName;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     *
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $vSwitchId
     *
     * @return $this
     */
    public function setVSwitchId($vSwitchId)
    {
        $this->requestParameters['VSwitchId'] = $vSwitchId;
        $this->queryParameters['VSwitchId'] = $vSwitchId;

        return $this;
    }

    /**
     * @param string $primaryIpAddress
     *
     * @return $this
     */
    public function setPrimaryIpAddress($primaryIpAddress)
    {
        $this->requestParameters['PrimaryIpAddress'] = $primaryIpAddress;
        $this->queryParameters['PrimaryIpAddress'] = $primaryIpAddress;

        return $this;
    }
}
