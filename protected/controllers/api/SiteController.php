<?php

class SiteController extends ApiController
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		echo $a;
		$this->json(array("a"));
	}

	public function actionLogin(){
		$this->json(array(
			'status'=>1,
			'token'=>'ASDFGHJ',
		));
	}

	public function actionError()
	{
		echo "error";
	    if($error=Yii::app()->errorHandler->error)
	        $this->render('error', $error);
	}
}