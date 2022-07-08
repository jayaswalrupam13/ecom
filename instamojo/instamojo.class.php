<?php
class instamojo{
	
	//creating a request
	function createRequest($payload){
		global $INS_PRIVATE_API_KEY, $INS_PRIVATE_AUTH_TOKEN, $INS_PAYMENT_SITE_URL;	
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://$INS_PAYMENT_SITE_URL/api/1.1/payment-requests/");
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:$INS_PRIVATE_API_KEY",
						  "X-Auth-Token:$INS_PRIVATE_AUTH_TOKEN"));
		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);			
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if(curl_errno($ch)){
			$response['technical_error'] = curl_error($ch);
		}
		else{
			$response = json_decode($response,true);
		}	
		curl_close($ch);
		return $response;		
	}
	
	//Get Payment Request Details - details of a particular payment request.
	function getPaymentRequestDetails($payment_request_id){
		global $INS_PRIVATE_API_KEY, $INS_PRIVATE_AUTH_TOKEN, $INS_PAYMENT_SITE_URL;
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, "https://$INS_PAYMENT_SITE_URL/api/1.1/payment-requests/$payment_request_id");		
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:$INS_PRIVATE_API_KEY",
						  "X-Auth-Token:$INS_PRIVATE_AUTH_TOKEN"));

		$response = curl_exec($ch);		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);		

		if(curl_errno($ch)){
			$response['technical_error'] = curl_error($ch);  //error in retrieving data and not status = failure
		}
		else{
			$response = json_decode($response,true);
		}			
		curl_close($ch);
		return $response;
	}
	
	//Get Payment Details - returns the details of a payment related to a particular payment request.
	function getPaymentDetails($payment_id){
		global $INS_PRIVATE_API_KEY, $INS_PRIVATE_AUTH_TOKEN, $INS_PAYMENT_SITE_URL;
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, "https://$INS_PAYMENT_SITE_URL/api/1.1/payments/$payment_id/");
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:$INS_PRIVATE_API_KEY",
						  "X-Auth-Token:$INS_PRIVATE_AUTH_TOKEN"));
		$response = curl_exec($ch);	
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if(curl_errno($ch)){
			$response['technical_error'] = curl_error($ch);
		}
		else{		
			$response = json_decode($response,true);
		}
		curl_close($ch);
		return $response;
	}	
}
?>