<?php
include_once $link_in.'model/role.php';
if(session_id() ==="")
session_start();
/**
 * 
 */
class role
{
	public $model_role = '';
	function get_role_control($idtaikhoan){
		$model_role = new role_model();
		$role = $model_role->get_role($idtaikhoan);
		$_SESSION['role'] = 0;
			
		return $this->role_control($role->Role);
		
	}
	function role_control($role)
	{
		if(isset($_SESSION['role'])){
// member
			if(!isset($role) || $role == 0){
				$_SESSION['role'] = 0;
				return header('location:index.php');
			}
// viết bài
			if($role == 1){
				$_SESSION['role'] = 1;
				return header('location:admin/index.php');
			} 
// admin
			if($role == 2){
				$_SESSION['role'] = 2;
				return header('location:admin/index.php');
			} 
			return 0;
		}

	}
}
/**
 * 
 */


