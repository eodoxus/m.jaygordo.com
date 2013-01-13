<?php defined('SYSPATH') OR die('No direct access allowed.');

class ImageCache {
	
	public static function thumb($path, $preset, $constrain='height') {
		
		$image_server = Kohana::config('app.cms_path');
		$path = str_replace('sites/default/files', 'sites/default/files/imagecache/'.$preset, $path);
		
		if (strpos($preset, 'x') !== false) {
			list($width, $height) = explode('x', $preset);
		} else {
			return '<img src="'.$image_server.$path.'" />';
		}
		
		if ($constrain == 'width') {
			return '<img src="'.$image_server.$path.'" width="'.$width.'" />';
		}
		return '<img src="'.$image_server.$path.'" height="'.$height.'" />';
	}
	
	public static function raw_path($path) {
		$image_server = Kohana::config('app.cms_path');
		return $image_server.$path;
	}
}