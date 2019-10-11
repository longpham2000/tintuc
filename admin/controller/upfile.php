<?php

/**
 * 
 */
class upfile
{
	public $name = '';
	public $type = "";
	public $tmp_name = "";
	public $error = "";
	public $size = "";

	function tach($input){
		$this->name = $_FILES[$input]['name'];
		$this->type = $_FILES[$input]['type'];
		$this->tmp_name = $_FILES[$input]['tmp_name'];
		$this->error = $_FILES[$input]['error'];
		$this->size = $_FILES[$input]['size'];
	}
	function duoi(){
		$duoi = strstr($this->type , "/");
		$duoi = substr($duoi, 1);
		return $duoi;
	}
	function move()
	{
		move_uploaded_file($this->tmp_name , "../../public/upfile/$this->name");
		return $this->name;

	}
	function ktduoi($namefile = ""){
		if($this->duoi() == "png" || $this->duoi() == "jpeg"){
			if(!$namefile == "")
			$this->name = $namefile;
			return $this->move();
		}else return false;
		
	}
}


?>