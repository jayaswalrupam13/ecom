<?php

class managecartAction
{
	function execute(&$request,$pdoObj,$proObj,$addToCartObj)
	{
		$pID  = $request->getParameter("pid");
		$qty  = $request->getParameter("qty");
		$type = $request->getParameter("type");
		$cID  = $request->getParameter("cid");
		$sID  = $request->getParameter("sid");
		
		if(isset($cID) && isset(sID)){
			$attrDtls = $addToCartObj->getDtlsFromAttrs($pdoObj,$pid,$cID,$sID);
		}
		else{
			$attrDtls['id'] = 0; 
		}
		
		if($type == 'remove'){
			$addToCartObj->removeProduct($pID,$attrDtls['id']);
			echo $addToCartObj->totalProduct();
		}
		else{		
			
			
			$prodSoldNum = $proObj->getProdSoldNumByID($pdoObj,$pID);
			$prodQtyNum  = $proObj->getProductQty($pdoObj,$pID);
			$prodLeftNum = $prodQtyNum - $prodSoldNum;
			
			if($qty > $prodLeftNum){
				echo 'Only '.$prodLeftNum. ' product(s) left in stock. You cannot enter '.$qty.' ';
			}
			else{
				if($type == 'add'){
					$addToCartObj->addProduct($pID,$qty,$attrDtls['id']);
				}				
				if($type == 'update'){
					$addToCartObj->updateProduct($pID,$qty,$attrDtls['id']);
				}
				echo $addToCartObj->totalProduct();
			}
		}
	}
}
?>