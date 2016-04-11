<?php
class IndexController extends Controller 
{
	public function Index($params = array())
	{
		echo $this->templates->render('index::index'); 
	}
}

?>