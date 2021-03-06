<?php
require_once '../../include/prepend.inc.php';
require_once dirname(__FILE__) . '/_config.inc.php';

setlocale(LC_TIME, 'fr_FR');

require_once dirname(__FILE__).'/../../../sources/Afup/AFUP_AppelConferencier.php';

$forum_appel = new AFUP_AppelConferencier($bdd);
$sessions = $forum_appel->obtenirListeSessionsPlannifies($config_forum['id']);
$journees = array(
  'Lundi 23 novembre 2014' => array(),
  'Mardi 24 novembre 2014' => array()
);
foreach ($sessions as $index => $session) {
	$session['conferenciers'] = $forum_appel->obtenirConferenciersPourSession($session['session_id']);
  $session['journees'] = explode(" ", $session['journee']);

  if ('23' == date('d', $session['debut'])) {
    $journees['Lundi 23 novembre 2014'][] = $session;
  } else {
    $journees['Mardi 24 novembre 2014'][] = $session;
  }
}

$smarty->assign('journees', $journees);
$smarty->display('sessions.html');
