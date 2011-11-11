<?php

require_once dirname(__FILE__).'/../../../sources/Afup/AFUP_Inscriptions_Forum.php';
require_once dirname(__FILE__).'/../../../sources/Afup/AFUP_Facturation_Forum.php';
require_once dirname(__FILE__).'/../../../sources/Afup/AFUP_Forum.php';

$forum = new AFUP_Forum($bdd);
$forum_inscriptions = new AFUP_Inscriptions_Forum($bdd);

if (!isset($_GET['id_forum']) || intval($_GET['id_forum']) == 0) {
	$_GET['id_forum'] = $forum->obtenirDernier();
}
$smarty->assign('id_forum', $_GET['id_forum']);
$smarty->assign('forums', $forum->obtenirListe());

$suiviBrut = $forum_inscriptions->obtenirSuivi($_GET['id_forum']);
$smarty->assign('suivis', $suiviBrut);

foreach ($suiviBrut as $s) {
    $n[] = $s['n'];
    $n_1[] = $s['n_1'];
}
$smarty->assign('n', implode(', ' , $n));
$smarty->assign('n_1', implode(', ' , $n_1));