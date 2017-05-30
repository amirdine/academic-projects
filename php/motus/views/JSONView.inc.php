<?
require_once("actions/Action.inc.php");
require_once("views/View.inc.php");

class JSONView implements View {

	private $object = null;

	public function run() {
		echo json_encode($this->object);
	}

	public function setLogin($var) {
		
	}

	public function setObject($object) {
		$this->object = $object;
	}

}
