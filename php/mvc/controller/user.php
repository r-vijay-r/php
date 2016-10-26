<?php 
	include_once('../controller/master.php');
	class User{
		public function setUser($uname,$password){
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
			//foreach ($name as $key => $value) {
			//	echo "<script>alert('user addNewUser : key -> ".$key." value - >".$value."');</script>";
			//}
			if($mas->userNotExist($name['uname'])){
				echo "<script>alert('user addNewUser : no user with username ".$name['uname']."');</script>";
				$userRegLogin = array("uname"=>$name['uname'], "password"=>$name['password']);
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
