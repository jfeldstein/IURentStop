<?php
function ValidEmail($email)
{
	global $CONFIG;
	return (!eregi($CONFIG['email_regex'], $email) OR $email=='') ? false : true;
}

function loadClasses() {
	$dir = 'includes/'; 
	if ($handle = opendir($dir)) { 
	 while(false!== ($file = readdir($handle))) { 
	   if (!eregi('class\.[a-z]+\.php', $file)) continue; 
	   
	   include_once($dir.$file);
	 } 
	 closedir($handle);  
	} 
}

class HTTPRequest
{
    var $_fp;        // HTTP socket
    var $_url;        // full URL
    var $_host;        // HTTP host
    var $_protocol;    // protocol (HTTP/HTTPS)
    var $_uri;        // request URI
    var $_port;        // port
   
    // scan url
    function _scan_url()
    {
        $req = $this->_url;
       
        $pos = strpos($req, '://');
        $this->_protocol = strtolower(substr($req, 0, $pos));
       
        $req = substr($req, $pos+3);
        $pos = strpos($req, '/');
        if($pos === false)
            $pos = strlen($req);
        $host = substr($req, 0, $pos);
       
        if(strpos($host, ':') !== false)
        {
            list($this->_host, $this->_port) = explode(':', $host);
        }
        else
        {
            $this->_host = $host;
            $this->_port = ($this->_protocol == 'https') ? 443 : 80;
        }
       
        $this->_uri = substr($req, $pos);
        if($this->_uri == '')
            $this->_uri = '/';
    }
   
    // constructor
    function HTTPRequest($url)
    {
        $this->_url = $url;
        $this->_scan_url();
    }
   
    // download URL to string
    function DownloadToString()
    {
        $crlf = "\r\n";
       
        // generate request
        $req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
            .    'Host: ' . $this->_host . $crlf
            .    $crlf;
       
        // fetch
        $this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
        fwrite($this->_fp, $req);
        while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
            $response .= fread($this->_fp, 1024);
        fclose($this->_fp);
       
        // split header and body
        $pos = strpos($response, $crlf . $crlf);
        if($pos === false)
            return($response);
        $header = substr($response, 0, $pos);
        $body = substr($response, $pos + 2 * strlen($crlf));
       
        // parse headers
        $headers = array();
        $lines = explode($crlf, $header);
        foreach($lines as $line)
            if(($pos = strpos($line, ':')) !== false)
                $headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));
       
        // redirection?
        if(isset($headers['location']))
        {
            $http = new HTTPRequest($headers['location']);
            return($http->DownloadToString($http));
        }
        else
        {
            return($body);
        }
    }
}

// From Aardvark Topsites
function parse_form () {
  $return = array_map('strip', array_merge($_GET, $_POST));
  return $return;
} 

// From Aardvark Topsites
function strip ($value) {
  if(is_array($value))
    return array_map('strip', $value);

  $value = str_replace('&#032;', ' ', $value);
  $value = preg_replace('/&(?!#[0-9]+;)/s', '&amp;', $value);
  $value = str_replace('<', '&lt;', $value);
  $value = str_replace('>', '&gt;', $value);
  $value = str_replace('"', '&quot;', $value);
  $value = str_replace('\'', '&#039;', $value);
  $value = preg_replace('/\n/', '<br />', $value);
  $value = preg_replace('/\r/', '', $value);
  $value = str_replace('\\', '', $value);
  $value = stripslashes($value);
  return $value;
}


function make_json($params, &$smarty)
{	$json = "{";
	foreach($params as $key=>$val)
	{$json .= "'$key':'$val', ";
	}$json .= "}";
	return str_replace(", }", "}", $json);
}

function resize_image($inputFilename, $format, $new_side)
{
	$imagedata = getimagesize($inputFilename);
	if(!$imagedata)
		return false;
	
	$w = $imagedata[0];
	$h = $imagedata[1];
	
	if ($h > $w) {
		$new_w = ($new_side / $h) * $w;
		$new_h = $new_side;	
	} else {
		$new_h = ($new_side / $w) * $h;
		$new_w = $new_side;
	}
	
	$im2 = ImageCreateTrueColor($new_w, $new_h);
	$image = ($format=='.jpg') ? ImageCreateFromJpeg($inputFilename) : imagecreatefromgif($inputFilename);
	imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $imagedata[0], $imagedata[1]);
	return $im2;
}

?>