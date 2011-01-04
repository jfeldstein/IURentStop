<?php

class AllComputers
{

	public function new_computer() {
		return $this->find_by_id( md5($_SERVER['REMOTE_ADDR'].time()) );
	}
	
	public function find_by_id( $cid )
	{
		return new Computer($cid);
	}

}
?>