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
namespace Cms\Request\V20180308;

class QueryTaskMonitorDataRequest extends \RpcAcsRequest
{
    public function  __construct()
    {
        parent::__construct("Cms", "2018-03-08", "QueryTaskMonitorData");
		$this->setMethod("POST");
    }

    protected $cursor;

    protected $period;

    protected $length;

    protected $endTime;

    protected $startTime;

    protected $type;

    protected $metricName;

    protected $taskId;

    public function getCursor() {
	    return $this->cursor;
    }

    public function setCursor($cursor) {
    	$this->cursor = $cursor;
    	$this->queryParameters['Cursor'] = $cursor;
	}

    public function getPeriod() {
	    return $this->period;
    }

    public function setPeriod($period) {
    	$this->period = $period;
    	$this->queryParameters['Period'] = $period;
	}

    public function getLength() {
	    return $this->length;
    }

    public function setLength($length) {
    	$this->length = $length;
    	$this->queryParameters['Length'] = $length;
	}

    public function getEndTime() {
	    return $this->endTime;
    }

    public function setEndTime($endTime) {
    	$this->endTime = $endTime;
    	$this->queryParameters['EndTime'] = $endTime;
	}

    public function getStartTime() {
	    return $this->startTime;
    }

    public function setStartTime($startTime) {
    	$this->startTime = $startTime;
    	$this->queryParameters['StartTime'] = $startTime;
	}

    public function getType() {
	    return $this->type;
    }

    public function setType($type) {
    	$this->type = $type;
    	$this->queryParameters['Type'] = $type;
	}

    public function getmetricName() {
	    return $this->metricName;
    }

    public function setmetricName($metricName) {
    	$this->metricName = $metricName;
    	$this->queryParameters['metricName'] = $metricName;
	}

    public function getTaskId() {
	    return $this->taskId;
    }

    public function setTaskId($taskId) {
    	$this->taskId = $taskId;
    	$this->queryParameters['TaskId'] = $taskId;
	}

}
