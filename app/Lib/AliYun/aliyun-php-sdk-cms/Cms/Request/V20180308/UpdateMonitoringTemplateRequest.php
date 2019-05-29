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

class UpdateMonitoringTemplateRequest extends \RpcAcsRequest
{
    public function  __construct()
    {
        parent::__construct("Cms", "2018-03-08", "UpdateMonitoringTemplate");
		$this->setMethod("POST");
    }

    protected $eventRuleTemplatesJson;

    protected $name;

    protected $restVersion;

    protected $description;

    protected $id;

    protected $alertTemplatesJson;

    public function getEventRuleTemplatesJson() {
	    return $this->eventRuleTemplatesJson;
    }

    public function setEventRuleTemplatesJson($eventRuleTemplatesJson) {
    	$this->eventRuleTemplatesJson = $eventRuleTemplatesJson;
    	$this->queryParameters['EventRuleTemplatesJson'] = $eventRuleTemplatesJson;
	}

    public function getName() {
	    return $this->name;
    }

    public function setName($name) {
    	$this->name = $name;
    	$this->queryParameters['Name'] = $name;
	}

    public function getRestVersion() {
	    return $this->restVersion;
    }

    public function setRestVersion($restVersion) {
    	$this->restVersion = $restVersion;
    	$this->queryParameters['RestVersion'] = $restVersion;
	}

    public function getDescription() {
	    return $this->description;
    }

    public function setDescription($description) {
    	$this->description = $description;
    	$this->queryParameters['Description'] = $description;
	}

    public function getId() {
	    return $this->id;
    }

    public function setId($id) {
    	$this->id = $id;
    	$this->queryParameters['Id'] = $id;
	}

    public function getAlertTemplatesJson() {
	    return $this->alertTemplatesJson;
    }

    public function setAlertTemplatesJson($alertTemplatesJson) {
    	$this->alertTemplatesJson = $alertTemplatesJson;
    	$this->queryParameters['AlertTemplatesJson'] = $alertTemplatesJson;
	}

}
