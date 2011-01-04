<?php
    function smarty_function_getgooglemapimageurl($params, $smarty)
    {
    
    	global $CONFIG;
    	
        $baseUrl = 'http://maps.google.com/staticmap';
 
        $defaults = array(
            'key'        => $CONFIG['google_key'],
            'longitude'  => '',
            'latitude'   => '',
            'w'          => 0,
            'h'          => 0,
            'type'       => '',
            'sensor'	 => 'false',
            'zoom'		 => '14'
        );
 
        $types = array('roadmap', 'mobile');
        
        if(isset($params['coords']))
        {
        	$coords = explode(',', $params['coords']);
        	
        	$params['latitude'] = $coords[0];
        	$params['longitude'] = $coords[1];
        }
 
        foreach ($defaults as $k => $v) {
            if (!array_key_exists($k, $params))
                $params[$k] = $v;
        }
 
        if (strlen($params['key']) == 0)
            $smarty->trigger_error('getgooglemapimageurl: you must specify your Google Maps API key', E_USER_NOTICE);
 
        $params['w'] = min(512, (int) $params['w']);
        $params['h'] = min(512, (int) $params['h']);
 
        if ($params['w'] <= 0)
            $smarty->trigger_error('getgooglemapimageurl: you must specify the map width in pixels', E_USER_NOTICE);
 
        if ($params['h'] <= 0)
            $smarty->trigger_error('getgooglemapimageurl: you must specify the map height in pixels', E_USER_NOTICE);
 
        // setup the required parameters
        $url = sprintf('%s?key=%s&size=%dx%d', $baseUrl, $params['key'], $params['w'], $params['h']);
 
        // specify the map type
        if (in_array($params['type'], $types))
            $url .= sprintf('&maptype=%s', $params['type']);
 
        $url .= sprintf('&markers=%lf,%lf', $params['latitude'], $params['longitude']);
        $url .= sprintf('&zoom=%s', $params['zoom']);
 
        return $url;
    }
?>