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
namespace Chatbot\Request\V20171011;

class QueryKnowledgesRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Chatbot", "2017-10-11", "QueryKnowledges", "beebot", "openAPI");
		$this->setMethod("POST");
	}

	private  $pageSize;

	private  $coreWordName;

	private  $knowledgeTitle;

	private  $pageNumber;

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->queryParameters["PageSize"]=$pageSize;
	}

	public function getCoreWordName() {
		return $this->coreWordName;
	}

	public function setCoreWordName($coreWordName) {
		$this->coreWordName = $coreWordName;
		$this->queryParameters["CoreWordName"]=$coreWordName;
	}

	public function getKnowledgeTitle() {
		return $this->knowledgeTitle;
	}

	public function setKnowledgeTitle($knowledgeTitle) {
		$this->knowledgeTitle = $knowledgeTitle;
		$this->queryParameters["KnowledgeTitle"]=$knowledgeTitle;
	}

	public function getPageNumber() {
		return $this->pageNumber;
	}

	public function setPageNumber($pageNumber) {
		$this->pageNumber = $pageNumber;
		$this->queryParameters["PageNumber"]=$pageNumber;
	}
	
}