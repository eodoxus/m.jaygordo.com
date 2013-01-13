<?php

class Controller_LogViewer extends Controller {

	protected $viewer;

	public function before() {
		if (!Kohana::config('loghelper.viewer.enabled')) {
			throw new Kohana_Exception("LogHelper viewer is not enabled");
		}
		$this->viewer = new LogHelper_FileViewer(Kohana::config('loghelper.viewer.dir'));
	}

	public function action_index() {
		$view = View::factory('loghelper/index');
		$view->bind('files', $files);
		$files = $this->viewer->list_files();
		echo $view;
	}

	public function action_view($file) {
		$view = View::factory('loghelper/view');
		$view->bind('file', $file);
		$view->bind('messages', $messages);
		$messages = $this->viewer->get_messages($file);
		echo $view;
	}
}

