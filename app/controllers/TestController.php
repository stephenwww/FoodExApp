<?php

//require_once(app_path().'/filters/TestFilter.php');
//ClassLoader::addDirectories(array(app_path().'/filters'));

class TestController extends BaseController
{
	public function __construct() 
	{
		$this->beforeFilter('test_test');
	}

	public function getIndex()
	{
		return "Here is index for test controller";
	}

	public function filterRequest($route, $request)
	{

	}

	public function member_filter($route, $request)
	{
		return "member filter";
	}
}

?>

