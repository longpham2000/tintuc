<?php
include_once ($link_out.'model/m_users.php');
include_once ($link_in.'controller/role.php');
if(session_id() ==="")
session_start();
class c_users
{
	
	function dangkytk($name, $email, $password)
	{
		$m_users = new M_users();
		$id_user = $m_users->dangky($name, $email, $password);
		if($id_user>0){
			$_SESSION['SUCCESS'] = "đang ký thành công";
			header('location: index.php');
			if(isset($_SESSION['error'])){
				unset($_SESSION['error']);
			}
		}else{
			$_SESSION['error'] = "dang ký không thành công";
			header('location: dangky.php');
		}
	}
	function dangnhap($email, $password){
		$m_user = new M_users();
		$c_role = new role;

		$user = $m_user->dangnhap($email, $password);
		if($user == true){
			$_SESSION['user_name'] = $user->Ten;
			$_SESSION['id_user'] = $user->ID;
			
			if(isset($_SESSION['user_name'])){
				unset($_SESSION['user_error']);
			}

			if(isset($_SESSION['chua_dang_nhap'])){
				unset($_SESSION['chua_dang_nhap']);
			}


			$c_role->get_role_control($user->ID);
				

		}else{
			$_SESSION['user_error']="sai thông tin đăng nhập";
			header('location:dangnhap.php');
		}
	}
	function dangxuat($link_out=""){
		session_destroy();
		header("location:".$link_out."index.php");

	}

}
?>