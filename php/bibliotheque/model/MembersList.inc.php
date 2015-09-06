<?
class MembersList {
	
	private $memberList;
	private $delay;
	private $member = array();
	


  public function addMember($member) {
		$this->member[] = $member;
	}
	
	public function getMembers() {
		return $this->member ;
	}



	public function getMember($id){
		for($i = 0; $i < count($this->member); $i++){
			if( $this->member[$i]->getId() == $id){
				return $this->member[$i];
			}
		}
		return false;
	}
	


	

}

?>
