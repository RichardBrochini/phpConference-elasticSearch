<?php
include 'ElasticSearch.class.php';
$es = new ElasticSearch('farmacia');
$es->size = 100;
$es->type = 'locais';

$matchQuery=[
	'match'=> [
		'uf'=>"sp"
	]
];
$matchData = $es->find($matchQuery);

if(isset($matchData['hits']['hits'])){
	foreach ($matchData['hits']['hits'] as $key => $hit) {
		echo trim($hit['_source']['no_farmacia']).";";
	}
}
?>
