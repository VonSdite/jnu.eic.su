<?php
/*
*������ҳ
*/
class HomeAction extends Action
{
  //��ҳ
  public function index()
  {
    session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$this->display();
  }
}
?>