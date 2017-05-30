<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements

?>


<?
session_start();

function getActionByName($name) {
	$name .= 'Action';
	require("actions/$name.inc.php");
	return new $name();
}

function getViewByName($name) {
	$name .= 'View';
	require("views/$name.inc.php");
	return new $name();
}

function getAction() {
	if (!isset($_REQUEST['action'])) $action = 'Default';
	else $action = $_REQUEST['action'];

	$actions = array('Default',
			'SignUpForm',
			'SignUp',
			'Logout',
			'Login',
			'UpdateUserForm',
			'UpdateUser',
			'AddSurveyForm',
			'AddSurvey',
			'GetMySurveys',
			'Search',
			'Vote',
			'Comment',
			'DeleteSurvey');

	if (!in_array($action, $actions)) $action = 'Default';
	return getActionByName($action);
}

$action = getAction();
$action->run();
$view = $action->getView();
$action->getView()->setLogin($action->getSessionLogin());
$view->run();
?>

