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
namespace Airec\Request\V20181012;

class PushDocumentRequest extends \RoaAcsRequest
{
	function  __construct()
	{
		parent::__construct("Airec", "2018-10-12", "PushDocument", "airec", "openAPI");
		$this->setUriPattern("/openapi/instances/[InstanceId]/tables/[TableName]/actions/bulk");
		$this->setMethod("POST");
	}

	private  $instanceId;

	private  $tableName;

	public function getInstanceId() {
		return $this->instanceId;
	}

	public function setInstanceId($instanceId) {
		$this->instanceId = $instanceId;
		$this->pathParameters["InstanceId"]=$instanceId;
	}

	public function getTableName() {
		return $this->tableName;
	}

	public function setTableName($tableName) {
		$this->tableName = $tableName;
		$this->pathParameters["TableName"]=$tableName;
	}
	
}