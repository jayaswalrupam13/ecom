<?php
class productreviewAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$type = $request->getParameter('type');
		if(isset($type) && $type != ''){
			$id = $request->getParameter('id');	
			if( (is_numeric($id) && ($id > 0)) ){	
				if($type == 'status'){
					$operation = $request->getParameter('operation');
					$status    = ($operation == 'active') ? '1' : '0';	
					$proObj->editProductReviewStatus($pdoObj,$status,$id);
				}
				elseif($type == 'delete'){
					$proObj->deleteProductReview($pdoObj,$id);
				}
			}
		}
		$return            = [];
		$return['comment'] = $proObj->getAllProductReviews($pdoObj);//echo "<br/><pre>  is ";print_r($return);	
		return $return;			
	}
}
?>