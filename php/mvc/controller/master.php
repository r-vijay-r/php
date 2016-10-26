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
			}
		}
		public function getUserId(){
			$userId=$this->val['id'];
			return $userId;
		}
		public function userNotExist($uname){
			$db1=new Database();
			$db1->connect();
			$sel="SELECT * from ".$this->loginTable." uname = '".$uname."'";
			$db1->sql($sel);
			if($db1->numRows() == 0){
				return true;
				echo "<script>alert('master userNotExist :  ".$db1->numRows()." ');</script>";
			}else{
				return false;
			}
		}
		public function addLogin($detail){
			$db2=new Database();
			$db2->connect();
			$db2->insert($this->loginTable,$detail);
			$sel="SELECT id FROM ".$this->loginTable." WHERE uname='".$detail['uname']."';";
			if($db2->sql($sel)){
				$res = $db2->getResult();
				foreach ($res as $key => $value) {
					foreach ($value as $k => $v) {
						$this->val[$k] =$v;
					}
				}
				return $this->val['id'];
			}

		}
		public function addUserDetails($name, $addedUserId){
			$db3=new Database();
			$db3->connect();
			$insertArray=array("id"=>$addedUserId, "fname"=>$name['fName'], "lname"=>$name['lName'], "gender"=>$name['gender'], "city"=>$name['city'], "state"=>$name['state'], "country"=>$name['country'], "mob"=>$name['mob'], "email"=>$name['email'], "uname"=>$name['userName']);
			$db3->insert($this->regTable,$insertArray)
			if(){
				return true;
			}else{
				return false;
			}

		}
		public function userDetailFetched($id){
			$db4=new Database();
			$db4->connect();
			$rows="uname, password";
			$where=" id=".$id;
			$db4->select($this->loginTable,$rows,$where);
			$loginTabDet=array();
			$p=$db4->getResult();
			foreach ($p as $key => $value) {
				foreach ($value as $k => $v) {
					$loginTabDet[$k]=$v;
				}
			}
			$db4->select($this->regTable,'*',$where);
			$p=$db4->getResult();
			foreach ($p as $key => $value) {
				foreach ($value as $k => $v) {
					$loginTabDet[$k]=$v;
				}
			}
			$fullDetails= array("fname"=>$loginTabDet['fname'], "lname"=>$loginTabDet['lname'], "gender"=>$loginTabDet['gender'], "city"=>$loginTabDet['city'], "state"=>$loginTabDet['state'], "country"=>$loginTabDet['country'], "mob"=>$loginTabDet['mob'], "email"=>$loginTabDet['email'], "uname"=>$loginTabDet['uname'], "password"=>$loginTabDet['password']);
			return $fullDetails;
		}
	}
?>
