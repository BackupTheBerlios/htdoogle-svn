<?php

$_NOT_ 	= "NOT";
$_AND_ 	= "AND";
$_OR_ 	= "OR";
# relative path to htsearch
$_SEARCH = "/search";

#print "<pre>";
#print_r($_GET);
#print "</pre>";
#exit;

# page=x aussortieren
preg_match("/\;page\=\d+/",$_GET["words"],$current_page);
#print $current_page[0]."<br>";
$_query = preg_replace("/\;page=\d+/","",$_GET["words"]);
if ( strlen($_query) > 0 ){
	#print "<pre>";
	#print $_query."\n";

	# Anfang
	$_query = preg_replace("/^($_AND_\ |\+|$_OR_\ |\ +)*/i","",$_query);
	# Ende
	$_query = preg_replace("/(\ ($_NOT_|\-|$_AND_|\+|$_OR_)*)+$/i","",$_query);
	# Zeichenoperatoren -> Wortoperatoren
	# ' - ' -> ' not '
	$_query = preg_replace("/(^-)|(\ +\+*\-+)+/"," $_NOT_ ",$_query);

	#print $_query."<hr/>";
	# ' + ' -> ' and '
	$_query = preg_replace("/(((\ +$_OR_){0}\ +\++)|(!(\ +$_OR_){0}\ +))+/i"," $_AND_ ",$_query);
	$_query = preg_replace("/\ +/"," $_AND_ ",$_query);
	#print $_query."<hr/>";

	# wort+zeichenkette ==> wort AND zeichenkette
	$_query = preg_replace("/(\w)\+(\w)/","\$1 $_AND_ \$2",$_query);


	# NOT (reduzieren, entfernen)
	$_query	= preg_replace("/($_AND_\ +)*(\ *$_NOT_\ +)+(($_AND_|$_OR_)\ +)*/i"," $_NOT_ ",$_query);
	# AND (reduzieren, entfernen)
	$_query	= preg_replace("/($_OR_\ +)*(\ *$_AND_\ +)+($_OR_\ +)*/i"," $_AND_ ",$_query);

	# 2 und mehr Leerzeichen werden auf eins reduziert
	#$_query 	= preg_replace("/\ {2,}/"," ",$_query);
	#$_query 	= preg_replace("/^(\ +)|(\ +)$/","",$_query);

	#print "|_".$_query."_|\n";

	$_GET["words"] = $_query;
	while( list($key,$val) = each($_GET)){
		#print $key."=".urlencode($val)."\n";
		if 	($key == "words"){$_full_query_string .= $key."=".urlencode($val).$current_page[0];}
		else			 {$_full_query_string .= $key."=".urlencode($val).";";}
	}

	header("Location: $_SEARCH?".$_full_query_string);
}
else{
	header("Location: $_SEARCH");
}
?>
