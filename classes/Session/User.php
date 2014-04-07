<?php
	class User {
		
		private $accessLevel = AccessLevel::NONE;
		
		private $username;
		
		private $isLoggedIn = false;
		
		public function __construct(){
		
		}
		
		public function login($username, $password){
			$this->username = $username;
			$this->isLoggedIn = true;
		}
		
		public function logout(){
			$this->username = "";
			$this->isLoggedIn = false;
		}
		
		public function isLoggedIn(){
			return $this->isLoggedIn;
		}
		
		public function getUsername(){
			return $this->username;
		}
		
		public function checkAccessLevel($level){
			return ($this->accessLevel & $level) === $level;
		}
		
		// saves all user data in session
		public function save(){
			$_SESSION['user'] = serialize($this);
		}
		
		public static function createFromSession($sessionVars){
			if (!isset($_SESSION['user'])){
				// create new user
				$u = new User();
				
				return $u;
			} else {
				return unserialize($_SESSION['user']);
			}
		}
		
		public function __sleep(){
			return array(
				'isLoggedIn',
				'accessLevel',
				'username'
			);
		}
		
		public function __wakeup(){
			
		}
	}
	
	class AccessLevel {
		
		const NONE = 1;
		const VIEW = 2;
		const ADMIN = 4;
		
	}