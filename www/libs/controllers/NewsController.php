<?php

class NewsController{
	
	public function actionAll()
	{
		/*
		$article = new NewsModelTest();
		$article->title = 'Привет!';
		$article->text = 'Привет Текст!';
		$article->insert();
		*/
		
		# var_dump($article->id);
		
		# var_dump(NewsModel::findOneByPk(2));
				
		# var_dump(isset($articel->title));
		# echo $article->id . "<br>\n";
		
		#echo 'OK';
		#die;
		
		$items = NewsModelTest::getAll();
		$view = new View();
		$view->assign('items',$items);
		$view->display('news/all.php');
		#include __DIR__.'/../views/news/all.php';
	}
	
	public function actionOne($id)
	{
		$paramId = new Params('id');
		$item = NewsController::findOneByPk($paramId->value);
		include __DIR__.'/../views/news/one.php';
	}
}
