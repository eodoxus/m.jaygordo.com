<?php defined('SYSPATH') or die('No direct script access.');

class URL extends Kohana_URL {

    public static function current($absolute = FALSE, $protocol = FALSE) {
        $url = Request::instance()->uri();

        if($absolute === TRUE) {
            $url = self::site($url, $protocol);
		}
		
        return $url;
    }
}