<?php

// Here helper functions will be stored

function flash($message)
{
	session()->flash('message', $message);
}