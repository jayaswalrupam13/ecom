<?php
class paytm{	
	
	function getOrderDetails($orderID){		
		$return   = array();
		$param    = array();		
		$param    = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $orderID); 
		$checkSum = getChecksumFromArray($param,PAYTM_MERCHANT_KEY);
		
		$param['CHECKSUMHASH'] = $checkSum;		
		$return  = getTxnStatusNew($param); //Call PG's getTxnStatusNew() ft for verifying the transaction status.
		return $return;
	}
}
?>