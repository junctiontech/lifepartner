<?php
include("Sqlfile.php");
class FilterApi extends sqlfile
{
	private $table='Profiles';
	
	########## Authontication Check Function is Abstrect Method In Every Api You Shoud Used ############
	function AuthonticationCheck($databaseName)
	{
		########################## Check  Licence Date for Organization is Expired Or Not ###############################
		$resultLicence=AuthenticationApi::checkLicenceDate($databaseName);//print_r($result['code']);die;
		if($resultLicence['code']!=='200')
		{
			return $resultLicence;die;
		}
	
		########################## Check  Server Maintainence ###############################
		$resultServerMaintaince=AuthenticationApi::serverMaintaince();//print_r($resultServerMaintaince);die;
		if($resultServerMaintaince['code']!=='200')
		{
			return $resultServerMaintaince;die;
		}
	
		########################## Check Organization Status is Active Or In Active ###############################
		$resultOrganizationStatus=AuthenticationApi::checkOrganizationStatus($databaseName);//print_r($response);die;
		if($resultOrganizationStatus['code']!=='200')
		{
			return $resultOrganizationStatus;die;
		}
	
	}
	########## Authontication Check Function is Abstrect Method In Every Api You Shoud Used ############
	
	function getApi($databaseName,$param)
	{	
		$filter=array();
		$result=array();
		$result=json_decode($param,true);//print_r($result);print_r($result['filter']);die;
		//$response=array('code'=>$result,'message'=>$param);echo json_encode($response);die;
		if(isset($result['filter']) && count($result['filter'])>0)
		{
			$filter= $result['filter'];
		}
		$response=$this->get($databaseName,$this->table,$filter);//print_r($response);die;
		return $response;
	}
	
	function postApi($databaseName,$param)
	{	
	
		$response=$this->post($databaseName,$this->table,$param);//print_r($fields);die;
		return $response;
		
	}
	
	function putApi($databaseName,$param)
	{	
		$var=str_replace("_", " ", $param);
		$result=json_decode($var,true);//return $result;die;
		$data=$result['data'];
		$filter=$result['filter'];
		$response=$this->put($databaseName,$this->table,$data,$filter);//;print_r($response);
		return $response;
		
	}
	
	
	function deleteApi($databaseName,$param)
	{
		$result=json_decode($param,true);//print_r($result['filter']);die;
		$filter= $result['filter'];
		$response=$this->delete($databaseName,$this->table,$filter);//print_r($response);die;
		return $response;
	}
	
	/*---------------------------------- Abstract Method for search--------------------*/
	function search($param)
	{
		
	}
	
	function casteSearch($databaseName,$param)
	{
		$connection=Config::connection($databaseName);
		if(isset($connection) && !empty($connection) && $connection!==0)
		{
			$list=array();
			$sql="select DISTINCT caste from Profiles where caste like '%".'b'."%'";
			//$response=array('code'=>'200','message'=>'Valid Id','result'=>$sql);return $response;die;
			$searchDataQuery=mysqli_query($connection, $sql);
			if(mysqli_num_rows($searchDataQuery)>0)
			{
				while($searchList=mysqli_fetch_assoc($searchDataQuery))
				{
					$list[]=$searchList;
				}
				$response=array('code'=>'200','message'=>'Valid Id','result'=>$list);return $response;die;
			}
			else 
			{
				$response=array('code'=>'401','message'=>'Data Not Found','result'=>'');return $response;die;
			}
		}
		else
		{
			$response=array('code'=>'502','message'=>'Bad Gateway or Connection Failed','result'=>mysqli_error($connection));return $response;
		}
	}
	
	
	function MultiInsert($databaseName,$param)
	{
		$result=array();
		$connection=Config::getConnection($databaseName);
		if(isset($connection) && !empty($connection) && $connection!==0)
		{
			foreach ($param as $data)
			{
				$SQLRouteStoppagesGetInformation="select * from routestoppages where MasterEntryId='".$data['MasterEntryId']."'";
				$RouteStoppagesGetInformationQuery=mysqli_query($connection, $SQLRouteStoppagesGetInformation);
				if(mysqli_num_rows($RouteStoppagesGetInformationQuery)>0)
				{
					$updateSQLRouteStoppageInfo="update routestoppages set MasterEntryValue='".$data['MasterEntryValue']."',StopLat='".$data['StopLat']."',StopLong='".$data['StopLong']."',Time='".$data['Time']."' where MasterEntryId='".$data['MasterEntryId']."'";
					$updateQueryRouteStoppageInfo=mysqli_query($connection, $updateSQLRouteStoppageInfo);
					if(mysqli_affected_rows($connection)>0)
					{
						$result[]=array('MasterEntryId'=>$data['MasterEntryId'],'status'=>'success','type'=>'update');
					}
					else
					{
						$result[]=array('MasterEntryId'=>$data['MasterEntryId'],'status'=>'No Changs','type'=>'update');
					}
				}
				else 
				{
					$InsertSQLRouteStoppageInfo="insert into routestoppages(MasterEntryStatus,MasterEntryName,MasterEntryValue,Grade,GradeRange,StopLat,StopLong,Time) values('".$data['MasterEntryStatus']."','".$data['MasterEntryName']."','".$data['MasterEntryValue']."','".$data['Grade']."','".$data['GradeRange']."','".$data['StopLat']."','".$data['StopLong']."','".$data['Time']."')";
					$InsertQueryRouteStoppageInfo=mysqli_query($connection, $InsertSQLRouteStoppageInfo);
					if($InsertQueryRouteStoppageInfo)
					{
						$lastInsertId=mysqli_insert_id($connection);
						$result[]=array('MasterEntryId'=>$lastInsertId,'status'=>'success','type'=>'insert');
					}
					else 
					{
						$result[]=array('MasterEntryId'=>'','status'=>'Fail','type'=>'insert');
					}
				}
			}
			$response=array('code'=>'200','message'=>'','result'=>$result);return $response;
		}
		else
		{
			$response=array('code'=>'502','message'=>'Bad Gateway or Connection Failed','result'=>mysqli_error($connection));return $response;
		}
	}
	
	
	function MultipleStopageMasterEntry($databaseName,$param)
	{
	
		//print_r($param);
		//foreach (array_expression as $value)
	
	
		$finalArray=array();
		foreach ($param as $data)
		{
			$return_array = array();
			if(isset($data['MasterEntryId']) && !empty($data['MasterEntryId']) )
			{
	
				$return_array['type'] = 'Update';
				$filter['MasterEntryId'] = $data['MasterEntryId'];
				//print_r($data);
				//print_r($filter);
				//die;
					
				$stopData = array();
					
				/* if(isset($data['StopLat']) && isset($data['StopLong']))
				{ 
						
					$stopData['StopLat'] = $data['StopLat'];
					$stopData['StopLong'] = $data['StopLong'];
					unset( $data['StopLat']);
					unset( $data['StopLong']);
				} */
					
				$response=$this->put($databaseName,$this->table,$data,$filter);
				//;print_r($response);
					
				if($response['code'] == 200)
				{
					//$stopData['MasterEntryId'] = $filter['MasterEntryId'];
				//	$response=$this->put($databaseName,$this->table_stop,$stopData,$filter);
						
					/* if($response['code'] == 200)
					{
						$return_array['id'] = $data['MasterEntryId'];
						$return_array['stop_name'] = $data['MasterEntryValue'];
						$return_array['result'] = "Success";
	
	
					}
					else
					{
						$return_array['id'] = $response['result'];
						$return_array['stop_name'] = $data['MasterEntryValue'];
						$return_array['result'] = "Failure";
	
					} */
	
	
				}
				else {
					$return_array['id'] = $response['result'];
					$return_array['stop_name'] = $data['MasterEntryValue'];
					$return_array['result'] = "Failure";
				}
	
					
	
			}
			else
			{
					
				$return_array['type'] = 'Insert';
					
				$stopData = array();
	
				if(isset($data['StopLat']) && isset($data['StopLong']))
				{
						
					$stopData['StopLat'] = $data['StopLat'];
					$stopData['StopLong'] = $data['StopLong'];
					unset( $data['StopLat']);
					unset($data['StopLong']);
				}
					
				$response=$this->post($databaseName,$this->table,$data);
	
				if($response['code'] == 201)
				{
					/* $stopData['MasterEntryId'] = $response['result'];
					$response=$this->post($databaseName,$this->table_stop,$stopData);
					if($response['code'] == 201)
					{
						$return_array['id'] = $stopData['MasterEntryId'];
						$return_array['stop_name'] = $data['MasterEntryValue'];
						$return_array['result'] = "Success";
							
							
					}
					else
					{
						$return_array['id'] = $response['result'];
						$return_array['stop_name'] = $data['MasterEntryValue'];
						$return_array['result'] = "Failure";
	
					} */
				}
				else
				{
					$return_array['id'] = $response['result'];
					$return_array['stop_name'] = $data['MasterEntryValue'];
					$return_array['result'] = "Failure";
						
				}
					
					
			}
			$finalArray[]=$return_array;
		}
		//return $finalArray;
		return $arry=array('data'=>$finalArray);die;
		return json_encode($arry);
	}
	

	function GetStopageMasterEntry($databaseName,$param)
	{
		$connection=Config::getConnection($databaseName);
		if(isset($connection) && !empty($connection) && $connection!==0)
		{
			$list=array();
		//	$param['MasterEntryName'] = 'RouteStoppage';
			$sqlMasterEntryStopageLatLng="select masterentry.*,stopLatLong.StopLat,StopLong from masterentry,stopLatLong where masterentry.MasterEntryName='RouteStoppage' and masterentry.MasterEntryId=stopLatLong.MasterEntryId";
			$QueryMasterEntryStopageLatLng=mysqli_query($connection, $sqlMasterEntryStopageLatLng);
			if(mysqli_num_rows($QueryMasterEntryStopageLatLng)>0)
			{
				while($MasterEntryStopageLatLngList=mysqli_fetch_assoc($QueryMasterEntryStopageLatLng))
				{
					$list[]=$MasterEntryStopageLatLngList;
				}
				$response=array('code'=>'200','message'=>'Valid Id','result'=>$list);return $response;die;
			}
			else
			{
				$response=array('code'=>'401','message'=>'Data Not Found','result'=>mysqli_error($connection));return $response;die;
			}
		}
		else
		{
			$response=array('code'=>'502','message'=>'Bad Gateway or Connection Failed','result'=>mysqli_error($connection));return $response;
		}
	}
	
	
	function GetStopageMasterEntryById($databaseName,$param)
	{
		$connection=Config::getConnection($databaseName);
		if(isset($connection) && !empty($connection) && $connection!==0)
		{
			$a=array();
			$list=array();
			$masterEntryID=explode(',',$param['MasterEntryId']);
			foreach($masterEntryID as $listMasterEntryID)
			{
				$sqlMasterEntryStopageLatLng="select * from routestoppages where MasterEntryName='RouteStoppage' and MasterEntryId='".$listMasterEntryID."'";
				$QueryMasterEntryStopageLatLng=mysqli_query($connection, $sqlMasterEntryStopageLatLng);
				if(mysqli_num_rows($QueryMasterEntryStopageLatLng)>0)
				{
					while($MasterEntryStopageLatLngList=mysqli_fetch_assoc($QueryMasterEntryStopageLatLng))
					{
						$list[]=$MasterEntryStopageLatLngList;
					}
					
				}  
			}
			$response=array('code'=>'200','message'=>'Valid Id','result'=>$list);return $response;die;
		}
		else
		{
			$response=array('code'=>'502','message'=>'Bad Gateway or Connection Failed','result'=>mysqli_error($connection));return $response;
		}
	}
	
	
} 
if(isset($_SERVER['REQUEST_METHOD']) &&!empty($_SERVER['REQUEST_METHOD']))
{	
	$instance= new FilterApi();
	$method=$_SERVER['REQUEST_METHOD'];
	if(strcasecmp($method, 'get')==0)
	{	 
		$param='';
		if(isset($_GET['databaseName'])&&!empty($_GET['databaseName']))
		{
			if(isset($_GET['data'])&&!empty($_GET['data']))
			{
				$param=$_GET['data'];
			}
			$databaseName=$_GET['databaseName'];
		//	$response=$instance->GetStopageMasterEntry($databaseName,$param);
			$response=$instance->getApi($databaseName,$param);
			echo json_encode($response);
		}
		else
		{
			$response=array('code'=>'400','message'=>'unknown method');echo json_encode($response);
		}
	}
	elseif(strcasecmp($method, 'post')==0)
	{
		if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='searchCaste')
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->casteSearch($databaseName,$param);
			echo json_encode($response);die;
		}
		if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='multipleStopageMasterEntrys')
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->MultipleStopageMasterEntry($databaseName,$param);
			echo json_encode($response);die;
		}
		if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='multipleStopageMasterEntry')
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->MultiInsert($databaseName,$param);
			echo json_encode($response);die;
		}
		if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='stopageMasterEntry')
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->GetStopageMasterEntry($databaseName,$param);
			echo json_encode($response);die;
		}
		if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='stopageMasterEntryById')
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->GetStopageMasterEntryById($databaseName,$param);
			echo json_encode($response);die;
		}
		if(isset($_GET['databaseName'])&&!empty($_GET['databaseName']))
		{
			$param=json_decode($_POST['data'],true);
			$databaseName=$_GET['databaseName'];
			$response=$instance->postApi($databaseName,$param);
			echo json_encode($response);
		}
		else
		{
			$response=array('code'=>'403','message'=>'Invalid Parameter Supply');echo json_encode($response);
		}
	}	
	elseif(strcasecmp($method, 'put')==0)
	{
		if(isset($_GET['data'])&&!empty($_GET['data']) && isset($_GET['databaseName'])&&!empty($_GET['databaseName']))
		{
			$param=$_GET['data'];
			$databaseName=$_GET['databaseName'];
			$response=$instance->putApi($databaseName,$param);
			echo json_encode($response);
		}
		else
		{
			$response=array('code'=>'403','message'=>'Invalid Parameter Supply');echo json_encode($response);
		}
	}
	elseif(strcasecmp($method, 'delete')==0)
	{
		if(isset($_GET['data'])&&!empty($_GET['data']) && isset($_GET['databaseName'])&&!empty($_GET['databaseName']))
		{
			$param=$_GET['data'];
			$databaseName=$_GET['databaseName'];
			$response=$instance->deleteApi($databaseName,$param);
			echo json_encode($response);
		}
		else
		{
			$response=array('code'=>'403','message'=>'Invalid Parameter Supply');echo json_encode($response);
		}
	}
	else 
	{
		$response=array('code'=>'400','message'=>'unknown method');echo json_encode($response);
	}
}

