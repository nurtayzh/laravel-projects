<?php

namespace App;

class Twitter {

	protected $key;

	public function __construct($key)
	{
		$this->key = $key;
	}
}