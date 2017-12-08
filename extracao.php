<?php
// dados
//lat,long,nu_ddd_farmacia,nu_telefone_farmacia,nu_cep_farmacia,no_bairro_farmacia,ds_endereco_farmacia,no_farmacia,no_cidade,uf
include 'ElasticSearch.class.php';
$es = new ElasticSearch('farmacia');
$es->size = 100;
$es->type = 'locais';

$dados = file("http://i3geo.saude.gov.br/i3geo/ogc.php?service=WFS&version=1.0.0&request=GetFeature&typeName=farmacia_popular_estabelecimento&outputFormat=CSV");
$x=0;
while($dados[$x]){
	$temp = explode(",",$dados[$x]); 
	echo $dados[$x]."\n";
	$data = [
	'lat'=>trim($temp[0]),
	'long'=>trim($temp[1]),
	'nu_ddd_farmacia'=>trim($temp[2]),
        'nu_telefone_farmacia'=>trim($temp[3]),
        'nu_cep_farmacia'=>trim($temp[4]),
        'no_bairro_farmacia'=>trim($temp[5]),
        'ds_endereco_farmacia'=>trim($temp[6]),
        'no_farmacia'=>trim($temp[7]),
        'no_cidade'=>trim($temp[8]),
        'uf'=>trim($temp[9]),
	];
	$es->data = $data;
	var_dump($es->data);
	$return = $es->create();
	echo $return['_id'].' --salvo '."\n";

	$x++;
}
?>
