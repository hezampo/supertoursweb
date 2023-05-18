<?php
$dbmap['Roles']['has_many']['RolesOpciones'] = array("foreign_key"=>"role_id");
$dbmap['RolesOpciones']['belongs_to']['Roles'] = array("foreign_key"=>"id");
/*
 * la base de datos a la
 * cual se le asigno
 * al proyecto es
 * carlos_supertours16.
 */

$dbconfig['prod'] = array('localhost', 'arturo_supertours21', 'root', '', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'arbusmad_supertours_full', 'arbusmad_full', 'elite2020', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');

//$dbconfig['prod'] = array('supertours.com', 'arbusmad_supertours_full', 'arbusmad_full', 'elite2020', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'arbusmad_supertours16', 'arbusmad_super', 'elite2019', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'arbusmad_supertours_full', 'arbusmad_full', 'elite2020', 'mysql', true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('supertours.com', 'carlos_supertours16', 'carlos_arturo', 'elite2016', 'mysql', true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('supertours.com', 'carlos_supertours_full', 'carlos_super', '@123456', 'mysql', true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'carlos_supertours_20181217', 'root', '', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'carlos_supertours16', 'root', '', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
//$dbconfig['prod'] = array('localhost', 'carlos_supertours16', 'root', '', 'mysql',true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
/*Conexión a la bd de prubeas*///$dbconfig['prod'] = array('supertours.com', 'carlos_supertours_full', 'carlos_arturo', 'elite2016', 'mysql', true,'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
