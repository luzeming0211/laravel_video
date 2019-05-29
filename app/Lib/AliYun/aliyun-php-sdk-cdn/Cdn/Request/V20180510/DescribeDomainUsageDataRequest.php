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
namespace Cdn\Request\V20180510;

class DescribeDomainUsageDataRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Cdn", "2018-05-10", "DescribeDomainUsageData");
		$this->setMethod("POST");
	}

	private  $startTime;

	private  $type;

	private  $dataProtocol;

	private  $area;

	private  $domainName;

	private  $endTime;

	private  $ownerId;

	private  $field;

	public function getStartTime() {
		return $this->startTime;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->queryParameters["StartTime"]=$startTime;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
		$this->queryParameters["Type"]=$type;
	}

	public function getDataProtocol() {
		return $this->dataProtocol;
	}

	public function setDataProtocol($dataProtocol) {
		$this->dataProtocol = $dataProtocol;
		$this->queryParameters["DataProtocol"]=$dataProtocol;
	}

	public function getArea() {
		return $this->area;
	}

	public function setArea($area) {
		$this->area = $area;
		$this->queryParameters["Area"]=$area;
	}

	public function getDomainName() {
		return $this->domainName;
	}

	public function setDomainName($domainName) {
		$this->domainName = $domainName;
		$this->queryParameters["DomainName"]=$domainName;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->queryParameters["EndTime"]=$endTime;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
		$this->queryParameters["OwnerId"]=$ownerId;
	}

	public function getField() {
		return $this->field;
	}

	public function setField($field) {
		$this->field = $field;
		$this->queryParameters["Field"]=$field;
	}
	
}