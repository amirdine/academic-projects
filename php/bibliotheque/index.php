<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);


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
			'LoginForm',
			'Admin',
			'ManageMember',
			'ManageBook',
			'ManageSelectMember',
			'AddMember',
			'SelectBook',
			'RegisterBook',
			'SearchBook',
			'AddBook',
			'BorrowBook',
			'SaveBorrowingBook',
			'GiveBackBook',
			'SaveGivingBackBook',
			'SearchMember',
			'SearchBookOption',
			'LookBooks',
			'MySelectBook',
			'Print',
			'UpdateMember',
			'JsonSearchMember',
			'SaveUpdateMember',
			'ReserveThisBook',
			'SaveReservationBook',
			'RegisterMember',
			'MySearchBookOption',

		);

	if (!in_array($action, $actions)) $action = 'Default';
	return getActionByName($action);
}

$action = getAction();
$action->run();
$view = $action->getView();
if($view != NULL){
$action->getView()->setLogin($action->getSessionLogin());
$view->run();
}
?>

