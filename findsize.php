<?php
/* Included simple_html_dom php library file 
to read the html content for the given url. 
Included sizeClass which having curl functonality to find the size of the url and checking the url type. 
*/
include('simple_html_dom.php');
include('sizeClass.php');

$url = $argv[1]; // getting iput value from commnad line
$obj = new sizeClass($url); // creating object for sizeClass
/*
checking  if the input URL points to an HTML page,
if it doesn't then it will be a single file resource.
*/

if (!$obj->check_if_html()){
    $totalSize = $obj->get_sub_file_size($url);
    print_r($totalSize);
    echo "Final Total Download Size: $totalSize Bytes ";
    $obj->total_request += 1;  //a single resource is still an HTTP request
    echo " <br> Final total HTTP requests: $obj->total_request" ;
    return;
}
/*
url will be a html file so we need to check the size of included image, css and javascript files. 
The count will be increase to +1 as of url will be one requset. 
*/
$obj->total_request += 1; 
// getting html  content of given url.
$html = file_get_html($url);



// Find all CSS size
foreach($html->find('link') as $element){
	if (strpos($element->href,'.css') !== false){
	    $size = $obj->get_sub_file_size($element->href);
        $obj->total_size+=  $size; 
	    $obj->total_request+= 1;
	}
     //only output the ones with 'css' inside...
}

//find all javascript size
foreach($html->find('script') as $element){
//check to see if it is javascript file:
    if (strpos($element->src,'.js') !== false) {
            $size = $obj->get_sub_file_size($element->src);
            $obj->total_size+=  $size; 
            $obj->total_request+= 1;
    }
}
// find all images size
foreach($html->find('img') as $element){
	   $size = $obj->get_sub_file_size($element->src);
	   $obj->total_size+=  $size; 
	   $obj->total_request+= 1;    
}

echo "Final total download size: $obj->total_size Bytes" ;

echo "<br>Final total HTTP requests: $obj->total_request";