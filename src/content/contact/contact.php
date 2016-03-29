<?php
require_once("email.php");

/**
 * Envia uma requisição HTTP para um servidor Web.  
 * http://nadeausoftware.com/articles/2007/07/php_tip_how_get_web_page_using_fopen_wrappers
 * @param $url URL of the requested page
 * @param $method HTTP method to be used (GET, POST, PUT or DELETE)
 * @param $paramArray Array containing the HTTP parameters list to be passed to the web page.
 * @return Return an array containing the header fields and content.
 */
function sendHttpRequest( $url, $method="GET", $paramArray=NULL )
{
    //foreach ($options as $k => $v)

    $httpParams = array(
        'user_agent'    => 'Tracker/1.0',
        'max_redirects' => 10,          // stop after 10 redirects
        'timeout'       => 120,         // timeout on response  
        'method'  => $method
    );
    
    if($paramArray) {
	    //http_build_query — Generate URL-encoded query string 
	    $paramStr = http_build_query($paramArray);
	    if($method=="POST") {
	          $httpParams['header']  = 
	             "Content-type: application/x-www-form-urlencoded\r\n". 
	             "Content-Length: ".strlen($paramStr)."\r\n"; 
	          $httpParams['content'] = $paramStr;
	    }
	    else $url .= "?$paramStr";
	}

    $options = array( 'http' => $httpParams);    
    $context = stream_context_create( $options );
    $page    = @file_get_contents( $url, false, $context );
 
    $response  = array( );
    if ( $page != false )
        $response['content'] = $page;
    else if ( !isset( $http_response_header ) )
        return null;    // Bad url, timeout

    // Save the header
    $response['header'] = $http_response_header;

    // Get the *last* HTTP status code
    $nLines = count( $http_response_header );
    for ( $i = $nLines-1; $i >= 0; $i-- )
    {
        $line = $http_response_header[$i];
        if ( strncasecmp( "HTTP", $line, 4 ) == 0 )
        {
            $aux = explode( ' ', $line );
            $response['http_code'] = $aux[1];
            break;
        }
    }
 
    return $response;
}

$captcha = $_POST["g-recaptcha-response"];
$url = "https://www.google.com/recaptcha/api/siteverify";
$user_ip = $_SERVER["REMOTE_ADDR"];
$params = array("secret"=>"6LeTe_8SAAAAAI_VvhMciYdtFhVrDWWxMLDDnp2d", "response"=>$captcha, "remoteip"=>$user_ip);
$response = sendHttpRequest($url, "GET", $params);
if(is_array($response) && $response["http_code"] == 200 && $response["content"] != null) {
	$captcha_response = json_decode($response["content"]);
	if(is_object($captcha_response) && $captcha_response->success == true) {
		$email = new Email();
		$email->name = $_POST["nome"];
		$email->from = $_POST["email"];
		if($email->send($_POST["assunto"], $_POST["mensagem"], "manoelcampos@gmail.com"))
			header("location: thanks.html");
		else header("location: error.html?c=2");
    }
	else header("location: error.html?c=1");
}
else header("location: error.html?c=0");
