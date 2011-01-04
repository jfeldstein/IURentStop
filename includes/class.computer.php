<?php

class Computer
{
	var $idb;
	var $id;
	var $user;
	
	function Computer( $cid )
	{
		global $db, $User;	
		$this->idb = $db;
		$this->user = $User;
		
		
		$sql = "SELECT * FROM `computers` WHERE `cid`='". $cid ."' AND `user_id`='".$this->user->id."'";
		$result = $this->idb->Run($sql);
		
		if($this->idb->NumRows( $result ) == 0)
		{
			$sql = "INSERT INTO `computers` (`cid`, `user_id`) VALUES ('$cid', '". $this->user->id ."')";
			$this->idb->Run($sql);
			$row = array('user_id' => $this->user->id, 'cid'=>$cid);
		}
		 else
			$row = $this->idb->FetchRow(); 
		
		$this->id 	= $cid;
		$this->user = $row['user_id'];
		
		setcookie('cid', $this->id, time()+60*60*24*265);
	}
	
	function log( $action, $subject )
	{
		if(isset($_SESSION['log'][$action][$subject]))
			return false;
			
		$sql = "INSERT INTO `logs` "
			." (`date`, `action`, `subject`, `cid`, `user_id`) "
			." VALUES "
			." ('".time()."', '$action', '$subject', '".$this->id."', '".$this->user."') ";
		$this->idb->Run($sql);
		$_SESSION['log'][$action][$subject] = 1;
	}

	
}
?>