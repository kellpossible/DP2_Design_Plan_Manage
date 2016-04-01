<?php
/**
* A controller as part of the MVC design pattern
*/
abstract class Controller
{
	protected $templates;
	protected $models;
	function __construct($templates, $models)
	{
		$this->templates = $templates;
		$this->models = $models;
	}
}
?>