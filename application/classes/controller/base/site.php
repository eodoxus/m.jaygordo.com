<?php

class Controller_Base_Site extends Controller_Template {
	public $template = 'layouts/default';
	
	protected $_scripts;
	protected $_styles;
	protected $_breadcrumb = array();
	
	public function before() {
		parent::before();
		
		$this->session 	= Session::instance();
		
		if ($this->auto_render) {
			// Get the view and set it in the controller
			$view_name = $this->request->controller . '/' . $this->request->action;
			$view_name = str_replace('_', '/', $view_name);
			
			// Attach directory of route
			if (isset($this->request->directory)) {
				$view_name = $this->request->directory . '/' . $view_name;
			}
			
			$view_name = strtolower($view_name);
			
			// Attach the view if it exists
			$this->view = (bool) Kohana::find_file('views', $view_name) ? new View($view_name) : new View();
			
			// Assign the content to template
			$this->template->content = $this->view;
			$this->template->set_global('request', Request::current());

			$this->_scripts 	= Kohana::config('app.scripts');
			$this->_styles 		= Kohana::config('app.styles');
			
			// Default CSS styles
			$this->body_class 	= $this->request->controller . " " . $this->request->controller. "-" . $this->request->action;
			
			// Create initial breadcrumbs
			$this->add_breadcrumb('/', 'Home');
			
			// Add controller to breadcrumb
			if ($this->request->controller != 'home') {
				$this->add_breadcrumb($this->request->controller, ucfirst($this->request->controller));
			}
		}
	}
	
	public function after() {
		parent::after();

		// Append required includes to the array 
		if ($this->auto_render) {
			$this->template->scripts 		= $this->_scripts;
			$this->template->styles 		= $this->_styles;
			
			$this->template->title = isset($this->title) ? ' '.$this->title : '';
			$this->template->description = isset($this->description) ? $this->description : '';
			$this->template->keywords = isset($this->keywords) ? $this->keywords : '';
			
			$this->template->body_class = $this->body_class;
			$this->template->breadcrumbs = $this->_breadcrumbs;
			//$this->template->set_global('active_user', User::current());
		}
		
		// Destroy the database connections
		foreach (Database::$instances as &$conn) unset($conn);
	}
	
	protected function add_breadcrumb($url, $title) {
		$this->_breadcrumbs[] = HTML::anchor($url, $title);
	}
	
	protected function add_script($urls) {
		$this->_scripts = Arr::merge($this->_scripts, (array) $urls);
	}
	
	protected function add_stylesheet($urls) {
		$this->_styles = Arr::merge($this->_styles, (array) $urls);
	}
}
