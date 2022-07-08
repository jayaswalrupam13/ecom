<?php
class addTOCart{
	
	function addProduct($pID,$qty,$attrID){
		$_SESSION['cart'][$pID][$attrID]['qty'] = $qty;
	}
	
	function updateProduct($pID,$qty,$attrID){
		if(isset($_SESSION['cart'][$pID][$attrID])){
			$_SESSION['cart'][$pID][$attrID]['qty'] = $qty;
		}
	}
	
	function removeProduct($pID,$attrID){
		if(isset($_SESSION['cart'][$pID][$attrID])){
			unset($_SESSION['cart'][$pID][$attrID]);
		}
	}
	
	function totalProduct(){
		if(isset($_SESSION['cart'])){
			return count($_SESSION['cart']);
		}
		return 0;
	}
	
	function emptyProduct(){
		unset($_SESSION['cart']);
	}
}
	
?>