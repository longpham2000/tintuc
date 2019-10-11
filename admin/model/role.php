<?php
include_once ($link_out.'model/database.php');



/**
 *
 */
class role_model extends database
{
	
	function get_role($idtaikhoan)
	{
		$sql = "SELECT Role FROM user Where ID = $idtaikhoan";
		$this->setQuery($sql);
		return $this->loadRow();
	}
}


