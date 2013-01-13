<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Block extends Controller_Template {
	
	public $block;
	public $op;
	
	public function before() {
		$view_name = 'blocks/'.$this->request->controller.'/'.$this->request->action;
		
		if (isset($this->op)) {
			$view_name .= '_'.$this->op;
		}
		
		$this->template = $this->view = (bool) Kohana::find_file('views', $view_name) ? new View($view_name) : NULL;
		if ($this->template) {
			$this->template->block = $this->block;
		}
	}
}