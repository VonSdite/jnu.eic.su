<?php
/*
*
*/
class AdminAction extends Action
{
  //ʵ�������������ŵİ󶨣���ϯ�����ܲ��ŵİ�
  public function index()
  {
    session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$this->display();
	//ֻ�������Ĳ������ܷ��ʵ�
	$account=$_SESSION['account'];
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
	if($person_info['apartment']!=2 || $person_info['type']!=3)
	  $this->redirect('Home/index');
  }
}
?>