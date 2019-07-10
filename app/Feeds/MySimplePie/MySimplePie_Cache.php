<?php

require_once(dirname(__FILE__) . "/MySimplePie_Cache_MySQL.php");

class MySimplePie_Cache extends SimplePie_Cache
{
    /**
     * Don't call the constructor. Please.
     */
    private function __construct() { }

    /**
     * Create a new SimplePie_Cache object
     *
     * @deprecated Use {@see get_handler} instead
     */
    public function create($location, $filename, $extension)
    {
        trigger_error('Cache::create() has been replaced with Cache::get_handler(). Switch to the registry system to use this.', E_USER_DEPRECATED);
        return new MySimplePie_Cache_MySQL($location, $filename, $extension);
    }

    /**
     * Parse a URL into an array
     *
     * @param string $url
     * @return array
     */
    public static function parse_URL($url)
    {
        $params = parse_url($url);
        $params['extras'] = array();
        if (isset($params['query']))
        {
            parse_str($params['query'], $params['extras']);
        }
        return $params;
    }
}