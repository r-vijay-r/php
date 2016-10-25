<?php
	include_once('../module/mysql_crud.php');
	class Master{
		private $loginTable="login";
		private $regTable="details";
		private $val;
		public function login($userName , $passWord){
			$db=new Database();
			$err=$db->connect();
			///$where = "uname='".$userName."' and password='".$passWord."'";
			if($db->select($this->loginTable,"*",' uname = "'.$userName.'" and password = "'.$passWord.'"')){
				$arr=$db->getResult();
				foreach ($arr as $key => $value) {
					foreach ($value as $k => $v) {
						if ($k == 'id') {
							$this->val=array($k=>$v);
						}
					}
				}
				return true;
			}else{
				return false;
				echo "<script>alert('master: ".$this->loginTable." "."uname=".$userName." and password=".$passWord.""." res :".$this->val."');</script>";
			}
		}
		public function getUserId(){
			$userId=$this->val['id'];
			return $userId;
		}
		public function userNotExist($uname){
			$db1=new Database();
			$db1->connect();
			$where="uname='".$uname."'";
			if($db1->select($this->loginTable,'id',null,$where)){
				return true;
			}else{
				return false;
			}
		}
		public function addLogin($detail){
			$db2=new Database();
			$db2->connect();
			$where="uname='".$detail['']."'";
			$db2->insert($this->loginTable,$detail);
			if($db2->select($this->loginTable,'id',null,$where)){
				$this->val = $db2->getResult();//ssssssssssssssssssssssssssssssssssssssssssssss
				return $this->val['id'];
			}

		}
		public function addUserDetails($name, $addedUserId){
			$db3=new Database();
			$db3->connect();
			$insertArray=array("id"=>$addedUserId, "fname"=>$name['fName'], "lname"=>$name['lName'], "gender"=>$name['gender'], "city"=>$name['city'], "state"=>$name['state'], "country"=>$name['country'], "mob"=>$name['mob'], "email"=>$name['email'], "uname"=>$name['userName']);
			if($db3->insert($this->regTable,$insertArray)){
				return true;
			}else{
				return false;
			}

		}
		public function userDetailFetched($id){
			$db4=new Database();
			$db4->connect();
			$rows="uname, password";
			$where="id=".$id;
			$db4->select($this->loginTable,$rows,$where);
			$loginTabDet=array();
			$p=$db4->getResult();
			foreach ($loginTabDet as $key => $value) {
				foreach ($value as $k => $v) {
					$loginTabDet[$k]=$v;
				}
			}
			$where="id=".$id;
			$db4->select($this->regTable,'*',null,$where);
			$regTabDet=array();
			$p=$db4->getResult();
			foreach ($loginTabDet as $key => $value) {
				foreach ($value as $k => $v) {
					$regTabDet[$k]=$v;
				}
			}
			$fullDetails= array("fname"=>$regTabDet['fname'], "lname"=>$regTabDet['lname'], "gender"=>$regTabDet['gender'], "city"=>$regTabDet['city'], "state"=>$regTabDet['state'], "country"=>$regTabDet['country'], "mob"=>$regTabDet['mob'], "email"=>$regTabDet['email'], "uname"=>$regTabDet['uname'], "password"=>$regTabDet['password']);
			return $fullDetails;
		}
	}
?>