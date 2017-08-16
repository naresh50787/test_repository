<?php
class sizeClass
{
    public $url;
    public $total_size;
    public $total_request;

    public function __construct($url){
        $this->url =$url;   
        $this->total_size=0; // by default set totalSize to 0
        $this->total_request=0; // by default set totalRequest to 0

    }

//check the given input url content header type is as HTML page or not. 
    public function check_if_html(){
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE );

        curl_close($ch);

        if (strpos($contentType,'text/html') !== false){
            return TRUE; 	// written true when content type is text / html 
        }else{
            return FALSE;
        }            
    }

// Below function will take I/P as url and written O/P as size of that url.
    public function get_sub_file_size($url) {
        //echo $url;
        $headers = get_headers($url, 1);
        //print_r($headers);
        if (isset($headers['Content-Length'])){
            return $headers['Content-Length'];
        } 
        //this one checks for lower case "L" IN CONTENT-length
        if (isset($headers['Content-length'])){
            return $headers['Content-length'];
        } 
        // some times content-lenght will not written so using curl we can get the size of the file.
        $c = curl_init();
        curl_setopt_array($c, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('User-Agent: Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3'),
            ));
        curl_exec($c);
        $size = curl_getinfo($c, CURLINFO_SIZE_DOWNLOAD);
        curl_close($c);
        return $size;
    }


}