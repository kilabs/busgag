<?php

class SiteController extends ApiController
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->json(array("ok"));
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

	public function actionKategori(){
		$this->json(array(
			'status'=>1,
			'data'=>array(
				1=>'Kategori A',
				2=>'Kategori B',
				3=>'Kategori C',
				4=>'Kategori D',
				5=>'Kategori E',
			),
		));
	}

	public function actionUpload(){
		$post = new Post();
		$post->file = CUploadedFile::getInstanceByName('file');
		$post->attributes = $_POST;
		if($post->file)
			$post->namaFile = $post->file->getName();
		
		if($post->validate()){
			$post->save();
			$post->file->saveAs(Yii::app()->params['upload_path'].'/'.$post->id.'-'.$post->namaFile);
			$this->json(array('status'=>1));
		}
		else{
			$this->json(array('status'=>0,'errors'=>$post->getErrors()));
		}
	}
}