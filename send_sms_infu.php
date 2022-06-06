<?php
define( 'FORMS_SMS_API_KEY',      'f6a4b5cc-6d31-404f-ace4-c378b1102021' );
define( 'FORMS_SMS_API_USER', 	'Bluegiraffe11' ); 	            // For InforU
define( 'FORMS_SMS_API_TOKEN', 	'dt0cb6ajsjxthdjiu0ym63d38' ); 	// For InforU
define( 'FORMS_SMS_API_SENDER', 	'nownet' ); 		            // For InforU
define( 'FORMS_TEST_MODE',        false ); // show code in console


function SendSMS( $message_text, $recipients ){
	$api_key 		= FORMS_SMS_API_KEY;
	$url 			= 'https://ssl-vp.com/rest/v1/Messages?sendnow=true&api_key=' . $api_key;
	$api_data 		= array (
		'toMembersByCell' 	=> array ( $recipients ),
		'body' 				=> $message_text,
	);
	$options 		= array (
		'http' => array (
			'header' 	=> "Content-type: application/x-www-form-urlencoded\r\n",
			'method' 	=> 'POST',
			'content' 	=> http_build_query( $api_data )
		)
	);
	$context 		= stream_context_create( $options );
	$result 		= file_get_contents( $url, false, $context );
}


// send by InforUMobile
// $recipients = '0501111111;0502222222' - if more than one number
function SendSMSInforU( $message_text, $recipients ){
	$sms_user 		= FORMS_SMS_API_USER; 	// get on InforU
	$sms_apitoken 	= FORMS_SMS_API_TOKEN; 	// get on InforU
	$sms_sender 	= FORMS_SMS_API_SENDER; 	// from who send it. Will displaed in the recipient's phone as the sender. Number or name

	$message_text 	= preg_replace( "/\r/", '', $message_text );

	$xml = '';
	$xml .= '<Inforu>' . PHP_EOL;
	$xml .= '<User>' . PHP_EOL;
	$xml .= '	<Username>' . htmlspecialchars( $sms_user ) . '</Username>' . PHP_EOL;
	$xml .= '	<ApiToken>' . htmlspecialchars( $sms_apitoken) . '</ApiToken>' . PHP_EOL;
	$xml .= '</User>' . PHP_EOL;
	$xml .= '<Content Type="sms">' . PHP_EOL;
	$xml .= '	<Message>' . htmlspecialchars( $message_text ) . '</Message>' . PHP_EOL;
	$xml .= '</Content>' . PHP_EOL;
	$xml .= '<Recipients>' . PHP_EOL;
	$xml .= '	<PhoneNumber>' . htmlspecialchars( $recipients ) . '</PhoneNumber>' . PHP_EOL;
	$xml .= '</Recipients>' . PHP_EOL;
	$xml .= '<Settings>' . PHP_EOL;
	$xml .= '	<Sender>' . htmlspecialchars( $sms_sender ) . '</Sender>' . PHP_EOL;
	$xml .= '</Settings>' . PHP_EOL;
	$xml .= '</Inforu>' . PHP_EOL;

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, 'https://api.inforu.co.il/SendMessageXml.ashx' );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, 'InforuXML=' . urlencode( $xml ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$response = curl_exec( $ch );
	curl_close( $ch );

	return $response;
}