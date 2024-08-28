<?php
class Message
{
	private $text;
	private $type;

	public function __toString()
	{
		return $this->render();
	}

	public function getText()
	{
		return $this->text;
	}
	

	public function getType()
	{
		return $this->type;
	}

	public function info(string $message)
	{
		$this->type = CONF_MESSAGE_INFO;
		$this->text = $this->filter($message);
		return $this;
	}

	public function success(string $message)
	{
		$this->type = CONF_MESSAGE_SUCCESS;
		$this->text = $this->filter($message);
		return $this;
	}

	public function warning(string $message)
	{
		$this->type = CONF_MESSAGE_WARNING;
		$this->text = $this->filter($message);
		return $this;
	}

	public function error(string $message)
	{
		$this->type = CONF_MESSAGE_ERROR;
		$this->text = $this->filter($message);
		return $this;
	}

	public function render()
	{
		return "<div class='".CONF_MESSAGE_CLASS." {$this->getType()}' >{$this->getText()}</div>";
	}

	public function json()
	{
		return json_encode(["error" => $this->getText()]);

	}

	public function flash()
	{
		(new Session())->set("flash", $this);
	}

	private function filter(string $message)
	{
		return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
	}
}