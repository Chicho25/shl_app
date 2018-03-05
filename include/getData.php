<?php
	include("config.php"); 
    include("defs.php");
	
	
	$loggdUType = current_user_type();
	$reqType = $_POST['reqtype'];
	switch($reqType)
	{
		
		
		case 'getroutes':
			$sector = $_POST['sector'];
			$qry="";
			if($sector > 0)
				$qry=" where Code_Sector = '".$sector."'";
			$getData = GetRecords("SELECT Code_Rute , Description_of_Rute , Code_Sector FROM PDT_Rutes
								   $qry
								   ORDER BY Code_Rute
								 ");
			$arrData= array();
			foreach ($getData as $key => $value) {
				//$html.='<option value="'.$value['Code_Rute'].'">'.$value['Code_Rute'].'</option>';
				$arrRow = array('Code_Rute' => $value['Code_Rute'], 'description' => $value['Description_of_Rute'] );
				$arrData[] = $arrRow;
			}
			echo json_encode($arrData);
			break;
		case "getprice" : 
			$empresa = $_POST['empresa'];
			$codigocliento = $_POST['codigocliento'];
			$producto = $_POST['producto'];
			$tipodepre = $_POST['tipodepre'];
			$codigoruta = $_POST['codigoruta'];
			if($empresa != "" && $producto != "" && $tipodepre != "")
			{
				$splitProdCod = explode("|", $producto);
				$producto = $splitProdCod[0];
				
				$getPrice = GetRecord("PDT_Client_Discount_PRD", "Id_Company = '".$empresa."' AND Code_Product = '".$producto."' AND Code_Client = '".$codigocliento."' AND Code_Presentation_Product = '".$tipodepre."'");
				if(isset($getPrice['Amount_Discount']) && $getPrice['Amount_Discount'] > 0)
					echo $getPrice['Amount_Discount'];
				else
				{
					$getPrice = GetRecord("PDT_Rutes_Discount_PRD", "Id_Company = '".$empresa."' AND Code_Product = '".$producto."'  AND Code_Rute = '".$codigoruta."' AND Code_Presentation_Product = '".$tipodepre."'");
					if(isset($getPrice['Amount_Discount']) && $getPrice['Amount_Discount'] > 0)
						echo $getPrice['Amount_Discount'];
					else
					{
						$getPrice = GetRecord("PDT_Product_Presentation", "Id_Company = '".$empresa."' AND Code_Product = '".$producto."' AND Code_Presentation_Product = '".$tipodepre."'");
						if(isset($getPrice['Price_Sale_Product']) && $getPrice['Price_Sale_Product'] > 0)
							echo $getPrice['Price_Sale_Product'];
						else
						{
							echo 0;
						}
					}
					
				}
				
			}	
		break;

		
	}
?>