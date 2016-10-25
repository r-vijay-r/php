<?php 
	include_once('../controller/master.php');
	class User{
		public function setUser($uname,$password){
			echo "<script>alert('user ".$uname.$password."');</script>";
			$ms=new Master();
			if($ms->login($uname,$password)){
				$values=$ms->getUserId();
				return $values;
			}else{
				return "no userFound";
			}
		}
		public function addNewUser($name){
			$mas=new Master();
			if($mas->userNotExist($name['userName'])){
				$userRegLogin = array("uname"=>$name['userName'], "password"=>$name['passWord']);
				$addedUserId=$mas->addLogin($userRegLogin);
				$status=$mas->addUserDetails($name,$addedUserId);
				return $status;
			}else{
				return false;
			}
		}
		public function getUserDetails($id){
			$mss=new Master();
				$userDetails=$mss->userDetailFetched($id);
				return $userDetails;
		}
	}
?>