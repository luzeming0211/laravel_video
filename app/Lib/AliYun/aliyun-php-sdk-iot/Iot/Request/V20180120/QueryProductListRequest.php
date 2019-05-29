<?php

namespace Iot\Request\V20180120;

/**
 * Request of QueryProductList
 *
 * @method string getPageSize()
 * @method string getCurrentPage()
 * @method string getAliyunCommodityCode()
 */
class QueryProductListRequest extends \RpcAcsRequest
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
            'QueryProductList'
        );
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
     * @param string $currentPage
     *
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->requestParameters['CurrentPage'] = $currentPage;
        $this->queryParameters['CurrentPage'] = $currentPage;

        return $this;
    }

    /**
     * @param string $aliyunCommodityCode
     *
     * @return $this
     */
    public function setAliyunCommodityCode($aliyunCommodityCode)
    {
        $this->requestParameters['AliyunCommodityCode'] = $aliyunCommodityCode;
        $this->queryParameters['AliyunCommodityCode'] = $aliyunCommodityCode;

        return $this;
    }
}
