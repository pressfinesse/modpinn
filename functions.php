<?php

function mp_curl($subject){

	$curl = curl_init();

	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Keep-Alive: 300";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Pragma: ";
	
	curl_setopt($curl, CURLOPT_URL, $subject);
	//curl_setopt($curl, CURLOPT_USERAGENT, $agent);

	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:63.0) Gecko/20100101 Firefox/63.0');
	curl_setopt($curl, CURLOPT_REFERER, 'https://duckduckgo.com/');
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS);
	curl_setopt($curl, CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS);
	curl_setopt($curl, CURLOPT_POSTREDIR, 2);
	curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
	curl_setopt($curl, CURLOPT_MAXCONNECTS, 3);
	curl_setopt($curl, CURLOPT_CAINFO, "cacert.pem");
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($curl, CURLOPT_SSL_VERIFYSTATUS, false);
	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
	curl_setopt($curl, CURLOPT_AUTOREFERER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 90);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);

	$html = curl_exec($curl);
	curl_close($curl);

	return $html;

    }

	function mp_imgs($obj)
	{

		$dom = new DOMDocument('1.0', '…');
		$dom->loadHTML($obj);
		$dom->preserveWhiteSpace = false;
		$images = $dom->getElementsByTagName('img');
		$pins = '';

		foreach($images as $img){
      	  $pins .= '<img src="'.$img->getAttribute("src").'" />';  
      	  //$uname = $img->getAttribute('src');  
		  //$uname = substr(strrchr($url, "/"), 1);

		  //$pins .= file_get_contents($url);

		}

		return $pins;

	}


function mp_response_code($url) {
    
    $response = wp_remote_get($url);
    $response_code = wp_remote_retrieve_response_code( $response );
    
        return $response_code;
    }

function mp_content_type($url) {
    
    $response = wp_remote_get($url);
    $response_header =  wp_remote_retrieve_header( $response, 'content-type' );
    
        return $response_code;
    }


?>
