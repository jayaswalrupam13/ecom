<?php
class getsubcategoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$categoriesID = $request->getParameter('categories_id');
		$result = $proObj->getSubCatOfCategory($pdoObj,$categoriesID);//echo "<br><pre>result is ";print_r($result);
		if(empty($result)){
			echo "<option value=''>No sub categories found</option>";
		}
		else{
			$html = "";
			foreach($result as $val){
				$html .= "<option value='".$val['id']."'>".$val['sub_categories']."</option>";
			}
			echo $html;
		}
			
	}
}
?>