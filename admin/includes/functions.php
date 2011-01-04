<?php



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