<?php
global $configuration;

// Edit the information below to match your database settings
$configuration['db']	= 'crp_srs'; 		//database name
$configuration['host']	= 'localhost';		//database host
$configuration['user']	= 'root';		//database user
$configuration['pass']	= 'caff3in3';		//database password
$configuration['port'] 	= '3306';			//database port

/*
//Live server
$configuration['db']	= 'avwxworkshop'; 		//database name
$configuration['host']	= '76.12.97.29';		//database host
$configuration['user']	= 'avwxworkshop';		//database user
$configuration['pass']	= 'AvWxW0rksh0p';		//database password
$configuration['port'] 	= '3306';			//database port
*/

$configuration['domain'] = 'http://localhost/CRP-SRS/';
$configuration['abspath'] = $_SERVER['DOCUMENT_ROOT'].'/CRP-SRS/';
$configuration['report_folder'] = "C:\\wamp\\www\\CRP-SRS\\Reports\\";

$configuration['recs_per_page'] = '1';


?>
