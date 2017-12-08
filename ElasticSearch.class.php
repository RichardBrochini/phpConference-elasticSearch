<?php

require 'vendor/autoload.php';
class ElasticSearch
{
	private $index;
	private $method;
	private $type;
	private $id;
	private $data;
	private $client;
	private $size = 10;

	public function ElasticSearch($index){
		$this->index = $index;
		$this->client = new Elasticsearch\Client();
		return $this;
	}	

	 public function __set($prop,$value) {
			 if($prop=='index'){
				 $this->idorigem=$value;
			 }
			 if($prop=='method'){
				 $this->method=$value;
			 }
			 if($prop=='type'){
				 $this->type=$value;
			 }
			 if($prop=='id'){
				 $this->id=$value;
			 }
			 if($prop=='data'){
				 $this->data=$value;
			 }
			 if($prop=='client'){
				 $this->client=$value;
			 }
			 if($prop=='size'){
				 $this->size=$value;
			 }
	}
	 public function __get($prop) {
			 if($prop=='index'){
				return  $this->idorigem;
			 }
			 if($prop=='method'){
				return $this->method;
			 }
			 if($prop=='type'){
				return $this->type;
			 }
			 if($prop=='id'){
				return $this->id;
			 }
			 if($prop=='data'){
				return $this->data;
			 }
			 if($prop=='client'){
				return $this->client;
			 }
			 if($prop=='size'){
				return $this->size;
			 }
	}

	public function create() {
		$params['index'] = $this->index;
		$params['type'] = $this->type;
		$params['body'] = $this->data;
		
		return $this->client->index($params);
	}
	public function update() {
		$params['index'] = $this->index;
		$params['type'] = $this->type;
		$params['body']['doc'] = $this->data;
		$params['id'] = $this->id;
		return $this->client->index($params);
	}	
	public function find($query) {	
		if($this->type){
			$params['type'] = $this->type;
		}
		$params['body']['query'] = $query;
		$params['size'] = $this->size;
		return $this->client->search($params);
	}
		
}

?>
