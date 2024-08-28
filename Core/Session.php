<?php
class Session
{
	public function __construct()
	{
		if(!session_id()){
			session_start();
		}
	}
	
	public function __get($name)
	{
		if(!empty($_SESSION[$name])){
			return $_SESSION[$name];
		}
		return null;
	}

	public function __isset($name)
	{
		return $this->has($name);
	}	

	public function all()
	{
		return (object)$_SESSION;
	}

	public function set(string $key, $value)
	{
		$_SESSION[$key] = (is_array($value) ? (object)$value : $value);
		return $this;
	}

	public function unset(string $key)
	{
		unset($_SESSION[$key]);
		return $this;
	}

	public function has(string $key)
	{
		return isset($_SESSION[$key]);
	}

	public function regenerate()
	{
		session_regenerate_id(true);
		return $this;
	}

	public function destroy()
	{
		session_destroy();
		return $this;
	}

	public function flash()
	{
		if($this->has("flash")){
			$flash = $this->flash;
			$this->unset("flash");
			return $flash;
		}
		return null;
	}
	public function csrf()
	{
		$_SESSION['csrf_token'] = base64_encode(random_bytes(20));
	}
}