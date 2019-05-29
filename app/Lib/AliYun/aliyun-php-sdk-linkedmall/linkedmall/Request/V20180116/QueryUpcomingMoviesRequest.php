<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace linkedmall\Request\V20180116;

class QueryUpcomingMoviesRequest extends \RpcAcsRequest
{
    public function  __construct()
    {
        parent::__construct("linkedmall", "2018-01-16", "QueryUpcomingMovies", "linkedmall", "openAPI");
		$this->setMethod("POST");
    }

    protected $bizId;

    protected $cityCode;

    protected $extJson;

    public function getBizId() {
	    return $this->bizId;
    }

    public function setBizId($bizId) {
    	$this->bizId = $bizId;
    	$this->queryParameters['BizId'] = $bizId;
	}

    public function getCityCode() {
	    return $this->cityCode;
    }

    public function setCityCode($cityCode) {
    	$this->cityCode = $cityCode;
    	$this->queryParameters['CityCode'] = $cityCode;
	}

    public function getExtJson() {
	    return $this->extJson;
    }

    public function setExtJson($extJson) {
    	$this->extJson = $extJson;
    	$this->queryParameters['ExtJson'] = $extJson;
	}

}
