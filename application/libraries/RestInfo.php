<?php
class RestInfo
{
	function get($table,$filter)
	{
		$Info=array('table'=>$table,'filter'=>$filter);
		return json_encode($info);
	}
}