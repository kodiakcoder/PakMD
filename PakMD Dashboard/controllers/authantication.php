<?php 
	include "application/db_config.php";
	class Admin
	{

		public function check_login($username, $password)
		{
			$db = getDB();
			
			$stmt = $db->prepare("SELECT id FROM clinic_adminlogin WHERE  (username=:username or email=:username) AND  password=:password");
			$stmt->bindParam("username", $username,PDO::PARAM_STR);
			$stmt->bindParam("password", $password,PDO::PARAM_STR);
			$stmt->execute();
			$count=$stmt->rowCount();
			$data=$stmt->fetch(PDO::FETCH_OBJ);
			$db = null;
			if($count)
			{
				$_SESSION['login'] = true;
				$_SESSION['uid']=$data->id;
				return true;
			}
			else
			{
				return false;
			}
		}


	
    	public function get_fullname()
		{
    		$sql3="SELECT * FROM tbl_stores_deliverysystem ";
	        $result = mysqli_query($this->db,$sql3);
			while($user_data = mysqli_fetch_array($result))
			{
				$row[]=$user_data;
			}
			return $row;
    	}


	    public function get_session()
		{
	        return $_SESSION['login'];
	    }

	    public function user_logout()
		{
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }

	}
?>