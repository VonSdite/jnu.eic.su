<?php
//绩效考核控制器
class PerformAction extends Action
{
  //绩效考核首页
  public function index()
  {
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	
  $arr1=Array("秘书处","人力资源部","宣传部","信息编辑部","学术部","体育部","KSC联盟","组织部","文娱部","公关部","心理服务部","主席团");
  $arr2=Array("干事","人力干事","部长级","主席团");
	//账号，时间
	$account=$_SESSION['account'];
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
	$name=$person_info['name'];
	$apartment=$person_info['apartment'];
	$type=$person_info['type'];
	$position=$person_info['position'];
	$this->assign('account',$account);
	$this->assign('name',$name);
	$this->assign('apartment',$arr1[$apartment-1]);
	$this->assign('type',$arr2[$type-1]);
	$this->assign('position',$position);
    $this->display();
  }
  
  public function funcqqlx()
  {
 	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
	//var_dump($account);
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
	//var_dump($person_info);
	$type=$person_info['type'];
	$arr=Array("YBGS","RLGS","BZJ","ZXT");
	
	
	$typejson=$arr[$type-1];
	$data=Array(
	  'type'=>$typejson,
	);
    echo $this->_encode($data);
    //echo json_encode($arr2,JSON_UNESCAPED_UNICODE); 


  }
  /*测试编码转化
  public function changejson()
  {
    $data = array ('game' => 
	Array(
	  'ceshi'=>"我啊打开那就发啥",
	  'pj'=>Array(
	    'name'=>"你我的杰哥",
		'account'=>"忘记了",
	  ),
	),
    'name' => '刺之灵', 'country' => '冰霜国', 'level' => 45 ); 
	echo $this->_encode();
  }
  */
  //调用—_encode()函数，将数组进行编码转哈
   public  function _encode($arr)
  {
    $na = array();
    foreach ( $arr as $k => $value ) {  
      $na[$this->_urlencode($k)] = $this->_urlencode ($value);  
    }
    //return addcslashes(urldecode(json_encode($na)),"\\r");
	return urldecode(json_encode($na));
  }
   public function _urlencode($elem)
  {
    if(is_array($elem)){
    foreach($elem as $k=>$v){
      $na[$this->_urlencode($k)] = $this->_urlencode($v);
    }
    return $na;
  }
  return urlencode($elem);
  }
  //是否过了填表时间的判断
  public function check()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index');  
	//判断状态status,默认为0，表示不能编辑，当为1时则可以编辑
	$status=0;
	//获取当前时间
	$year=date("Y");
    //获取当前的月份，数字，1，或者23
    $month = date("n");
    $day=date("j");
    //20号到24号允许访问
	//获取数据库表tbl_authority,验证当前是否可写
	$auth_model=new Model("Authority");
	$auth_info=$auth_model->where("year=$year and month=$month")->find();
	if($auth_info['active']=='y'&& (20<=$day&&$day<=24))
	  $status=1;
	//根据传送过来的表的id，决定要生成那些数据返回
	$table_id=1;//$_GET['table_id'];
	switch($table_id)
	{
	  case "1":$table_info=$this->gszp($status);break;
	}
	$arr=Array('status'=>$status,);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
  }
  //干事自评表
  public function funcgszp()
  {
    
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status 	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	//$account="2013053165";
	//$year=date("Y");
	//$month = date("n");
	$year="2014";
	$month="4";
	//获取请求的时间
	//$year=$_GET['year'];
	//$month=$_GET['month'];
	//判断时间是否合理
	$gszp_model=new Model("Gszp");

	//获得类型，部门
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
	//var_dump($person_info);
	$type=$person_info['type'];
	//var_dump($type);
	$apartment=$person_info['apartment'];
	
    //除己之外干事
	$person_model=new Model("Person");
	$person_info=$person_model->where("apartment=$apartment and type=$type")->select();
    //var_dump($person_info);
	foreach($person_info as $v)
	{
	  if($v['account']!=$account)
	  {
	  $arr_TongShi[]= Array(
	    'name'=>$v['name'],
		'account'=>$v['account'],
	  );	  
	  }
	}

    //echo json_encode($arr_TongShi,JSON_UNESCAPED_UNICODE);
	//获取推优干事账号，名字，推优理由（该年该月，谁对谁）
	$interact_model=new Model('Interact');
	
	$interact_info=$interact_model->where("waccount=$account and rtype=$type")->find();
	if(!empty($interact_info['raccount']))
	{
	$tygs_account=$interact_info['raccount'];
	$tygs_tyly=$interact_info['text'];
	//var_dump($tygs_account);
	$person_info=$person_model->where("account=$tygs_account")->find();
	//var_dump($person_info);
	$tygs_name=$person_info['name'];
	}
	else
	{
	  $person_info=$person_model->where("account!=$account and (type=1 or type=2 ) and apartment=$apartment")->find();
	  $tygs_name=$person_info['name'];
	  $tygs_account=$person_info['account'];
	  $tygs_tyly="空";
	}
	//var_dump($tygs_name);
	$arr_tygs=Array(
	  'tygs'=>$tygs_name,
	  'account'=>$tygs_account,
	  'tyly'=>$tygs_tyly,
	);	
	//echo json_encode($arr_tygs,JSON_UNESCAPED_UNICODE);
	//获取部长级的姓名，账号，得分，评价
	$person_info=$person_model->where("apartment=$apartment and type!=$type")->select();
	//var_dump($person_info);
	foreach($person_info as $v)
	{
	  $bz_account=$v['account'];
	  $bz_name=$v['name'];
	  $interact_info=$interact_model->where("waccount=$account and raccount=$bz_account")->find();
	  if(!empty($interact_info['text']))
	    $bz_pj=$interact_info['text'];
      else 
	    $bz_pj="空";
	  if($interact_info['DF'])
	    $bz_df=$interact_info['DF'];
	  else
	    $bz_df=0;
	  $arr_DBZPJ[]=Array('account'=>$bz_account,'name'=>$bz_name,'fs'=>$bz_df,'pj'=>$bz_pj);
	}
	//echo json_encode($arr_DBZPJ,JSON_UNESCAPED_UNICODE);
	//按照当前账号找出干事自评表的信息
      $gszp_model=new Model("Gszp");
	$gszp_info=$gszp_model->where("account=$account")->find();
	    $status=$this->judgetext($gszp_info['zptext']);
	    //生成得分
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF1']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF2']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF3']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF4']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF5']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF6']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF7']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF8']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF9']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF10']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF11']),);
	    $arrDF[]=Array('df'=>$this->judgedf($gszp_info['DF12']),);
		$zongfen=$this->judgedf($gszp_info['total']);
		$zwpj=$this->judgetext($gszp_info['zptext']);

	//生成将要返回的json数组
	$arr=Array(
	  'status'=>$status,
	  'DF'=>$arrDF,
	  'zongfen'=>$zongfen,
	  'zwpj'=>$zwpj,	  
	  'TongShi'=>$arr_TongShi,
	  'TYGS'=>$arr_tygs,
	  'DBZPJ'=>$arr_DBZPJ,  
	);


    //var_dump($arr);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	

  }
  //得分可能是空的，因为初始化的不合理
  public function judgedf($DF)
  {
    if(empty($DF))
      $DF=0;
    return $DF;	
  }
  public function judgetext($text)
  {
    if(empty($text))
	  $text="空";
	return $text;
  }
  //干事考核表
  //暂时忽略部门特色这一节
  public function funcgskh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$waccount=$_SESSION['account'];
	//$year=date("Y");
	//$month = date("n");
	
	//获取请求的时间
	//$year=$_GET['year'];
	//$month=$_GET['month'];
	$year="2014";
	$month="14";
	//判断时间是否合理
	$gskh_model=new Model("Gskh");

	//获取部门，类型
	$person_model=new Model("Person");
	//echo $account;
	$person_info=$person_model->where("account=$waccount")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];
	$person_info=$person_model->where("apartment=$apartment and type!=$type")->select();
	//获取干事得分
	$interact_model=new Model("Interact");
	
	foreach($person_info as $v)
	{
	  $gs_account= $v['account']; 
	  $gs_name= $v['name'];
	  //$interact_info=$interact_model->where("(year=$year and month=$month) and (waccount=$account and raccount=$gs_account)")->find();
	  //echo $interact_info['waccount'].$interact_info['raccount'].$interact_info['text'].$interact_info['DF']."</br>";
	  $gskh_info=$gskh_model->where(" waccount=$waccount and raccount=$gs_account")->find();
	  $arrGSDF[]=Array('account'=>$gs_account,'name'=>$gs_name,
	    'df0'=>$gskh_info['DF1'],
		'df1'=>$gskh_info['DF2'],
		'df2'=>$gskh_info['DF3'],
		'df3'=>$gskh_info['DF4'],
		'df4'=>$gskh_info['DF5'],
		'df5'=>$gskh_info['DF6'],
		'df6'=>$gskh_info['DF7'],
		'df7'=>$gskh_info['DF8'],
		'df8'=>$gskh_info['DF9'],
		'df9'=>$gskh_info['DF10'],
		'df10'=>$gskh_info['DF11'],
		'df11'=>$gskh_info['DF12'],
		'df12'=>$gskh_info['DF13'],
		'df13'=>$gskh_info['DF14'],
		//忽略部门特色
	  );
	  //var_dump($arrGSDF);
	}
	//echo json_encode($arrGSDF,JSON_UNESCAPED_UNICODE);
	//对干事评价
	$person_info=$person_model->where("apartment=$apartment and type!=$type")->select();
    foreach($person_info as $v)
	{
	  $gs_account=$v['account'];
	  $gs_name=$v['name'];
	  $interact_info=$interact_model->where("waccount=$waccount and raccount=$gs_account")->find();
	  $arrDGSPJ[]=Array('account'=>$gs_account,'name'=>$gs_name,'pj'=>$interact_info['text'],
	  );
	}
	//部门特色
                   $strBMTS="<div id=\"bmts\">"
					+"<p><h3  style=\"text-align:center\">部门特色</h3></p>"
					+"<p>评价标准:</p>"
					+"<p>A.每次都很认真完成任务，并细心、有耐心地尽自己的职责，乐于接受任务</p>"          
					+"<p>B.会负责任地完成任务，工作效果良好</p>"
					+"<p>C.欠缺耐心，有时候不想完成任务，属于被动型</p>"
					+"<p>D.觉得团务很麻烦，完全不想完成任务，被催了才会去做</p>"
					+"</div>";
	//生成将要返回的json数组
	$arr=Array(
	  'status'=>$status,
	  'bmts'=>$strBMTS,
	  'arrGSDF'=>$arrGSDF,
	  'arrDGSPJ'=>$arrDGSPJ,
	  'apartment'=>$apartment,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);

  }
  //部长自评表
  public function funcbzzp()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$year=2014;//date("Y");
	$month = 4;//date("n");
	
	//获取请求的时间
	//$year=$_GET['year'];
	//$month=$_GET['month'];
	//判断时间是否合理
	$bzzp_model=new Model("Bzzp");
	//if($bzzp_info=$bzzp_model->where("year=$year and month=$month")->find())
		
	
	//获取部门，类型
	$person_model=new Model("Person");
	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];  
	//获取总分
	
	$interact_model=new Model("Interact");
	$bzzp_info=$bzzp_model->where("(year=$year and month=$month) and (waccount=$account)")->find();
    $zongfeng=$bzzp_info['total'];
	//获取得分数组
	$arrDF[]=Array('df'=>$bzzp_info['DF1'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF2'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF3'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF4'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF5'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF6'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF7'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF8'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF9'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF10'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF11'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF12'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF13'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF14'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF15'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF16'],);
	$arrDF[]=Array('df'=>$bzzp_info['DF17'],);
  //echo json_encode($arrDF,JSON_UNESCAPED_UNICODE);
  //获取自我评价
  $zwpj=$bzzp_info['zptext'];
  //echo $zwpj;
  //找出本部门其他部长
  $person_info=$person_model->where("(apartment=$apartment and type=$type) and account!=$account")->select();
  foreach($person_info as $v)
  {
    $ts_account=$v['account'];
	$ts_name=$v['name'];
    $interact_info=$interact_model->where("(year=$year and month=$month) and (waccount=$account and raccount=$ts_account)")->find();
    $arrDQTBZPJ[]=Array(
	  'name'=>$ts_name,
	  'account'=>$ts_account,
	  'fs'=>$interact_info['DF'],
	  'pj'=>$interact_info['text'],
	);
 }
 $DQTBZPJ=Array(
   'sum'=>count($person_info),
   'arrBZ'=>$arrDQTBZPJ,
 );


 //找出对主管副主席评价
 $president_model=new Model("President");
 $president_info=$president_model->where("apartment1=$apartment or apartment2=$apartment")->find();
 $zg_account=$president_info['account'];
 $interact_info=$interact_model->where("(year=$year and month=$month) and (waccount=$account and raccount=$zg_account) and nm=0")->find();
 $dzgfzxpj=$interact_info['text'];
 //对主席团成员的匿名评价
 $person_info=$person_model->where("type=4")->select();
 foreach($person_info as $v)
 {
   $raccount=$v['account'];
   $rname=$v['name'];
   $position=$v['position'];
   $interact_info=$interact_model->where("nm=1 and (waccount=$account and raccount=$raccount) and (year=$year and month=$month)")->find();
   //var_dump($interact_info);
   $pj=$interact_info['text'];
   $arrNMPJ[]=Array(
     'name'=>$rname,
	 'account'=>$raccount,
	 'depart'=>$position,
	 'pj'=>$pj,
   );
 }


 //生成将要返回的json数组
 $arr=Array(
   'year'=>$_GET['year'],
   'month'=>$_GET['month'],
   'zongfen'=>$zongfeng,
   'status'=>$status,
   'arrDF'=>$arrDF,
   'zwpj'=>$zwpj,
   'DQTBZPJ'=>$DQTBZPJ,
   'dzgfzxpj'=>$dzgfzxpj,
   'NMPJ'=>$arrNMPJ,
 );
// echo "阿迪斯发放";
 echo $this->_encode($arr);
 //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
 

  }
  //部长考核表（前段有质疑，暂时留着）
  public function funcbzkh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$year="2014";//date("Y");
	$month = "4";//date("n");
	//获取部门，类型
	$person_model=new Model("Person");
	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];   
	//判断是否为主席，还是副主席
	$president_model=new Model("President");
	$interact_model=new Model("Interact");
	$bzkh_model=new Model("Bzkh");
	$president_info=$president_model->where("account=$account")->find();
    $sub=$president_info['is_sub'];
	//如果是副主席，找到两个部门
	if($sub=='y')
	{
	  //记录部门数目
	  $bmsm=2;
	  $apartment1=$president_info['apartment1'];
	  $apartment2=$president_info['apartment2'];
	  //找到部门apartment1的部长信息
      $arrBZ=$this->getarrBZ($account,$apartment1);
	  //计算总共有多少个部长
	  $person_info=$person_model->where("apartment=$apartment1 and type='3'")->select();
	  $bzrs=count($person_info);
	  //echo json_encode($arrBZ,JSON_UNESCAPED_UNICODE);
	  //生成第一个部门信息
	  $arrBM[]=Array(
	    'bm'=>$apartment1,
		'bzrs'=>$bzrs,
		'arrBZ'=>$arrBZ,
	  );	  
	  //找到部门apartment2的部长信息
      $arrBZ=$this->getarrBZ($account,$apartment2);  
	  //生成第二个部门信息
	  //计算总共有多少个部长
	  $person_info=$person_model->where("apartment=$apartment2 and type='3'")->select();
	  $bzrs=count($person_info);	  
	  $arrBM[]=Array(
	    'bm'=>$apartment2,
		'bzrs'=>$bzrs,
		'arrBZ'=>$arrBZ,
	  );
	// echo json_encode($arrBM,JSON_UNESCAPED_UNICODE);
	}
	  
	else
	{
	 //记录部门数目
	 $bmsm=1;
	  //主席要负责总共11个部门的信息
	 $arrBZ=$this->getarrBZ($account,1);
	// 
	  $apartment1=$president_info['apartment1'];
	  $apartment2=$president_info['apartment2'];
	  if($apartment1==0)
	    $apartment=$apartment2;
	   else
	     $apartment=$apartment1;

	   //获取部长人数
	   $person_model=new Model("Person");
	   $person_info=$person_model->where("apartment=$apartment and type=3")->select();
	   $bzrs=count($person_info);
	   $arrBZ=$this->getarrBZ($account,$apartment);
	   $arrBM[]=Array(
	   'bm'=>$apartment,
	   'bzrs'=>$bzrs,
	   'arrBZ'=>$arrBZ, );  
	   };
	 //echo json_encode($arrBM,JSON_UNESCAPED_UNICODE);

	//跳出判断
	//生成将要返回的json数组
	$arr=Array(
      'status'=>$status,
	  'BMBZ'=>Array(
	  'bmsm'=>$bmsm,
	  'arrBM'=>$arrBM,
	  ),
	);
	echo $this->_encode($arr);
    //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	
  }
  //部门考核表
  public function funcbmkh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	//$year=date("Y");
	//$month = date("n");
	$year="2014";
	$month="4";
	//获取部门，类型
	$person_model=new Model("Person");	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];   
	//获取该主席所主管的部门信息
	$interact_model=new Model("Interact");
	$president_model=new Model("President");
	$bmkh_model=new Model("Bmkh");
	$bzty_model=new Model("Bzty");
	$president_info=$president_model->where("account=$account")->find();
	//如果是副主席，找到两个部门
	
	if($president_info['is_sub']=='y')
	{
	  $apartment1=$president_info['apartment1'];
	  $apartment2=$president_info['apartment2'];
	  $sum=2;
	  $arrBM[]=$this->getarrBM($account,$apartment1);
	  
	  //echo json_encode($arrBM,JSON_UNESCAPED_UNICODE);
	  $arrBM[]=$this->getarrBM($account,$apartment2);

	}
	else{
	  $sum=11;
	  /*
	  $apartment1=$president_info['apartment1'];
	  $apartment2=$president_info['apartment2'];
	  if($apartment1==0)
	    $apartment=$apartment2;
	  else 
	    $apartment=$apartment1;
		*/
	  for($i=1;$i<=11;$i++)
	  {
	    $arrBM[]=$this->getarrBM($account,$i);
	  }

	    //$arrBM[]=$this->getarrBM($account,$apartment);


	}
	//跳出判断
	  //推优部分
    //找出非主管的部门信息
	$president_info=$president_model->where("account=$account")->find();
	for($i=1;$i<=11;$i++)
	{
	  if($president_info['apartment1']==$i or $president_info['apartment2']==$i)
	    continue;
      $BuMen[]=Array(
	    'name'=>$i,
	  );		
	}
    //找到推优部门
	  //推优部分
	  $bmty_model=new Model("Bmty");
	  $bmty_info=$bmty_model->where("waccount=$account")->find();
	  $bm_account=$bmty_info['rapartment'];
	  if(!empty($bm_account)) {//$person_info=$person_model->where("account=$bz_account")->find();
	  //$bz_name=$person_info['name'];
      $TYBM=$bm_account;
	  }
	  else{
         $TYBM=$BuMen[0];
	  }
	//生成将要返回的json数组
	$arr=Array(
	  'status'=>$status,
	  'BM'=>Array(
	    'sum'=>$sum,
	    'arrBM'=>$arrBM,),
		//'BuZhang'=>$BuZhang,
		'BuMen'=>$BuMen,
		'TYBM'=>$TYBM,
		
		
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	
  }

  //跟进部门出勤统计表
  public function funcgjbmcqtj()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$year=date("Y");
	$month = date("n");
	//获取部门，类型
	$person_model=new Model("Person");	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];  
    $chuqin_model=new Model("Chuqin");
    $chuqin_info=$chuqin_model->where("waccount=$account and (year=$year and month=$month)")->select();	
    $renshu=count($chuqin_info);
	foreach($chuqin_info as $v)
	{
	  $gjbm=$v['rapartment'];
	  $raccount=$v['raccount'];
	  $person_info=$person_model->where("account=$raccount")->find();
	  $rname=$person_info['name'];
	  $arrchuqin[]=Array(
	    'name'=>$rname,
		'account'=>$raccount,
		'qj'=>$v['qj'],
		'ct'=>$v['ct'],
		'qx'=>$v['qx'],
	  );
	}
	//生成将要返回的json数组
	$arr=Array(
	  'gjbm'=>$gjbm,
	  'renshu'=>$renshu,
	  'status'=>$status,
	  'chuqin'=>$arrchuqin,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	
  }
  //调研意见采纳表
  public function funcdyyjcn()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$year=date("Y");
	$month = date("n");
	//获取部门，类型
	$person_model=new Model("Person");	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];  
    $diaoyan_model=new Model("Diaoyan");
    $diaoyan_info=$diaoyan_model->where("year=$year and month=$month")->select();
    $bmsm=11;
    for($i=1;$i<=2;$i++)
    {
	  $person_info=$person_model->where("apartment=$i")->select();
	  $bmrs=count($person_info);
      $arrBM[]=Array(
	    'bmmz'=>$i,
		'bmrs'=>$bmrs,
		'arrCNJF'=>$this->getcnjf($i,$year,$month),
	  );	
	
	}
	//生成将要返回的json数组
	$arr=Array(
	  'status'=>$status,
	  'bmsm'=>11,
	  'arrBM'=>$arrBM,
	);
	echo $this->_encode($arr);
    //echo json_encode($arr,JSON_UNESCAPED_UNICODE);    
  }
  //优秀部长评定表
  public function funcyxbz()
  {

 	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
  /*	$year=date("Y");
	$month = date("n");
	//获取部门，类型
	$person_model=new Model("Person");	//echo $account;
	$person_info=$person_model->where("account=$account")->find();
	$type=$person_info['type'];
	$apartment=$person_info['apartment'];  
    //获取所有部长排名第一的
	$bzfk_model=new Model("Bzfk");
	$rank=1;
    $person_info=$bzfk_model->where("rank=$rank")->select();
    $sum=count($person_info);
    foreach($person_info as $v)
    {
	  $arrYXBZPDlist[]=$this->getyxbz($v['account'],$year,$month);
	}	
	// 
	*/
	$year="2014";
	$month="4";
	//从tbl_yxbzhx中找出十个候选人
	$yxbzhx_model=new Model("Yxbzhx");
	$yxbz_model=new Model("Yxbz");
	$person_model=new Model("Person");
	$bzfk_model=new Model("Bzfk");
	$yxbzhx_info=$yxbzhx_model->select();
	foreach($yxbzhx_info as $hx_v)
	{
	  $bz_account=$hx_v['HX'];
	  //判断是否为勾选状态
	  //echo $account."dgh";
	  //echo "asd".$bz_account;
	  $checked=0;
	  $yxbz_info=$yxbz_model->where("waccount=$account and raccount=$bz_account")->find();
	     //echo "adsf";
	  

          $checked=$yxbz_info['checked'];

	  $person_info=$person_model->where("account=$bz_account")->find();
	  //echo $bz_account."部门:".$person_info['apartment'].",checked:".$checked."</br>";
	  $name=$person_info['name'];
	  $depart=$person_info['apartment'];
	  $bzfk_info=$bzfk_model->where("account=$bz_account")->find();
	  $score=$bzfk_info['total'];
	  //确定该分数在所有候选人中的排名
	  $j=0;
	  $yxbzhx_info2=$yxbzhx_model->select();
	  foreach($yxbzhx_info2 as $hx_v2)
	  {
	    if($bz_account==$hx_v2['HX'])
		  continue;
		$bz_account2=$hx_v2['HX'];
		 $bzfk_info2=$bzfk_model->where("account=$bz_account2")->find();
	     if($score<$bzfk_info2['total'])
	     {
	       $j++;
	     }
	     if($score==$bzfk_info2['total'])
	     {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
	       //echo $account1."比较：".$account2."结果：".strcmp($account1,$account2)."</br>";
           if(strcmp($bz_account,$bz_account2)>0)//学号小的排在前面	
             $j++;		 
	     }
	  }
	  //echo $bz_account."排名是：".$j."</br>";
	  $arrYXBZPDlist[$j]=Array(
	    'name'=>$name,
	    'account'=>$bz_account,
		'Checked'=>$checked,
		'depart'=>$depart,
		'score'=>$score,
	  );
	}
	for($k=0;$k<count($arrYXBZPDlist);$k++)
	{
	  $arrYXBZPDlist2[]=$arrYXBZPDlist[$k];
	}
	/*
	$arrYXBZPDlist=Array(
	  Array(
	    'name'=>"天王盖地虎",
		'account'=>"2012052308",
		'Checked'=>1,
		'depart'=>1,
		'score'=>10,
	  ),
	  Array(
	    'name'=>"天王",
		'account'=>"2012052308",
		'Checked'=>1,
		'depart'=>1,
		'score'=>10,	  
	  ),
	  Array(
	    'name'=>"天王",
		'account'=>"2012052308",
		'Checked'=>1,
		'depart'=>1,
		'score'=>10,	  
	  ),
	  Array(
	    'name'=>"天王",
		'account'=>"2012052308",
		'Checked'=>1,
		'depart'=>1,
		'score'=>10,	  
	  ),
	);
	*/
	//生成将要返回的json数组
	$arr=Array(
	  'status'=>$status,
	  'arrYXBZPDlist'=>$arrYXBZPDlist2,
	
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE); 
  }
  
  //函数，判断只读状态还是读写状态
  public function getStatus()
  {
  /*
	//判断状态status,默认为1，表示不能编辑，当为0时则可以编辑
	$status=1;
	//获取当前时间
	$year="2014";//date("Y");
    //获取当前的月份，数字，1，或者23
    $month = "4";//date("n");
    //$day=date("j");
    //20号到24号允许访问
	//获取数据库表tbl_authority,验证当前是否可写
	$auth_model=new Model("Authority");
	$auth_info=$auth_model->where("year=$year and month=$month")->find();
	if(!empty($auth_info))
	{
	if($auth_info['active']=='y')//&& //(20<=$day&&$day<=30))
	  $status=0;
	}
	*/
	$status=0;
	return $status;
  }
  //在部长考核表中，需要根据主席团的 account,主管的部门 apartment,来生成arrBZ,
  //由于数量巨多，采用函数的方式解决
  public function getarrBZ($account,$apartment)
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	//$year=date("Y");
	//$month = date("n");
	$year="2014";
	$month="4";
      //找到该本门部长
	  $person_model=new Model("Person");
	  $bzkh_model=new Model("Bzkh");
	  $person_info=$person_model->where("apartment=$apartment and type=3")->select();
	  foreach($person_info as $v)
	  {

	    $bz_account=$v['account'];
	    $bz_name=$v['name'];
	    $bzkh_info=$bzkh_model->where("(year=$year and month=$month) and (raccount=$bz_account)")->find();
	    //生成评价
		$interact_model=new Model("Interact");
		$interact_info=$interact_model->where("waccount=$account and raccount=$bz_account")->find();
		$arrBZ[]=Array(
		  'account'=>$bz_account,
		  'bzmz'=>$bz_name,
		  'pj'=>$interact_info['text'],
		  'df0'=>$bzkh_info['DF1'],
		  'df1'=>$bzkh_info['DF2'],
		  'df2'=>$bzkh_info['DF3'],
		  'df3'=>$bzkh_info['DF4'],
		  'df4'=>$bzkh_info['DF5'],
		  'df5'=>$bzkh_info['DF6'],
		  'df6'=>$bzkh_info['DF7'],
		  'df7'=>$bzkh_info['DF8'],
		  'df8'=>$bzkh_info['DF9'],
		  'df9'=>$bzkh_info['DF10'],
		  'df10'=>$bzkh_info['DF11'],
		  'df11'=>$bzkh_info['DF12'],
		  'df12'=>$bzkh_info['DF13'],
		  'df13'=>$bzkh_info['DF14'],
		  'df14'=>$bzkh_info['DF15'],
		);
	  }    
	  return $arrBZ;
  }  
  //在部门考核表中，需要根据主席团的 account,主管的部门 apartment,来生成arrBZ,
  //由于数量巨多，采用函数的方式解决
  public function getarrBM($account,$apartment)
  {
    //$account='2012052311';
	//$apartment=1;
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$year="2014";//date("Y");
	$month = "4";//date("n");
	$bmkh_model=new Model("Bmkh");
	$bmkh_info=$bmkh_model->where("(year=$year and month=$month) and (waccount=$account and rapartment=$apartment)")->find();
	$oneway_model=new Model("Oneway");
	$oneway_info=$oneway_model->where("(year=$year and month=$month) and (waccount=$account and rapartment=$apartment)")->find();
	$BM=Array(
	  'bm'=>$apartment,
	  'pj'=>$oneway_info['text'],
	  'df0'=>$bmkh_info['DF1'],
	  'df1'=>$bmkh_info['DF2'],
	  'df2'=>$bmkh_info['DF3'],
	  'df3'=>$bmkh_info['DF4'],
	  'df4'=>$bmkh_info['DF5'],
	  'df5'=>$bmkh_info['DF6'],
	  'df6'=>$bmkh_info['DF7'],
	);
	//echo json_encode($BM,JSON_UNESCAPED_UNICODE);
	return $BM;
  }
  //在调研意见采纳表中，需要根据传过来的apartment,来生成对应信息
  public function getcnjf($apartment,$year,$month)
  {
    $diaoyan_model=new Model("Diaoyan");
	$person_model=new Model("Person");
	$diaoyan_info=$diaoyan_model->where("(year=$year and month=$month) and rapartment=$apartment")->select();
    foreach($diaoyan_info as $v)
	{
	  $raccount=$v['raccount'];
	  $person_info=$person_model->where("account=$raccount")->find();
	  $rname=$person_info['name'];
	  $jiafen=$v['caina'];
	  $arrCNJF[]=Array(
	    'account'=>$raccount,
		'name'=>$rname,
		'jiafen'=>$jiafen,
	  );
	}
	//echo json_encode($arrCNJF,JSON_UNESCAPED_UNICODE);
	return $arrCNJF;
  }
  //在优秀部长评定表，需要根据传过来的部长account,生成对应信息
  public function getyxbz($raccount,$year,$month)
  {
 	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    //获取授权状态 status	  
	$status=$this->getStatus();
	//账号，时间
	$account=$_SESSION['account'];
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$raccount")->find();
	$rname=$person_info['name'];
	$apartment=$person_info['apartment'];
	$bzfk_model=new Model("Bzfk");
	$bzfk_info=$bzfk_model->where("account=$raccount")->find();
	$total=$bzfk_info['total'];
	$yxbz_model=new Model("Yxbz");
	$yxbz_info=$yxbz_model->where("waccount=$account and raccount=$raccount")->find();
    $arrBZ=Array(
	  'account'=>$raccount,
	  'name'=>$rname,
	  'depart'=>$apartment,
	  'checked'=>$yxbz_info['checked'],
	  'score'=>$total,
	); 
	return $arrBZ;
 }
 //等上面的表都填完了之后，接下来要进行的就是生成反馈表
 //反馈的内容计算出来后用数据库表存着
 //反馈需要有事件来驱动
 
 //自评后，反馈前，需要各种加分扣分，这次直接跑程序，回头再对接
 public function funcjfkf()
 {
   $year="2014";
   $month="4";
   //出勤扣分
   //秘书处
   $this->funcchuqin("2013053193",1,1,0,0);
   $this->funcchuqin("2013053089",1,1,0,0);
   //人力
   $this->funcchuqin("2013053062",2,1,0,0);
   $this->funcchuqin("2013053146",2,1,0,0);
   //宣传部
   $this->funcchuqin("2013052977",3,1,0,0);
   //信编
   $this->funcchuqin("2013053195",4,1,0,0);
   $this->funcchuqin("2013053166",4,1,0,0);
   $this->funcchuqin("2013053235",4,0,1,0);
   $this->funcchuqin("2013053054",4,0,1,0);
   $this->funcchuqin("2013053035",4,0,1,0);
   $this->funcchuqin("2013053053",4,0,1,0);
   $this->funcchuqin("2013052960",4,0,1,0);
   //学术部
   $this->funcchuqin("2013052983",4,0,0,1);
   $this->funcchuqin("2013053024",4,0,1,0);
   //体育部
   //KSC联盟
   $this->funcchuqin("2013053125",7,1,0,0);
   $this->funcchuqin("2013052991",7,0,1,0);
   //组织部
   $this->funcchuqin("2012052194",8,1,0,0);
   $this->funcchuqin("2013053143",8,1,0,1);
   $this->funcchuqin("2013053002",8,1,1,0);
   $this->funcchuqin("2013053215",8,0,1,0);
   $this->funcchuqin("2013053245",8,0,1,0);
   $this->funcchuqin("2013053206",8,1,0,0);
   //文娱部
   $this->funcchuqin("2013053010",9,0,1,0);
   //公关部
   //心理服务部
   $this->funcchuqin("2013053008",11,0,1,0);
   $this->funcchuqin("2013052993",11,0,2,0);
   //外调加分
   //秘书处
   $this->funcresource("2012052297",2);
   $this->funcresource("2013053193",4);
   $this->funcresource("2013053122",2);
   $this->funcresource("2013053068",4);
   $this->funcresource("2013053176",2);
   $this->funcresource("2013053064",2);
   $this->funcresource("2013053089",1);
   $this->funcresource("2013053106",2);
   $this->funcresource("2013052949",4);
   //人力资源部
   $this->funcresource("2012052339",1);
   $this->funcresource("2013053175",1);
   $this->funcresource("2013053188",3);
   $this->funcresource("2013053189",2);
   $this->funcresource("2013053092",2);
   $this->funcresource("2013053219",3);
   $this->funcresource("2013053162",3);
   $this->funcresource("2013053015",2);
   $this->funcresource("2013053207",4);
   $this->funcresource("2013053241",3);
   //宣传部
   $this->funcresource("2012052201",1);
   $this->funcresource("2012052245",1);
   $this->funcresource("2013053101",1);
   $this->funcresource("2013052974",1);
   $this->funcresource("2013053004",1);
   $this->funcresource("2013053187",1);
   $this->funcresource("2013052958",1);
   $this->funcresource("2013053007",1);
   $this->funcresource("2013053218",2);
   $this->funcresource("2013053005",1);
   $this->funcresource("2013053067",1);
   $this->funcresource("2013053249",3);
   $this->funcresource("2013052987",1);
   $this->funcresource("2013052966",1);
   $this->funcresource("2013053071",1);
   //信编部
   $this->funcresource("2013052952",4);
   $this->funcresource("2013053166",2);
   $this->funcresource("2013053136",3);
   $this->funcresource("2013053195",2);
   $this->funcresource("2013053054",3);
   $this->funcresource("2013053035",2);
   $this->funcresource("2013053053",2);
   $this->funcresource("2013053013",3);//该账号有五分
   $this->funcresource("2013053013",2);
   $this->funcresource("2013052960",2);
   //学术部
   $this->funcresource("2012052377",1);
   $this->funcresource("2013053167",1);
   $this->funcresource("2013053202",2);
   $this->funcresource("2013053065",1);
   $this->funcresource("2013053034",1);
   $this->funcresource("2013052983",2);
   $this->funcresource("2013053024",2);
   //体育部
   $this->funcresource("2013052950",1);
   $this->funcresource("2013053123",1);
   $this->funcresource("2013053088",2);
   $this->funcresource("2013055027",1);
   $this->funcresource("2013052970",1);
   $this->funcresource("2013052393",2);
   $this->funcresource("2013053134",1);
   $this->funcresource("2013053095",2);
   $this->funcresource("2013053171",1);
   //KSC联盟
   $this->funcresource("2012052275",2);
   $this->funcresource("2013053220",1);
   $this->funcresource("2013053026",1);
   $this->funcresource("2013052992",2);
   $this->funcresource("2013053181",1);
   $this->funcresource("2013053158",3);
   $this->funcresource("2013053020",1);
   //组织部
   $this->funcresource("2012052194",1);
   $this->funcresource("2013053017",2);
   $this->funcresource("2013053228",1);
   $this->funcresource("2013053245",1);
   $this->funcresource("2013053143",2);
   $this->funcresource("2013053215",2);
   $this->funcresource("2013053087",1);
   $this->funcresource("2013053002",1);
   //文娱部
   $this->funcresource("2012052364",1);
   $this->funcresource("2013053151",1);
   $this->funcresource("2013053232",2);
   $this->funcresource("2013053010",3);
   $this->funcresource("2013052986",1);
   $this->funcresource("2013053238",1);
   $this->funcresource("2013053059",1);
   //公关部
   $this->funcresource("2012052338",1);
   $this->funcresource("2013053111",2);
   $this->funcresource("2013053047",2);
   $this->funcresource("2013053240",2);
   $this->funcresource("2013053211",2);
   $this->funcresource("2013053223",1);
   $this->funcresource("2013053082",3);
   $this->funcresource("2013053119",1);
   $this->funcresource("2013053047",2);
   //心理服务部
   $this->funcresource("2012052294",1);
   $this->funcresource("2013053174",3);
   $this->funcresource("2013052297",2);
   $this->funcresource("2013052993",1);
   $this->funcresource("2013053155",1);
   $this->funcresource("2013053160",1);
   $this->funcresource("2013053165",1);
   //调研意见采纳加分
   $this->funcdiaoyan("2013052952",4,1);
   $this->funcdiaoyan("2012052275",7,2);
   $this->funcdiaoyan("2013052958",3,1);
   $this->funcdiaoyan("2013053165",11,1);
   
 }
 //出勤扣分函数
 public function funcchuqin($raccount,$rapartment,$qj,$ct,$qx)
 { 
    $chuqin_model=new Model("Chuqin");
    $year="2014";
	$month="4";
    $data['year']=$year;
	$data['month']=$month;
	$data['raccount']=$raccount;
	$data['rapartment']=$rapartment;
	$data['qj']=$qj;
	$data['ct']=$ct;
	$data['qx']=$qx;
	$chuqin_model->add($data);
 }
 //外调加分函数
 public function funcresource($account,$time)
 {
   for($i=1;$i<=$time;$i++)
   {
     $resource_model=new Model("Resource");
     $year="2014";
     $month="4";
     $data['year']=$year;
     $data['month']=$month;
     $data['account']=$account;
     $data['assess']=3;
     $resource_model->add($data);
   }
 }
 //反馈加分函数
 public function funcdiaoyan($raccount,$rapartment,$caina)
 {
   $diaoyan_model=new Model("Diaoyan");
   $year="2014";
   $month="4";
   $data['year']=$year;
   $data['month']=$month;
   $data['raccount']=$raccount;
   $data['rapartment']=$rapartment;
   $data['caina']=$caina;
   $diaoyan_model->add($data);
 }
 //一键反馈第一步：生成总分和排名
 //本地跑的时候速度非常的慢，所以分成几部分来跑
 //第一步之干事部分
 public function funcfkonegs()
 {
	$year="2014";
	$month="4";
   //获取所有干事
    $yxchxz_model=new Model("Yxchxz");
   $person_model=new Model("Person");
   $gsfk_model=new Model("Gsfk");

   $person_info=$person_model->where("type=1 or type=2")->select();
   //计算总分
   foreach($person_info as $v)
   {
     $waccount=$v['account'];
	 //echo $wname=$v['name'];
	 //干事考核反馈表
     $this->getgsfk($waccount,$year,$month);
   }
   //规矩改了，排名是部门内的
   for($j=1;$j<=11;$j++)
   {
     $person_info=$person_model->where("apartment=$j and (type=1 or type=2)")->select();
     $person_info2=$person_model->where("apartment=$j and (type=1 or type=2)")->select();
     //将欠缺的干事排名，优秀干事补上
     foreach($person_info as $v)
     {
       $rank=1;
       $account1=$v['account'];
	   $gsfk_info=$gsfk_model->where("(year=$year and month=$month) and (account=$account1)")->find();
	   $total1=$gsfk_info['total'];
	   //echo "tz:".$total1."</br>";
       foreach($person_info2 as $v2)
	   {
	     if($v2['account']==$account1)
	       continue;
	     $account2=$v2['account'];
   	     $gsfk_info2=$gsfk_model->where("(year=$year and month=$month) and (account=$account2)")->find();
	     $total2=$gsfk_info2['total'];
	     if($total1<$total2)
	     {
	       $rank++;
	     }
	     if($total1==$total2)
	     {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
	       //echo $account1."比较：".$account2."结果：".strcmp($account1,$account2)."</br>";
           if(strcmp($account1,$account2)>0)//学号小的排在前面	
             $rank++;		 
	     }
	     //echo $account1.":".$total1."比较".$account2.":".$total2."</br>";
	   }
	   //echo $account1."总分：".$total1."排名:".$rank."</br>";
	   $data['rank']=$rank;
	   $gsfk_model->where("(year=$year and month=$month) and account=$account1")->data($data)->save();
	 }
   }
   unset($data);
 
   //根据排名确定每个部门的优秀干事
   $gsfk_model=new Model("Gsfk");
   for($i=1;$i<=11;$i++)
   {
     //$person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	 $flag=1;//跳出标志
	 $j=1;//从排名第一的开始算起
	 
	 while($flag)
	 {
	   $gsfk_info=$gsfk_model->where("rank=$j")->select();
	   foreach($gsfk_info as $v)
	   {
	     $gs_account=$v['account'];
	     $person_info=$person_model->where("account=$gs_account")->find();
		 if($person_info['apartment']==$i)
		   break;
	   }
	   echo "部门".$i."的排名第".$j."的干事是：".$gs_account."</br>";
	   //$gs_account=$gsfk_info['account'];
	   $yxchxz_info=$yxchxz_model->where("account=$gs_account")->find();
	   if(empty($yxchxz_info))
	   {
	     echo $gs_account."没有被限制了</br>";
	     unset($data);
		 $data['yxgs']=1;
		 $gsfk_model->where("account=$gs_account")->data($data)->save();
	     $flag=0;
	   }
	   else{
	     echo $gs_account."被限制了"; 
	   }
	   $j++;
	   $person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	   if($j>count($person_info))
	     $flag=0;
	 }
	 //echo "部门".$i."的优秀干事是：".$gs_account."</br>";
    
   }


 
 }
 //第一步之部长部分
 public function funcfkonebz()
 {
   $year="2014";
   $month="4";
  //部长反馈表
   $person_model=new Model("Person");
   $bzfk_model=new Model("Bzfk");
   $person_info=$person_model->where("type=3")->select();
   foreach($person_info as $v)
   {
     $this->getbzfk($v['account'],$year,$month);
   }
   
   //规矩改了，排名是内部的
   for($j=1;$j<=11;$j++)
   {
     $person_info=$person_model->where("type=3 and apartment=$j")->select();
     $person_info2=$person_model->where("type=3 and apartment=$j")->select();
     //将欠缺的部长排名补上
     foreach($person_info as $v)
     {
       $rank=1;
       $account1=$v['account'];
	   $bzfk_info=$bzfk_model->where("(year=$year and month=$month) and (account=$account1)")->find();
	   $total1=$bzfk_info['total'];
	   //echo "tz:".$total1."</br>";
       foreach($person_info2 as $v2)
	   {
	     if($v2['account']==$account1)
	       continue;
	     $account2=$v2['account'];
	     $bzfk_info2=$bzfk_model->where("(year=$year and month=$month) and (account=$account2)")->find();
	     $total2=$bzfk_info2['total'];
	     if($total1<$total2)
	     {
	       $rank++;
	     }
	     if($total1==$total2)
	     {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
	       //echo $account1."比较：".$account2."结果：".strcmp($account1,$account2)."</br>";
           if(strcmp($account1,$account2)>0)//学号小的排在前面	
             $rank++;		 
	    }
	     //echo $account1.":".$total1."比较".$account2.":".$total2."</br>";
	   }
	   //echo $account1."总分：".$total1."排名:".$rank."</br>";
	   $data['rank']=$rank;
	   $bzfk_model->where("(year=$year and month=$month) and account=$account1")->data($data)->save();
	 }	  
    }   

 }
 public function funcfkone()
 {
	//$year=date("Y");
	//$month = date("n");

 	//错误，优秀部长必须得主席团评定的才行
	/*
      unset($data);
	  //确定优秀部长，一共有三人
	  $flag=1;//人数标志
	  $j=1;
	  while($flag<=3)
	  {
	    //依据前面的排名
		$bzfk_info=$bzfk_model->where("rank=$j")->find();
		$bz_account=$bzfk['account'];
		//不要出现在限制中
		$yxchxz_info=$yxchxz_model->where("account=$bz_account")->find();
		if(empty($yxchxz_info))
		{
		  $flag++;
		  unset($data);
		  $data['yxbz']=1;
		  $bzfk_model->where("account=$bz_account")->data($data)->save();
		}
		$j++;
	  }
	  */
      //确定优秀部长
	 /* 
      for($i=1;$i<=11;$i++)
      {
        $person_info=$person_model->where("apartment=$i and type=3")->select();
	    foreach($person_info as $v)
	    {
		  //echo "当前：".$v['account']."</br>";
	      $bz_account=$v['account'];
	      $bzfk_info=$bzfk_model->where("(year=$year and month=$month) and account=$bz_account")->find();
	      if($bzfk_info['rank']==1)
	      {
	        //echo "找到了，".$bz_account."排名第一</br>";
	        $data['yxbz']=1;
		    $bzfk_model->where("(year=$year and month=$month) and account=$bz_account")->data($data)->save();
		    break; 
	       }
	   
	    }
      }
	  */
	  /*
   //部门反馈表
   $bmfk_model=new Model("Bmfk");
   for($i=1;$i<=11;$i++)
   {
     $this->getbmfk($i,$year,$month);
   }
   //对部门进行排名及确定优秀部门
	 for($k=1;$k<=11;$k++)
     {
       $rank=1;
       $account1=$k;
	   $bmfk_info=$bmfk_model->where("apartment=$account1")->find();
	   $total1=$bmfk_info['total'];
	   for($j=1;$j<=11;$j++)
	   {
	     if($j==$k)
	       continue;
	     $account2=$j;
	     $bmfk_info2=$bmfk_model->where("apartment=$account2")->find();
	     $total2=$bmfk_info2['total'];
	     if($total1<$total2)
	     {
	       $rank++;
	     }
	     if($total1==$total2)
	     {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
	       //echo $account1."比较：".$account2."结果：".strcmp($account1,$account2)."</br>";
           if(strcmp($account1,$account2)>0)//学号小的排在前面	
             $rank++;		 
	     }
	     //echo $account1.":".$total1."比较".$account2.":".$total2."</br>";
	   }
	   //将遍历了一轮的rank存起来
	   $data['rank']=$rank;
	   $bmfk_model->where("apartment=$k")->data($data)->save();
	   unset($data);
	   //echo $account1."总分：".$total1."排名:".$rank."</br>";
	 }
	   unset($data);
	   //$data['rank']=$rank;
	   $bmfk_info=$bmfk_model->where("rank=1")->find();
	   $apartment=$bmfk_info['apartment'];
	   $data['yxbm']=1;
	   $bmfk_model->where("apartment=$apartment")->data($data)->save();	
	   unset($data);
	   //$data['rank']=$rank;
	   $bmfk_info=$bmfk_model->where("rank=2")->find();
	   $apartment=$bmfk_info['apartment'];
	   $data['yxbm']=1;
	   $bmfk_model->where("apartment=$apartment")->data($data)->save();		   
     

   //整理出所有成员的外调次数
   $wdcs_model=new Model("Wdcs");
   $resource_model=new Model("Resource");
   $person_info=$person_model->where("type!=4")->select();
   foreach($person_info as $v)  
   { 
     $raccount=$v['account'];
	 $resource_info=$resource_model->where("account=$raccount")->select();
	 $sum=count($resource_info);
     if(empty($resource_info))
	   $sum=0;
	 $data['account']=$raccount;
	 $data['wdcs']=$sum;
	 if($wdcs_model->add($data))
	   echo "wcdc添加成功";
	 unset($data);
   }
   //对本部门外调次数进行排名
   for($j=1;$j<=11;$j++)
   {
     $person_info=$person_model->where("apartment=$j and (type=1 or type=2)")->select();
     $person_info2=$person_model->where("apartment=$j and (type=1 or type=2)")->select();
     //将欠缺的干事排名，优秀干事补上
     foreach($person_info as $v)
     {
       $rank=1;
       $account1=$v['account'];
	   //$gsfk_info=$gsfk_model->where("(year=$year and month=$month) and (account=$account1)")->find();
	   //$total1=$gsfk_info['total'];
	   $wdcs_info=$wdcs_model->where("account=$account1")->find();
	   $wdcs1=$wdcs_info['wdcs'];
	   //echo "tz:".$total1."</br>";
       foreach($person_info2 as $v2)
	   {
	     if($v2['account']==$account1)
	       continue;
	     $account2=$v2['account'];
   	     //$gsfk_info2=$gsfk_model->where("(year=$year and month=$month) and (account=$account2)")->find();
	     //$total2=$gsfk_info2['total'];
	     $wdcs_info2=$wdcs_model->where("account=$account2")->find();
	     $wdcs2=$wdcs_info['wdcs'];
	     if($wdcs1<$wdcs2)
	     {
	       $rank++;
	     }
	     if($total1==$total2)
	     {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
	       //echo $account1."比较：".$account2."结果：".strcmp($account1,$account2)."</br>";
           if(strcmp($account1,$account2)>0)//学号小的排在前面	
             $rank++;		 
	     }
	     //echo $account1.":".$total1."比较".$account2.":".$total2."</br>";
	   }
	   //echo $account1."总分：".$total1."排名:".$rank."</br>";
	   $data['rank']=$rank;
	   $wdcs_model->where("account=$account1")->data($data)->save();
	 }
   }
   
   //将当前每个部门中排名第一的部长存入tbl_yxbz中，以供后用
   unset($data);
   $yxbz_model=new Model("Yxbz");
   $president_model=new Model("President");
   $president_info=$president_model->select();
   foreach($president_info as $v)
   {
     $zx_account=$v['account'];
     $bzfk_info=$bzfk_model->where("rank=1")->select();
	 foreach($bzfk_info as $v2)
	 {
	   $data['waccount']=$zx_account;
	   $data['raccount']=$v2['account'];
	   $data['year']=$year;
	   $data['month']=$month;
	   if($yxbz_model->add($data))
	     echo "tbl_yxbz添加成功";
	   unset($data);
	 }
   }
   */
 }
 //一键反馈第二步：生成优秀部长候选名单
 public function funcfktwo()
 {
   $year="2014";
   $month="4";
   $person_model=new Model("Person");
   $bzfk_model=new Model("Bzfk");
   $yxchxz_model=new Model("Yxchxz");
   $yxbzhx_model=new Model("Yxbzhx");
   
   
   //总共有11个部门
   for($i=1;$i<=11;$i++)
   {
       unset($candidate);
       $rank=1;
       $flag=1;//跳出循环标志
	   //找出该部门排名$rank的部长
	   while($flag)
     {	   
	   $person_info=$person_model->where("apartment=$i and type=3")->select();
	   $bz_sum=count($person_info);
	   foreach($person_info as $person_v)
	   {
		 $bzfk_info=$bzfk_model->where("rank=$rank")->select();
	     foreach($bzfk_info as $bzfk_v)
	     {
		   if($bzfk_v['account']==$person_v['account']){
		     $bz_account=$person_v['account'];break;}
         }			 
         
       }
	   //判断是否出现在限制名单中
	   $yxchxz_info=$yxchxz_model->where("account=$bz_account")->find();
	   if(empty($yxchxz_info))
	   {
	     $candidate=$bz_account;
		 $flag=0;
	   }
	   $rank++;
	   if($rank>$bz_sum)
	     $flag=0;
     }
     //如果$candidate部位空，说明该部门有优秀部长候选人
     //找到该部门符合条件的候选人并插入数据库表 tbl_yxbzhx;
	 $yxbzhx_model=new Model("Yxbzhx");
	 if(!empty($candidate))
	 {
	    echo "部门".$i."的优秀部长候选人是：".$candidate."</br>";
		unset($data);
		$data['year']=$year;
		$data['month']=$month;
		$data['HX']=$candidate;
		$yxbzhx_model->add($data);
	 }
   }
 }
 //一键反馈第三步，根据主席团的评优结果，生成最终的优秀部长
 public function funcfkthree()
 {
   //从tbl_yxbzhx中找出十个候选人,从tbl_yxbz中统计所有主席团的评优结果
   $yxbzhx_model=new Model("Yxbzhx");
   $yxbz_model=new Model("Yxbz");
   $bzfk_model=new Model("Bzfk");
   $yxbzhx_info=$yxbzhx_model->select();
   foreach($yxbzhx_info as $v_hx)
   {
     $bz_account=$v_hx['HX'];
	 $yxbz_info=$yxbz_model->where("raccount=$bz_account and checked=1")->select();
	 echo $bz_account."被评优了：".count($yxbz_info)."次</br>";
	 //将各个候选人的得票存起来
     //$arr=Array(
	   $arr[$bz_account]=count($yxbz_info);
	   //'total'=>count($yxbz_info),
	//);
	 
   }
   arsort($arr);
   //var_dump($arr);
   //将学号、票数、考核分数、综合排名合为一体
   foreach($arr as $k=>$v)
   {
     $bzfk_info=$bzfk_model->where("account=$k")->find();
	 $info[]=Array(
	   'account'=>$k,
	   'ps'=>$v,
	   'total'=>$bzfk_info['total'],
	   'rank'=>1,
	 );
   }
   //重写排名
   for($i=0;$i<count($info);$i++)
   {
     $rank=1;
     for($j=0;$j<count($info);$j++)
	 {
	   if($info[$i]['account']==$info[$j]['account'])
	     continue;
	   if($info[$i]['ps']<$info[$j]['ps'])
	     $rank++;
	   if($info[$i]['ps']==$info[$j]['ps'])
	   {
	     if($info[$i]['total']<$info[$j]['total'])
		   $rank++;
	     if($info[$i]['total']==$info[$j]['total'])
         {
	       //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，相等返回0
           if(strcmp($info[$i]['account'],$info[$j]['account'])>0)//学号小的排在前面	
             $rank++;		 
         }
	   }
	 }
	 $info[$i]['rank']=$rank;
   }
   //检测输出
   for($k=0;$k<count($info);$k++)
   {
     echo $info[$k]['account']."	".$info[$k]['ps']."	".$info[$k]['total']."	".$info[$k]['rank']."</br>";
   }
   //从$info中取出前三名
   for($k=0;$k<count($info);$k++)
   {
     if($info[$k]['rank']==1)
	   $account1=$info[$k]['account'];
	 if($info[$k]['rank']==2)
	   $account2=$info[$k]['account'];
	 if($info[$k]['rank']==3)
	   $account3=$info[$k]['account'];
   }
  echo "三名优秀部长分别是：".$account1."	".$account2."	".$account3;
  //将三名优秀部长存入tbl_bzfk中
  $data['yxbz']=1;
  $bzfk_model->where("account=$account1")->data($data)->save();
  $bzfk_model->where("account=$account2")->data($data)->save();
  $bzfk_model->where("account=$account3")->data($data)->save();
 }

 //一键反馈第四步，生成优秀部门
 public function funcfkfour()
 {
   $year="2014";
   $month="4";
   for($i=1;$i<=11;$i++)
   {
     $this->getbmfk($i,$year,$month);
   }
   $bmfk_model=new Model("Bmfk");
   //给部门进行排名
   for($i=1;$i<=11;$i++)
   {
     $rank=1;
	 $bmfk_info=$bmfk_model->where("apartment=$i")->find();
	 $total=$bmfk_info['total'];
	 for($j=1;$j<=11;$j++)
	 {
	   if($i==$j)
	     continue;
	   $bmfk_info2=$bmfk_model->where("apartment=$j")->find();
	   $total2=$bmfk_info2['total'];
	   if($total<$total2)
	     $rank++;
	   if($total==$total2)
	   {
	     if($i>$j)
		   $rank++;
	   }
	 }
	 //一个部门跑完，将排名存起来
	 echo "部门".$i."的总分是".$total."排名是：".$rank."</br>";
	 unset($data);
	 $data['rank']=$rank;
	 if($bmfk_model->where("apartment=$i")->data($data)->save())
	   echo "排名添加成功";
   }

   //找到两个优秀部门，从排名高的开始
   $bmfk_model=new Model("Bmfk");
   $yxchxz_model=new Model("Yxchxz");
   //将优秀部门清空
   unset($data);
   $data['yxbm']=0;
   $bmfk_model->where("year=$year and month=$month")->data($data)->save();
   //$flag=1;
   //$total=0;
   //$rank=1;
  //判断是否被限制,这次暂且不加限制了
  /*
   while($flag)
   {
     $bmfk_info=$bmfk_model->where("rank=$rank")->select();
	 
	 foreach($bmfk_info as $v)
	 {
	   $apartment=$v['apartment'];
	   $yxchxz_info=$yxchxz_model->where("account=$apartment")->find();
	   if(empty($yxchxz_info))
	   {
	     $total++;
	     $data['yxbm']=1;
	     $bmfk_model->where("apartment=$apartment")->data($data)->save();
		 break;
	   }
	 }
	 $rank++;
	 if($total>=2)
	 {
	   $flag=0;
	 }
   }
*/
  //找到排名第一的
  $bmfk_info=$bmfk_model->where("rank=1")->find();
  $apartment=$bmfk_info['apartment'];
  unset($data);
  $data['yxbm']=1;
  $bmfk_model->where("apartment=$apartment")->data($data)->save();
  $bmfk_info=$bmfk_model->where("rank=2")->find();
  $apartment=$bmfk_info['apartment'];
  unset($data);
  $data['yxbm']=1;
  $bmfk_model->where("apartment=$apartment")->data($data)->save();

 }
 //一键反馈第五步，生成外调次数及其排名
 public function funcfkfive()
 {
   $resource_model=new Model("Resource");
   $person_model=new Model("Person");
   $wdcs_model=new Model("Wdcs");
   //按部门处理
   for($i=1;$i<=11;$i++)
   {
     $person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	 foreach($person_info as $v)
	 {
	   $gs_account=$v['account'];
	   $resource_info=$resource_model->where("account=$gs_account")->select();
	   $wdcs=count($resource_info);
	   //echo $gs_account."本月被外调了".$wdcs."次</br>";
	   $data['wdcs']=$wdcs;
	   $wdcs_model->where("account=$gs_account")->data($data)->save();
	 }
   }
   //生成排名，也是按部门来
   for($i=1;$i<=11;$i++)
   {
     $person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	 $person_info2=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	 foreach($person_info as $v)
	 {
	   $rank=1;
	   $gs_account=$v['account'];
	   $wdcs_info=$wdcs_model->where("account=$gs_account")->find();
	   $wdcs=$wdcs_info['wdcs'];
	   foreach($person_info2 as $v2)
	   {
	     $gs_account2=$v2['account'];
		 $wdcs_info2=$wdcs_model->where("account=$gs_account2")->find();
		 $wdcs2=$wdcs_info2['wdcs'];
		 if($wdcs<$wdcs2)
		   $rank++;
		 if($wdcs==$wdcs2)
		 {
		   //按学号大小排名          //strcmp函数：str1小于str2返回负数，str1大于str2返回正数，///相等返回0
           if(strcmp($gs_account,$gs_account2)>0)//学号小的排在前面	
             $rank++;	
		 }
	   }
	   //echo $gs_account."被外调".$wdcs."次，部门内排".$rank."</br>";
	   unset($data);
	   $data['rank']=$rank;
	   $wdcs_model->where("account=$gs_account")->data($data)->save();
	 }
   }
 }
 //在干事考核反馈表中，根据传过来干事的account，进行操作
 public function getgsfk($waccount,$year,$month)
 {
   //计算自评得分
   $gszp_model=new Model("Gszp");
   $gskh_model=new Model("Gskh");
   $chuqin_model=new Model("Chuqin");
   $resource_model=new Model("Resource");
   $interact_model=new Model("Interact");
   $diaoyan_model=new Model("Diaoyan");
   $gszp_info=$gszp_model->where("account=$waccount")->find();
   
   $total=$gszp_info['total'];
   $zpdf=($total/(12*10))*2;
   //echo $waccount."得分：".$zpdf."</br>";
   //找出其部长
   $person_model=new Model("Person");
   $person_info=$person_model->where("account=$waccount")->find();
   $apartment=$person_info['apartment'];
   $person_info=$person_model->where("apartment=$apartment and type=3")->select();
   $bzpjdf=0;//部长评价得分
   $sum=count($person_info)."</br>";
   //var_dump($person_info);
   foreach($person_info as $v)
   {
     
     $bz_account=$v['account'];
     $gskh_info=$gskh_model->where("waccount=$bz_account and raccount=$waccount")->find();
	 //计算部长评价得分
     $total=
	       $gskh_info['DF1']
		  +$gskh_info['DF2']
		  +$gskh_info['DF3']
		  +$gskh_info['DF4']
		  +$gskh_info['DF5']
		  +$gskh_info['DF6']
		  +$gskh_info['DF7']
		  +$gskh_info['DF8']
		  +$gskh_info['DF9']
		  +$gskh_info['DF10']
		  +$gskh_info['DF11']
		  +$gskh_info['DF12']
		  +$gskh_info['DF13']
		  +$gskh_info['DF14'];
     $total=($total/(14*10))*5;
	 $bzpjdf+=$total;
   }
   $bzpjdf=$bzpjdf/$sum;
   //获取出勤情况
   $chuqin_info=$chuqin_model->where("raccount=$waccount")->find();
   if(!empty($chuqin_info)){
     $qj=$chuqin_info['qj']*(-0.1);
     $ct=$chuqin_info['ct']*(-0.2);
     $qx=$chuqin_info['qx']*(-0.3);
   }
   else{
     $qj=0;
	 $ct=0;
	 $qx=0;
   }
   //获取外调无辜缺席情况
   $resource_info=$resource_model->where("account=$waccount")->select();
   $wgqx=0;//外调无辜缺席次数
   $yb=0;//外调表现一般次数
   $tc=0;//外调表现突出次数
   if(!empty($resource_info)){
   foreach($resource_info as $v)
   {
     if($v['assess']==1)
	   $wgqx++;
	 if($v['assess']==3)
	   $yb++;
	 if($v['assess']==4)
	   $tc++;
   }
   }
   //出勤扣分
   $cqdf=1+$qj+$ct+$qx+$wgqx*0.1;
   //echo "出勤扣分".$cqdf;
   if($cqdf<0)
     $cqdf=0;
   //echo $waccount."外调无辜缺席次数：".$wgqx."</br>";
   //echo $waccount."外调一般次数：".$yb."</br>";
   //echo $waccount."外调突出次数：".$tc."</br>";
   //$wgqxkf=$wgqx*(-0.1);
   //获取外调加分
   $wdjf=$yb*0.1+$tc*0.2;
   //echo "外调加分：".$wdjf;
   //干事推优加分
   $interact_info=$interact_model->where("raccount=$waccount and (wtype=1 or wtype=2)")->select();
   //echo $waccount."被推优次数：".count($interact_info)."</br>";
   $tycs=count($interact_info);//被推优次数
   $tyjf=$tycs*0.1;
   //反馈加分：调研意见采纳加分
   $diaoyan_info=$diaoyan_model->where("raccount=$waccount")->find();
   //echo count($diaoyan_info)."</br>";
   //var_dump($diaoyan_info);
   if(!empty($diaoyan_info)){
   $dycn=$diaoyan_info['caina'];
   }
   else
   {
     $dycn=0;
   }
   $dycnjf=$dycn*0.1;
   //echo "调研采纳加分：".$dycnjf;
   //其他
   $qt=0;
   //计算总分：
   $total=$zpdf+$bzpjdf+$cqdf+$wdjf+$tyjf+$dycnjf+$qt;
   //将所有这些信息存入数据库表 tbl_gsfk中
   //排名和优秀干事先留着
   $gsfk_model=new Model("Gsfk");
   unset($data);
   $data=Array(
     'year'=>$year,
	 'month'=>$month,
	 'account'=>$waccount,
	 'total'=>$total,
	 'zpdf'=>$zpdf,//自评得分
     'bzpjdf'=>$bzpjdf,//部长评价
     'cqdf'=>$cqdf,//出勤得分
     'wddf'=>$wdjf,//外调得分
     'tydf'=>$tyjf,//推优得分
     'fkdf'=>$dycnjf,//反馈得分
     'qtdf'=>$qt,//其他得分
   );
   //var_dump($data);
   //echo "</br>";
   $gsfk_model->where("account=$waccount")->data($data)->save();
  // if($gsfk_model->add($data))
     //echo $waccount."修改成功</br>";
   //else  
     //echo $waccount."修改失败</br>";
   //echo json_encode($data,JSON_UNESCAPED_UNICODE);
 }
 //在部长反馈表，根据传过来的部长的waccount，year 和month进行操作
 public function getbzfk($waccount,$year,$month)
 {
   //计算自评得分
   $bzzp_model=new Model("Bzzp");
   $person_model=new Model("Person");
   $bzkh_model=new Model("Bzkh");
   $president_model=new Model("President");
   $interact_model=new Model("Interact");
   $chuqin_model=new Model("Chuqin");
   $resource_model=new Model("Resource");
   $diaoyan_model=new Model("Diaoyan");
   
   $bzzp_info=$bzzp_model->where("waccount=$waccount")->find();
   $total=$bzzp_info['total'];
   $total=($total/(17*10))*2;
   $zpdf=$total;
   //echo $waccount.":".$total."</br>";
   //找出主管副主席
   $person_info=$person_model->where("account=$waccount")->find();
   $apartment=$person_info['apartment'];
   $president_info=$president_model->where("(apartment1=$apartment or apartment2=$apartment)")->find();
   $fzx_account=$president_info['account'];
   $bzkh_info=$bzkh_model->where("waccount=$fzx_account and raccount=$waccount")->find();
   //;
   //计算主管副主席的给分
   //由于部长考核时没有计算总分，这里再计算一次
   $total=
          $bzkh_info['DF1']
		 +$bzkh_info['DF2']
		 +$bzkh_info['DF3']
		 +$bzkh_info['DF4']
		 +$bzkh_info['DF5']
		 +$bzkh_info['DF6']
		 +$bzkh_info['DF7']
		 +$bzkh_info['DF8']
		 +$bzkh_info['DF9']
		 +$bzkh_info['DF10']
		 +$bzkh_info['DF11']
		 +$bzkh_info['DF12']
		 +$bzkh_info['DF13']
		 +$bzkh_info['DF14']
		 +$bzkh_info['DF15'];

       
   $zxpjdf=$total;
   
   $zxpjdf=($zxpjdf/(15*10))*5;
   //echo $zxpjdf."来自：".$fzx_account."</br>";
   //找出所有干事
   $person_info=$person_model->where("apartment=$apartment and (type=1 or type=2)")->select();
   $gsgf=0;//累计干事给分
   $sum=count($person_info);//干事人数
   foreach($person_info as $v)
   {
     //echo $waccount."干事：".$v['account']."</br>";
	 $gs_account=$v['account'];
	 $interact_info=$interact_model->where("waccount=$gs_account and raccount=$waccount")->find();
     //echo "得分：".$interact_info['DF']."</br>";
	 $gsgf=$gsgf+$interact_info['DF']*0.2;
   }
   //echo "总得分：".$gsgf."</br>";
   //echo "人数：".$sum."</br>";
   $gspjdf=$gsgf/$sum;
   //echo "平均分：".$gspjdf."</br>";
   //本部门其他部长的评价
   //找出本部门其他部长
   $person_info=$person_model->where("apartment=$apartment and type=3")->select();
   $bzgf=0;
   $sum=count($person_info)-1;
   foreach($person_info as $v)
   {
     $bz_account=$v['account'];
     if($bz_account==$waccount)
	   continue;
     //echo $v['account']."</br>";
	 $interact_info=$interact_model->where("waccount=$bz_account and raccount=$waccount")->find();
     $bzgf=$bzgf+$interact_info['DF'];
    }
	$bzpjdf=$bzgf/$sum;
	$bzpjdf=$bzpjdf*0.2;
    //echo "总得分：".$bzgf."</br>";
    //echo "人数：".$sum."</br>";
	//echo "平均分：".$bzpjdf."</br>";
	//计算出勤扣分
 //获取出勤情况
   $chuqin_info=$chuqin_model->where("(year=$year and month=$month) and (raccount=$waccount)")->find();
   $qj=$chuqin_info['qj']*(-0.1);
   $ct=$chuqin_info['ct']*(-0.2);
   $qx=$chuqin_info['qx']*(-0.3);
   //获取外调无辜缺席情况
   $resource_info=$resource_model->where("account=$waccount")->select();
   $wgqx=0;//外调无辜缺席次数
   $yb=0;//外调表现一般次数
   $tc=0;//外调表现突出次数
   foreach($resource_info as $v)
   {
     if($v['assess']==1)
	   $wgqx++;
	 if($v['assess']==3)
	   $yb++;
	 if($v['assess']==4)
	   $tc++;
   }
   //出勤得分
   $cqdf=1+$qj+$ct+$qx-$wgqx*0.1;
   if($cqdf<0)
     $cqdf=0;
   //echo "出勤得分：".$cqdf."</br>";
   //echo $waccount."外调无辜缺席次数：".$wgqx."</br>";
   //echo $waccount."外调一般次数：".$yb."</br>";
   //echo $waccount."外调突出次数：".$tc."</br>";
   //$wgqxkf=$wgqx*(-0.1);
   
   //获取外调加分
   $wddf=$yb*0.1+$tc*0.2;
   //反馈加分：调研意见采纳加分
   $diaoyan_info=$diaoyan_model->where("raccount=$waccount")->find();
   //echo count($diaoyan_info)."</br>";
   //var_dump($diaoyan_info);
   $dycn=$diaoyan_info['caina'];
   $dycnjf=$dycn*0.1;
   $fkdf=$dycnjf;
   //其他
   $qtdf=0;
   //计算总分：
   $total=$zpdf+$zxpjdf+$gspjdf+$bzpjdf+$cqdf+$wddf+$fkdf+$qtdf;
   //将所有这些信息存入数据库表 tbl_gsfk中
   //排名和优秀部长先留着	
   $data=Array(
     'year'=>$year,
	 'month'=>$month,
	 'account'=>$waccount,
	 'total'=>$total,
	 'zpdf'=>$zpdf,
	 'zxpjdf'=>$zxpjdf,
	 'gspjdf'=>$gspjdf,
	 'bzpjdf'=>$bzpjdf,
	 'cqdf'=>$cqdf,
	 'wddf'=>$wddf,
	 'fkdf'=>$fkdf,
	 'qtdf'=>$qtdf,
   );
   $bzfk_model=new Model("Bzfk");
   if($bzfk_model->where("account=$waccount")->data($data)->save())
     echo "添加成功</br>";
 }
 //在主席团反馈表，根据传过来的部门apartment，year和month进行操作
 public function getbmfk($apartment,$year,$month)
 {
  
   $person_model=new Model("Person");
   $bmkh_model=new Model("Bmkh");
   $interact_model=new Model("Interact");
   $president_model=new Model("President");
   $chuqin_model=new Model("Chuqin");
   $bzfk_model=new Model("Bzfk");
   $diaoyan_model=new Model("Diaoyan");
   $bmty_model=new Model("Bmty");
   $bmwg_model=new Model("Bmwg");
   //主席评价
   $president_info=$president_model->where("is_sub='n'")->find();
   $zx_account=$president_info['account'];
   //echo "主席是：".$zx_account;
   $bmkh_info=$bmkh_model->where("(year=$year and month=$month) and (waccount=$zx_account and rapartment=$apartment)")->find();
   $total=$bmkh_info['total'];
   $total=($total/(7*10))*5;
   $zxpjdf=$total;
   echo "部门：".$apartment."的主席统分是：".$bmkh_info['total']."</br>";
   //主管副主席评价得分
   $president_info=$president_model->where("apartment1=$apartment or apartment2=$apartment")->find();
   echo "部门：".$apartment."的主管副主席account是：".$president_info['account']."</br>";
   $fzx_account=$president_info['account'];
   $bmkh_info=$bmkh_model->where("(year=$year and month=$month) and (waccount=$fzx_account and rapartment=$apartment)")->find();
   $total=$bmkh_info['total'];
   $total=($total/(7*10))*3;
   $zgpjdf=$total;
   echo "部门：".$apartment."的主管副主席统分是：".$bmkh_info['total']."</br>";
   //出勤扣分
 //获取出勤情况
   $chuqin_info=$chuqin_model->where("(year=$year and month=$month) and (rapartment=$apartment)")->find();
   if(!empty($chuqin_info)){
   $qj=$chuqin_info['qj']*(-0.1);
   $ct=$chuqin_info['ct']*(-0.2);
   $qx=$chuqin_info['qx']*(-0.3);
   }
   else{
     $qj=0;
	 $ct=0;
	 $qx=0;
   }
   //出勤得分
   $cqdf=2+$qj+$ct+$qx;
   echo "出勤得分：".$cqdf."</br>";
   if($cqdf<0)
     $cqdf=0;
   //主席团推优得分
   $bmty_info=$bmty_model->where("rapartment=$apartment")->select();
   $tydf=count($bmty_info);
   $tydf=$tydf*0.3;
   echo $apartment."的主席团推优得分是：".$tydf."</br>";
   //$tydf=0;
   //优秀部长加分
   //找出本部门部长
   $person_info=$person_model->where("apartment=$apartment and type=3")->select();
   $yxbz=0;
   foreach($person_info as $v)
   {
     $bz_account=$v['account'];
	 echo "部长：".$bz_account."</br>";
	 $bzfk_info=$bzfk_model->where("(year=$year and month=$month) and account=$bz_account")->find();
	 //echo "该部长是否为优秀：".$bzfk_info['yxbz']."</br>";
	 //var_dump($bzfk_info);
	 if($bzfk_info['yxbz']==1)
	 {
	   echo "优秀部长：".$bz_account."</br>";
	   $yxbz=0.2;
	 }
   }
   //获取反馈加分，包括部长和干事
   $fkdf=0;
   $person_info=$person_model->where("apartment=$apartment")->select();
   foreach($person_info as $v)
   {
     $raccount=$v['account'];
	 $diaoyan_info=$diaoyan_model->where("raccount=$raccount")->find();
	 $fkdf=$fkdf+$diaoyan_info['caina'];
   }
   $fkdf=$fkdf*0.1;
   //违规扣分
   $bmwg_info=$bmwg_model->where("apartment=$apartment")->find();
   if(!empty($bmwg_info)){
     $wgkf=-$bmwg_info['wgkf'];}
   else{
     $wgkf=0;}
   //其他
   $qt=0;
 
   //将所有这些信息存入数据库表
   $total=$zxpjdf+$zgpjdf+$cqdf+$tydf+$wgkf+$fkdf+$qt+$yxbz;
   $data=Array(
     'year'=>$year,
	 'month'=>$month,
	 'total'=>$total,
	 'apartment'=>$apartment,
	 'zxpjdf'=>$zxpjdf,
	 'zgpjdf'=>$zgpjdf,
	 'cqdf'=>$cqdf,
	 'wgkf'=>$wgkf,
	 'fkdf'=>$fkdf,
	 'tydf'=>$tydf,
	 'qt'=>$qt,
	 'yxbz'=>$yxbz,
   );
   
   $bmfk_model=new Model("Bmfk");
   if($bmfk_model->where("apartment=$apartment")->data($data)->save())
     echo $apartment."添加成功</br>";
	 

 }
 //整体考核结果反馈
 public function getztfk()
 {}
//下面是与前端通讯的各种反馈表
//向前端发送干事考核反馈表json数据
 public function jsgskh()
 {
   //
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	  
	//获取请求的时间
	$year=$_GET['year'];
	$month=$_GET['month'];
	//判断时间是否合理
	$gsfk_model=new Model("Gsfk");
  
	$account=$_SESSION['account'];
	$person_model=new Model("Person");
	
	$gszp_model=new Model("Gszp");
	$interact_model=new Model("Interact");
	$person_info=$person_model->where("account=$account")->find();
	//基本信息
	$name=$person_info['name'];
	$apartment=$person_info['apartment'];
	$gsfk_info=$gsfk_model->where("account=$account")->find();
	$zongfen=$gsfk_info['total'];
	$paiming=$gsfk_info['rank'];
	//获取该部门该月优秀干事
	/*
    $gsfk_info=$gsfk_model->where("yxgs=1")->select();
	foreach($gsfk_info as $v)
	{
	  $gs_account=$v['account'];
	  $person_info=$person_model->where("account=$gs_account")->find();
	  if($person_info['apartment']==$apartment)
	  {
	    $yxgs_account=$gsfk_info['account'];
		break;
	  }
	}
	*/
	$person_info=$person_model->where("apartment=$apartment and (type=1 or type=2)")->select();
	foreach($person_info as $v)
	{
	  $gs_account=$v['account'];
	  $gsfk_info=$gsfk_model->where("account=$gs_account")->find();
	  if($gsfk_info['yxgs']==1)
	  {
	    //echo "woshi ";
	    $yxgs_account=$gs_account;
		break;
	  }
	}
	$person_info=$person_model->where("account=$yxgs_account")->find();
	if(!empty($person_info))
	{
	  $yxgs_name=$person_info['name'];
	}
	else{
	  $yxgs_name="无";
	}
	//echo "优秀干事：".$yxgs_name;
	//得分细节：
	$gsfk_info=$gsfk_model->where("account=$account")->find();
	$DFXJ[]=Array(
	  'a'=>$gsfk_info['zpdf'],
	  'b'=>$gsfk_info['bzpjdf'],
	  'c'=>$gsfk_info['cqdf'],
	  'd'=>$gsfk_info['wddf'],
	  'e'=>$gsfk_info['tydf'],
	  'f'=>$gsfk_info['fkdf'],
	  'g'=>$gsfk_info['qtdf'],
	);
	//自我评价
	$gszp_info=$gszp_model->where("account=$account")->find();
	$zwpj=$gszp_info['zptext'];
	//其他干事评价
	$person_info=$person_model->where("(type=1 or type=2) and apartment=$apartment")->select();
    foreach($person_info as $v)
	{
	  $gs_account=$v['account'];
	  if($gs_account==$account)
	    continue;
	  $interact_info=$interact_model->where("waccount=$gs_account and raccount=$account")->find();
	  $pj=$interact_info['text'];
	  if(empty($pj))
	    $pj="无";
	  $qtgspj[]=Array(
	    'pj'=>$pj,
	  );
	}
	//部长评价
	$person_info=$person_model->where("(type=3) and apartment=$apartment")->select();
	foreach($person_info as $v)
	{
	  $bz_account=$v['account'];
	  $interact_info=$interact_model->where("waccount=$bz_account and raccount=$account")->find();
	  $bzdpj=$interact_info['text'];
	  $bzpj[]=Array(
	    'bzpj'=>$bzdpj,
	  );
	}
	//生成将要返回的json数组
	$arr=Array(
	  'zongfen'=>$zongfen,
	  'paiming'=>$paiming,
	  'yxgs'=>$yxgs_name,
	  'DFXJ'=>$DFXJ,
	  'zwpj'=>$zwpj,
	  'qtgspj'=>$qtgspj,
	  'bzpj'=>$bzpj,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	

  }
  
  //向前端发送部长反馈表的json数据
  public function jsbzfk()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
    $bzfk_model=new Model("Bzfk");
    $person_model=new Model("Person");
	$bzzp_model=new Model("Bzzp");
	$interact_model=new Model("Interact");
	$president_model=new Model("President");
	$gszp_model=new Model("Gszp");
	$bmfk_model=new Model("Bmfk");
	$oneway_model=new Model("Oneway");
	//$oneway
	//基本信息
	$person_info=$person_model->where("account=$account")->find();
    $apartment=$person_info['apartment'];
    //获取总分

    
	$bzfk_info=$bzfk_model->where("account=$account")->find();
    $ZongFen=$bzfk_info['total'];
    //获取得分细则
    $arrDeFenXiZhe=Array(
	  'a'=>$bzfk_info['zpdf'],
	  'b'=>$bzfk_info['zxpjdf'],
	  'c'=>$bzfk_info['gspjdf'],
	  'd'=>$bzfk_info['bzpjdf'],
	  'e'=>$bzfk_info['cqdf'],
	  'f'=>$bzfk_info['wddf'],
	  'g'=>$bzfk_info['fkdf'],
	  'h'=>$bzfk_info['qtdf'],	 	  
	);	
	//获取自我评价
	$bzzp_info=$bzzp_model->where("waccount=$account")->find();
	$ZiWoPingJia=$bzzp_info['zptext'];
	//其他部长评价
	$person_info=$person_model->where("apartment=$apartment and type=3")->select();
	foreach($person_info as $v)
	{
	 
	  $bz_account=$v['account'];
	  if($bz_account==$account)
	    continue;
	  $interact_info=$interact_model->where("waccount=$bz_account and raccount=$account")->find();
	  $pj=$interact_info['text'];
      $arrQiTaBuZhanPinJia[]=Array(
	    'pj'=>$pj,
	  );	  
	}
	$QiTaBuZhanPinJia=Array(
	  'sum'=>count($person_info)-1,
	  'arrQiTaBuZhanPinJia'=>$arrQiTaBuZhanPinJia,
	);
	//echo json_encode($QiTaBuZhanPinJia,JSON_UNESCAPED_UNICODE);
	//主管副主席评价
	$president_info=$president_model->where("apartment1=$apartment or apartment2=$apartment")->find();
	$fzx_account=$president_info['account'];
	$interact_info=$interact_model->where("waccount=$fzx_account and raccount=$account")->find();
	$ZhuGuanFuZhuXiPinJia=$interact_info['text'];
	//获取干事评价
	$person_info=$person_model->where("apartment=$apartment and (type=1 or type=2)")->select();
    $sum=count($person_info);
	foreach($person_info as $v)
    {
	  $gs_account=$v['account'];
	  $person_info=$person_model->where("account=$gs_account")->find();
	  //$gs_name=$person_info['name'];
	  $interact_info=$interact_model->where("waccount=$gs_account and raccount=$account")->find();
	  $arrGanShiPingJia[]=Array(
		'gspj'=>$interact_info['text'],
	  );
	}
    $GanShiPingJia=Array(
	  'sum'=>$sum,
	  'arrGanShiPingJia'=>$arrGanShiPingJia,
	);	
	//echo json_encode($GanShiPingJia,JSON_UNESCAPED_UNICODE);
	//获取干事自评
	$person_info=$person_model->where("apartment=$apartment and (type=1 or type=2)")->select();
	$sum=count($person_info);
	foreach($person_info as $v)
	{
	  $gs_account=$v['account'];
	  $gszp_info=$gszp_model->where("account=$gs_account")->find();
	  $arrGSZP[]=Array(
	    'name'=>$v['name'],
		'account'=>$gs_account,
		'assess'=>$gszp_info['zptext'],
	  );
	}
	$GSZP=Array(
	  'sum'=>$sum,
	  'arrGSZP'=>$arrGSZP,
	);
	//echo json_encode($GSZP,JSON_UNESCAPED_UNICODE);
	//部门得分和部门排名
	$bmfk_info=$bmfk_model->where("apartment=$apartment")->find();
	$BuMenDeFeng=$bmfk_info['total'];
	$BuMenPaiMing=$bmfk_info['rank'];
	//部门得分细则
	$arrBuMenDeFenXiZhe=Array(
	  'a'=>$bmfk_info['zxpjdf'],
	  'b'=>$bmfk_info['zgpjdf'],
	  'c'=>$bmfk_info['cqdf'],
	  'd'=>$bmfk_info['wgkf'],
	  'e'=>$bmfk_info['fkdf'],
	  'f'=>$bmfk_info['tydf'],
	  'g'=>$bmfk_info['yxbz'],
	  'h'=>$bmfk_info['qtdf'],
	);
	//主管副主席的部门评价
	$oneway_info=$oneway_model->where("waccount=$fzx_account and rapartment=$apartment")->find();
	$ZhuGuanFuZhuXiBuMenPinJia=$oneway_info['text'];
	//主席的部门评价
	$president_info=$president_model->where("is_sub='n'")->find();
	$zx_account=$president_info['account'];
	$oneway_info=$oneway_model->where("waccount=$zx_account and rapartment=$apartment")->find();
    //var_dump($oneway_info);
	$ZhuXiDeBuMenPinJia=$oneway_info['text'];
	//向前端发送json数据
	$arr=Array(
	  'ZongFen'=>$ZongFen,
	  'arrDeFenXiZhe'=>$arrDeFenXiZhe,
	  'ZiWoPingJia'=>$ZiWoPingJia,
	  'QiTaBuZhanPinJia'=>$QiTaBuZhanPinJia,
	  'ZhuGuanFuZhuXiPinJia'=>$ZhuGuanFuZhuXiPinJia,
	  'GSZP'=>$GSZP,
	  'GanShiPingJia'=>$GanShiPingJia,
	  'BuMenDeFeng'=>$BuMenDeFeng,
	  'BuMenPaiMing'=>$BuMenPaiMing,
	  'arrBuMenDeFenXiZhe'=>$arrBuMenDeFenXiZhe,
	  //前端两个评价给颠倒了。。。
	  'ZhuGuanFuZhuXiBuMenPinJia'=>$ZhuGuanFuZhuXiBuMenPinJia,
	  'ZhuXiDeBuMenPinJia'=>$ZhuXiDeBuMenPinJia,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
  }  
  //向前端发送跟进部门出勤统计表json数据
  public function  jsgjbmcqtj()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
	
	//获取请求的时间
	$year=$_GET['year'];
	$month=$_GET['month'];
	//判断时间是否合理
	$chuqin_model=new Model("Chuqin");
	if($chuqin_info=$chuqin_model->where("year=$year and month=$month")->find())
	{	
	
    //获取授权状态 status 	  
	$status=$this->getStatus();
	$person_model=new Model("Person");  
	$rlgj_model=new Model("Rlgj");
	
	$rlgj_info=$rlgj_model->where("account=$account")->find();
	//跟进部门
	$apartment=$rlgj_info['apartment'];
	//echo "不么：".$apartment;
	$gjbm=$apartment;
	//if($apartment==1)
	//  echo "秘书处";
	$person_info=$person_model->where("apartment=$apartment")->select();
	//人数
	$renshu=count($person_info);
	//出勤情况
	foreach($person_info as $v)
	{
	  $raccount=$v['account'];
	  $chuqin_info=$chuqin_model->where("waccount=$account and raccount=$raccount")->find();
      $person_info=$person_model->where("account=$raccount")->find();
      $rname=$person_info['name'];
      $chuqin[]=Array(
	    'account'=>$raccount,
	    'name'=>$rname,
		'qj'=>$chuqin_info['qj'],
		'ct'=>$chuqin_info['ct'],
		'qx'=>$chuqin_info['qx'],
	  );	  
	}
	//生成将要返回的json数组
	$arr=Array(
	  'gjbm'=>$apartment,
	  'renshu'=>$renshu,
	  'status'=>$status,
	  'chuqin'=>$chuqin,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	}//合理空间结束
	//没有找到该年月对应的话，返回错误信息
	else{
	
	}
  }
 //向前端发送调研意见采纳表json数据
 public function jsdyyjcn()
 {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
	
	//获取请求的时间
	$year=$_GET['year'];
	$month=$_GET['month'];
	//判断时间是否合理
	$diaoyan_model=new Model("Diaoyan");
	if($diaoyan_info=$diaoyan_model->where("year=$year and month=$month")->find())
	{	
	
    //获取授权状态 status 	  
	$status=$this->getStatus();
	$person_model=new Model("Person");  
	
    $bmsm=11;
	//获取调研采纳情况
	for($i=1;$i<=11;$i++)
	{
	  //echo "第".$i."个部门：</br>";
	  $person_info=$person_model->where("apartment=$i")->select();
	  $bmrs=count($person_info);
	  foreach($person_info as $v)
	  {
	    $raccount=$v['account'];
		$rname=$v['name'];
		$diaoyan_info=$diaoyan_model->where("raccount=$raccount")->find();
		$arrCNJF[]=Array(
		  'name'=>$rname,
		  'account'=>$raccount,
		  'jiafen'=>$diaoyan_info['caina'],
		);
	  }
	  $arrBM[]=Array(
	    'bmmz'=>$i,
		'bmrs'=>$bmrs,
		'arrCNJF'=>$arrCNJF,
	  );
	  unset($arrCNJF);
	}
	//向前端发送json数据
	$arr=Array(
	  'status'=>$status,
	  'bmsm'=>$bmsm,
	  'arrBM'=>$arrBM,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	}//合理空间结束
	//没有找到该年月对应的话，返回错误信息
	else{
	
	}
 }
 //向前端发送整体考核结果反馈表json数据
 public function jsztkhjgfk()
 {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
	
    $person_model=new Model("Person");
    $gsfk_model=new Model("Gsfk");
    $bzfk_model=new Model("Bzfk");
    $bmfk_model=new Model("Bmfk");
	$resource_model=new Model("Resource");
    //获取优秀部门
    $bmfk_info=$bmfk_model->where("yxbm=1")->select();
    foreach($bmfk_info as $v)
    {
	  //echo "优秀部门".$v['apartment'];
	  $arrYXBM[]=Array(
	    'bm'=>$v['apartment'],
		'df'=>$v['total'],
	  );
	}
    //echo json_encode($arrYXBM,JSON_UNESCAPED_UNICODE);    
	//获取优秀部长
	$bzfk_info=$bzfk_model->where("yxbz=1")->select();
	foreach($bzfk_info as $v)
	{
	  $yxbz_account=$v['account'];
	  $person_info=$person_model->where("account=$yxbz_account")->find();
	  $yxbz_name=$person_info['name'];
	  $ssbm=$person_info['apartment'];
	  $df=$v['total'];
	  $arrYXBZ[]=Array(
	    'account'=>$yxbz_account,
		'bm'=>$yxbz_name,
		'ssbm'=>$ssbm,
		'df'=>$df,
	  );
	}
	//echo json_encode($arrYXBZ,JSON_UNESCAPED_UNICODE);  

	//上面获取各部门排名前三干事有误
	for($i=1;$i<=11;$i++)
	{
	  for($j=1;$j<=3;$j++)
	  {
	    //优秀干事人数
		$sum=0;
	    $gsfk_info=$gsfk_model->where("rank=$j")->select();
		$person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
		foreach($person_info as $v)
		{
		  $gs_account=$v['account'];
		  foreach($gsfk_info as $v2)
		  {
		    if($gs_account==$v2['account'])
			{
			  $GS[]=Array(
			    'name'=>$v['name'],
				'account'=>$gs_account,
				'df'=>$v2['total'],
				'ydyxgs'=>$v2['yxgs'],
			  );
			  break;
			}
		  }
		}
		//找到了$i部门排名第$j的信息		
	  }
	  //整个$i部门找完了
	  $arrBM[]=Array(
	    //'sum'=>3,
		'bm'=>$i,
		'GS'=>$GS,
	  );
	  unset($GS);
	}
	$YXGS=Array(
	  'bmsm'=>11,
	  'arrBM'=>$arrBM,
	);
	//echo json_encode($YXGS,JSON_UNESCAPED_UNICODE);
	//外调较多的人员
	//这里有点不明朗，前端需要的是较多人员，还是所有人员
	unset($GS);
	unset($arrBM);
	$wdcs_model=new Model("Wdcs");
	//外调较多人员代码有误，下面重写

	for($i=1;$i<=11;$i++)
	{
	  for($j=1;$j<=3;$j++)
	  {
	    $wdcs_info=$wdcs_model->where("rank=$j")->select();
		$person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
		//var_dump($person_info);
		foreach($person_info as $v)
		{
		  $gs_account=$v['account'];
		  foreach($wdcs_info as $v2)
		  {
		    if($gs_account==$v2['account'])
			{
			  $GS[]=Array(
			    'name'=>$v['name'],
				'account'=>$gs_account,
				'wdcs'=>$v2['wdcs'],
			  );
			  break;
			}
		  }
		}
	  }
	  //找第二个部门前
	  $arrBM[]=Array(
	    //'sum'=>3,
		'bm'=>$i,
		'GS'=>$GS,
	  );
	  unset($GS);
	}
	$WDJDRY=Array(
	  'bmsm'=>11,
	  'arrBM'=>$arrBM,
	);
	//echo json_encode($WDJDRY,JSON_UNESCAPED_UNICODE);
	//生成将要返回的json数组
	$arr=Array(
	  'arrYXBM'=>$arrYXBM,
	  'arrYXBZ'=>$arrYXBZ,
	  'YXGS'=>$YXGS,
	  'WDJDRY'=>$WDJDRY,
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
 }
 //向前端发送主席团反馈表json数据
 public function jszxtfk()
 {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 

	$account=$_SESSION['account'];
   $bmfk_model=new Model("Bmfk");
   //获取部门排名
   for($i=1;$i<=11;$i++)
   {
     $bmfk_info=$bmfk_model->where("rank=$i")->find();
	 $score=$bmfk_info['total'];
	 $apartment=$bmfk_info['apartment'];
	 $isExc=$bmfk_info['yxbm'];
	 $arrSorted[]=Array(
	   'name'=>$apartment,
	   'score'=>$score,
	   'isExc'=>$isExc,
	 );
   }
   $classSortDepart=Array(
     'sum'=>2,
	 'arrSorted'=>$arrSorted,
   );
   //echo json_encode($arrSorted,JSON_UNESCAPED_UNICODE);
   //获取优秀部长
   $bzfk_model=new Model("Bzfk");
   $person_model=new Model("Person");
   $bzfk_info=$bzfk_model->where("yxbz=1")->select();
   //var_dump($bzfk_info);
   foreach($bzfk_info as $v)
   {
     $bz_account=$v['account'];
	 $person_info=$person_model->where("account=$bz_account")->find();
	 $bz_name=$person_info['name'];
	 $apartment=$person_info['apartment'];
	 $score=$v['total'];
	 $arrExcMin[]=Array(
	   'name'=>$bz_name,
	   'account'=>$bz_account,
	   'depart'=>$apartment,
	   'score'=>$score,
	 );
   }
   //echo json_encode($arrExcMin,JSON_UNESCAPED_UNICODE);
   $ExcMinster=Array(
     'sum'=>3,
	 'arrExcMin'=>$arrExcMin,
   );
   //echo json_encode($ExcMinster,JSON_UNESCAPED_UNICODE);
   //获取部长对主管副主席评价
   $interact_model=new Model("Interact");
   $bzzp_model=new Model("Bzzp");
   $president_model=new Model("President");
   //找出部长们
   //echo $account;
   $president_info=$president_model->where("account=$account")->find();
   $apartment1=$president_info['apartment1'];
   $apartment2=$president_info['apartment2'];
   if($apartment1!=0)
   {
      $person_info=$person_model->where("type=3 and apartment=$apartment1")->select();  
      foreach($person_info as $v)
	  {
	    //echo $account."PK".$bz_account."</br>";
	    $bz_account=$v['account'];
		$bz_name=$v['name'];
		$bzzp_info=$bzzp_model->where("waccount=$bz_account")->find();
	    $interact_info=$interact_model->where("(waccount=$bz_account and raccount=$account) and nm=0")->find();
	    //var_dump($interact_info);
		$arrMinFeedBack[]=Array(
		 'depart'=>$apartment1,
		 'minister'=>$bz_name,
		 'selfAssess'=>$bzzp_info['zptext'],
	     'feedBack'=>$interact_info['text'],
	    );	    
	  }
   }
   if($apartment2!=0)
   {
      $person_info=$person_model->where("type=3 and apartment=$apartment2")->select();  
      foreach($person_info as $v)
	  {
	    //echo $account."PK".$bz_account."</br>";
	    $bz_account=$v['account'];
		$bz_name=$v['name'];
		$bzzp_info=$bzzp_model->where("waccount=$bz_account")->find();
	    $interact_info=$interact_model->where("(waccount=$bz_account and raccount=$account) and nm=0")->find();
	    //var_dump($interact_info);
		$arrMinFeedBack[]=Array(
		 'depart'=>$apartment2,
		 'minister'=>$bz_name,
		 'selfAssess'=>$bzzp_info['zptext'],
	     'feedBack'=>$interact_info['text'],
	    );	    
	  }
   }

    //echo json_encode($arrMinFeedBack,JSON_UNESCAPED_UNICODE);	
	//匿名评价
      $person_info=$person_model->where("type=3 and (apartment=$apartment1 or apartment=$apartment2)")->select();  
      //管辖下的部长数目
	  $sum=count($person_info);
	  foreach($person_info as $v)
	  {
	    //echo $account."PK".$bz_account."</br>";
	    $bz_account=$v['account'];
		$bz_name=$v['name'];
		//$bzzp_info=$bzzp_model->where("waccount=$bz_account")->find();
	    $interact_info=$interact_model->where("(waccount=$bz_account and raccount=$account) and nm=1")->find();
	    //var_dump($interact_info);
		if(!empty($interact_info['text']))
		{
		  $arrAnonymity[]=Array(
            'anonymityFeedBack'=>$interact_info['text'],
	      );	
        }		  
	  }
	  $classSituation=Array(
	    'sum'=>$sum,
		'arrMinFeedBack'=>$arrMinFeedBack,
		'arrAnonymity'=>$arrAnonymity,
	  );
	  //echo json_encode($arrAnonymity,JSON_UNESCAPED_UNICODE);	
	  //生成将要返回的json数组
	  $arr=Array(
        'classSortDepart'=>$classSortDepart,
		'ExcMinster'=>$arrExcMin,
		'classSituation'=>$classSituation,
		'_arrAnonymity'=>$arrAnonymity,
	  );
	  echo $this->_encode($arr);
	  //echo json_encode($arr,JSON_UNESCAPED_UNICODE);	
	  
 }
 
//下面是接收前端发送过来json数据
  //接收干事自评表
  public function post_gszp()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
	$account=$_SESSION['account'];
	//基本信息
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
    $apartment=$person_info['apartment'];
	$type=$person_info['tycs'];
	//获取当前时间
	//$year=date("Y");
    //获取当前的月份，数字，1，或者23
    //$month = date("n");
	$year="2014";
	$month="4";
    $status=$_GET['status'];
	//$DF=$_GET['arrDF'];
	//自我评价
	$data['zptext']=$_GET['zwpj'];
	//得分细则
    $data['DF1']=$_GET['arrDF'][0]['df'];
	$data['DF2']=$_GET['arrDF'][1]['df'];
	$data['DF3']=$_GET['arrDF'][2]['df'];
	$data['DF4']=$_GET['arrDF'][3]['df'];
	$data['DF5']=$_GET['arrDF'][4]['df'];
	$data['DF6']=$_GET['arrDF'][5]['df'];
	$data['DF7']=$_GET['arrDF'][6]['df'];
	$data['DF8']=$_GET['arrDF'][7]['df'];
	$data['DF9']=$_GET['arrDF'][8]['df'];
	$data['DF10']=$_GET['arrDF'][9]['df'];
	$data['DF11']=$_GET['arrDF'][10]['df'];
	$data['DF12']=$_GET['arrDF'][11]['df'];
	//$data['total']=$_GET['zongfen'];
	//总分
	$data['total']=
    $data['DF1']+
	$data['DF2']+
	$data['DF3']+
	$data['DF4']+
	$data['DF5']+
	$data['DF6']+
	$data['DF7']+
	$data['DF8']+
	$data['DF9']+
	$data['DF10']+
	$data['DF11']+
	$data['DF12'];
	//推优自评数据库操作
	$gszp_model=new Model("Gszp");
	$info=$gszp_model->where("(year=$year and month=$month ) and account=$account")->data($data)->save();
	unset($data);
	//推优干事
	$interact_model=new Model("Interact");
	
	//$interact_info=$interact_model->where("(year=$year and month=$month) and (waccount=$account and (rtype=1 or rtype=2))")->find();
	  unset($data);
	  $gs_account=$_GET['TYGS']['account'];
	  $data['raccount']=$_GET['TYGS']['account'];
	  $data['text']=$_GET['TYGS']['tyly'];
	  $info=$interact_model->where("(year=$year and month=$month) and (waccount=$account and (rtype=1 or rtype=2))")->data($data)->save();
    //部长评价
	
	for($i=0;$i<count($_GET['arrDBZPJ']);$i++)
	{
	  unset($data);
	  $bz_account=$_GET['arrDBZPJ'][$i]['account'];
	  $data['raccount']=$bz_account;
	  $data['DF']=$_GET['arrDBZPJ'][$i]['fs'];
	  $data['text']=$_GET['arrDBZPJ'][$i]['pj'];
	  $interact_model->where("(year=$year and month=$month) and (waccount=$account and raccount=$bz_account)")->data($data)->save();
	}
   
    $arr=Array(
	  'status'=>"nima",
	  'df'=>$_GET['arrDF'][0]['df'],
	  'zwpj'=>$_GET['zwpj'],
	  'tygs'=>$_GET['TYGS']['tygs'],
	  'zongfen'=>$_GET['zongfen'],

	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
  }  
  //接收部长自评表
  public function post_bzzp()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 
    
	$account=$_SESSION['account'];
	//基本信息
	$person_model=new Model("Person");
	$person_info=$person_model->where("account=$account")->find();
    $apartment=$person_info['apartment'];
	//获取当前时间
	$year="2014";//date("Y");
    //获取当前的月份，数字，1，或者23
    $month = "4";//date("n");
	//自我评价
	$data['zptext']=$_GET['zwpj'];
	//各种得分
	
	$data['DF1']=$_GET['arrDF'][0]['df'];
	$data['DF2']=$_GET['arrDF'][1]['df'];
	$data['DF3']=$_GET['arrDF'][2]['df'];
	$data['DF4']=$_GET['arrDF'][3]['df'];
	$data['DF5']=$_GET['arrDF'][4]['df'];
	$data['DF6']=$_GET['arrDF'][5]['df'];
	$data['DF7']=$_GET['arrDF'][6]['df'];
	$data['DF8']=$_GET['arrDF'][7]['df'];
	$data['DF9']=$_GET['arrDF'][8]['df'];
	$data['DF10']=$_GET['arrDF'][9]['df'];
	$data['DF11']=$_GET['arrDF'][10]['df'];
	$data['DF12']=$_GET['arrDF'][11]['df'];
	$data['DF13']=$_GET['arrDF'][12]['df'];
	$data['DF14']=$_GET['arrDF'][13]['df'];
	$data['DF15']=$_GET['arrDF'][14]['df'];
	$data['DF16']=$_GET['arrDF'][15]['df'];
	$data['DF17']=$_GET['arrDF'][16]['df'];
	//计算总分
	$data['total']=
	$data['DF1']+
	$data['DF2']+
	$data['DF3']+
	$data['DF4']+
	$data['DF5']+
	$data['DF6']+
	$data['DF7']+
	$data['DF8']+
	$data['DF9']+
	$data['DF10']+
	$data['DF11']+
	$data['DF12']+
	$data['DF13']+
	$data['DF14']+
	$data['DF15']+
	$data['DF16']+
	$data['DF17'];
	$bzzp_model=new Model("Bzzp");
	$info=$bzzp_model->where("waccount=$account")->data($data)->save();
    
	
	$interact_model=new Model("Interact");
	//对本部门其他部长的评价
	$arrBZ=$_GET['DQTBZPJ']['arrBZ'];
	for($i=0;$i<count($arrBZ);$i++)
	{
	  unset($data);
	  $bz_account=$arrBZ[$i]['account'];
	  $data['text']=$arrBZ[$i]['pj'];
	  $data['DF']=$arrBZ[$i]['fs'];
	  $interact_model->where("waccount=$account and raccount=$bz_account")->data($data)->save();
   }
   
   //对主管副主席的评价，不匿名
   //找出主管副主席
   $president_model=new Model("President");
   $president_info=$president_model->where("apartment1=$apartment or apartment2=$apartment")->find();   
   $fzx_account=$president_info['account'];
   unset($data);
   $data['text']=$_GET['dzgfzxpj'];
   $interact_model->where("waccount=$account and raccount=$fzx_account and nm=0")->data($data)->save();
	//对主席团的匿名评价

	for($i=0;$i<count($_GET['NMPJ']['arrNMPJ']);$i++)
	{
	  unset($data);
	  $zxt_account=$_GET['NMPJ']['arrNMPJ'][$i]['account'];
	  $data['text']=$_GET['NMPJ']['arrNMPJ'][$i]['pj'];
	  $info=$interact_model->where("waccount=$account and raccount=$zxt_account and nm=1")->data($data)->save();
	}

	//返回信息
    $arr=Array(
	  'status'=>$_GET['arrDF'][0]['df'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);
  }
  //接收跟进部门统计表
  public function post_gjbmcqtj()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 

	$account=$_SESSION['account'];
	//返回信息
    $arr=Array(
	  'status'=>$_GET['chuqin'][0]['name'],
	  'gjbm'=>$_GET['gjbm'],
	  'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);	
  }
   //接收调研意见采纳
  public function post_dyyjcn()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index'); 

	$account=$_SESSION['account'];
	//返回信息
    $arr=Array(
	  'status'=>$_GET['arrBM'][0]['arrCNJF'][0]['name'],
	  'gjbm'=>$_GET['gjbm'],
	  'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);	
  }
   //接收干事考核
  public function post_gskh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index');
	 
    //$account=$_SESSION['account'];	  
    $gskh_model=new Model("Gskh");
	$interact_model=new Model("Interact");
    //部长账号
	 $waccount=$_SESSION['account'];
	 //遍历得分
	 for($i=0;$i<count($_POST['GSDF']['arrGSDF']);$i++)
	 {
	   //每个干事
	   unset($data);
	   $raccount=$_POST['GSDF']['arrGSDF'][$i]['account'];
	   $data['DF1']=$_POST['GSDF']['arrGSDF'][$i]['df0'];
	   $data['DF2']=$_POST['GSDF']['arrGSDF'][$i]['df1'];
	   $data['DF3']=$_POST['GSDF']['arrGSDF'][$i]['df2'];
	   $data['DF4']=$_POST['GSDF']['arrGSDF'][$i]['df3'];
	   $data['DF5']=$_POST['GSDF']['arrGSDF'][$i]['df4'];
	   $data['DF6']=$_POST['GSDF']['arrGSDF'][$i]['df5'];
	   $data['DF7']=$_POST['GSDF']['arrGSDF'][$i]['df6'];
	   $data['DF8']=$_POST['GSDF']['arrGSDF'][$i]['df7'];
	   $data['DF9']=$_POST['GSDF']['arrGSDF'][$i]['df8'];
	   $data['DF10']=$_POST['GSDF']['arrGSDF'][$i]['df9'];
	   $data['DF11']=$_POST['GSDF']['arrGSDF'][$i]['df10'];
	   $data['DF12']=$_POST['GSDF']['arrGSDF'][$i]['df11'];
	   $data['DF13']=$_POST['GSDF']['arrGSDF'][$i]['df12'];
	   $data['DF14']=$_POST['GSDF']['arrGSDF'][$i]['df13'];
	   $data['total']=$data['DF1']+$data['DF2']+$data['DF3']+$data['DF4']+
	   $data['DF5']+$data['DF6']+$data['DF7']+$data['DF8']+
	   $data['DF9']+$data['DF10']+$data['DF11']+$data['DF12']+
	   $data['DF13']+$data['DF14'];
	   $gskh_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	 }
	 //遍历评价
	 $info="";
	 for($i=0;$i<count($_POST['DGSPJ']['arrDGSPJ']);$i++)
	 {
	   $info.=$_POST['DGSPJ']['arrDGSPJ'][$i]['pj'];
	   unset($data);
	   $raccount=$_POST['DGSPJ']['arrDGSPJ'][$i]['account'];
	   $data['text']=$_POST['DGSPJ']['arrDGSPJ'][$i]['pj'];
	   $interact_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	 }
	//$data['DF1']=$_GET['GSDF']['arrGSDF'][0]['df0'];
	//$waccount=$_SESSION['account'];
	//$raccount=$_GET['DGSPJ']['arrDGSPJ'][0]['account'];
	//$gskh_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	//返回信息
    $arr=Array(
	  'status'=>$info,
	  //'gjbm'=>$_GET['gjbm'],
	  //'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);	
  }

  //接收部长考核表
  public function post_bzkh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index');
	//$account=$_SESSION['account'];
	//主席账号
	$waccount=$_SESSION['account'];
	
	//$year="2014";
	//$month="4";
	
    $bzkh_model=new Model("Bzkh");
	$interact_model=new Model("Interact");
	//部门数目
	for($i=0;$i<count($_GET['BMBZ']['arrBM']);$i++)
	{
	  //该部门部长数目
      for($j=0;$j<count($_GET['BMBZ']['arrBM'][$i]['arrBZ']);$j++)	
	  {
	    $raccount=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['account'];
	    //得分细则
		unset($data);
		$data['DF1']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df0'];
		$data['DF2']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df1'];
		$data['DF3']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df2'];
		$data['DF4']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df3'];
		$data['DF5']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df4'];
		$data['DF6']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df5'];
		$data['DF7']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df6'];
		$data['DF8']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df7'];
		$data['DF9']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df8'];
		$data['DF10']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df9'];
		$data['DF11']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df10'];
		$data['DF12']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df11'];
		$data['DF13']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df12'];
		$data['DF14']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df13'];
		$data['DF15']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['df14'];
		$bzkh_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();	
		unset($data);
		$data['text']=$_GET['BMBZ']['arrBM'][$i]['arrBZ'][$j]['pj'];
		$info.=$data['text'];
		$info.=$waccount;
		$info.=$raccount;
		$info.=$interact_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	  }
	}
     
	$_GET['NMPJ'][0]['name'];
	//返回信息
    $arr=Array(
	  'status'=>$info,
	  'info'=>$_GET['NMPJ'][0]['name'],
	  'gjbm'=>$_GET['gjbm'],
	  'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);	    
  }
  
    //接收部门考核表的数据
  public function post_bmkh()
  {
	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index');
	//主席团账号
	$waccount=$_SESSION['account'];
	
	//$year="2014";
	//$month="4";    
	$bmkh_model=new Model("Bmkh");
	$oneway_model=new Model("Oneway");
	$bzty_model=new Model("Bzty");
	$bmty_model=new Model("Bmty");
	//获取部门数目
	for($i=0;$i<count($_GET['BM']['arrBM']);$i++)
	{
	  //部门名字
	  $rapartment=$_GET['BM']['arrBM'][$i]['bm'];
	  //得分细则
	  unset($data);
	  $data['DF1']=$_GET['BM']['arrBM'][$i]['df0'];
	  $data['DF2']=$_GET['BM']['arrBM'][$i]['df1'];
	  $data['DF3']=$_GET['BM']['arrBM'][$i]['df2'];
	  $data['DF4']=$_GET['BM']['arrBM'][$i]['df3'];
	  $data['DF5']=$_GET['BM']['arrBM'][$i]['df4'];
	  $data['DF6']=$_GET['BM']['arrBM'][$i]['df5'];
	  $data['DF7']=$_GET['BM']['arrBM'][$i]['df6'];
	  $bmkh_model->where("waccount=$waccount and rapartment=$rapartment")->data($data)->save();
	  unset($data);
	  $data['text']=$_GET['BM']['arrBM'][$i]['pj'];
	  $oneway_model->where("waccount=$waccount and rapartment=$rapartment")->data($data)->save();
	}
	//部门推优
	unset($data);
    $data['rapartment']=$_GET['TYBM'];
	$bmty_model->where("waccount=$waccount")->data($data)->save();
	/*
	//$arrBM=$_GET['BM']['arrBM'];
	//$arrBM[0]['df0'];
	for($i=0;$i<count($arrBM);$i++)
	{
	  //将第i个部门信息存起来
	  unset($data);
	  $data['DF1']=$arrBM[$i]['df0'];
	  $data['DF2']=$arrBM[$i]['df1'];
	  $data['DF3']=$arrBM[$i]['df2'];
	  $data['DF4']=$arrBM[$i]['df3'];
	  $data['DF5']=$arrBM[$i]['df4'];
	  $data['DF6']=$arrBM[$i]['df5'];
	  $data['DF7']=$arrBM[$i]['df6'];
	  $data['total']=
	  $data['DF1']+
	  $data['DF2']+
	  $data['DF3']+
	  $data['DF4']+
	  $data['DF5']+
	  $data['DF6']+
	  $data['DF7'];
	  $bmkh_model->where("(year=$year and month=$month) and (waccount=$account and rapartment=($i+1))")->data($data)->save();
	  //评价
	  unset($data);
	  $data['text']=$arrBM[$i]['pj'];
	  $oneway_model->where("(year=$year and month=$month) and (waccount=$account and rapartment=($i+1))")->data($data)->save();

	}
	//$TYBZ=$_GET['TYBZ'];
	//$bz_account=$TYBZ['account'];
	//$tyly=$TYBZ['tyly'];
	unset($data);
	$data['waccount']=$account;
	$data['raccount']=$_GET['TYBM'];
	//$data['tyly']=$tyly;
	$bzty_model->where("(year=$year and month=$month) and (waccount=$account)")->data($data)->save();
	*/
	//返回信息
    $arr=Array(
	  'status'=>$_GET['TYBM'],
	  'gjbm'=>$_GET['gjbm'],
	  'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE);	    
  }
  //接收优秀部长评定表的数据
  public function post_yxbz()
  {

	//拒绝未登录访问
	session_name('LOGIN');
    session_start();
    if(empty($_SESSION['account']))
      $this->redirect('Login/index');
	//$account=$_SESSION['account'];
	//主席账号
	$waccount=$_SESSION['account'];   
    $yxbz_model=new Model("Yxbz");	
	//将传过来的数据保存到tbl_yxbz中
	if(!empty($_GET['arrIDlist'][0]['account']))
	{
	  $yxbz_info=$yxbz_model->where("waccount=$waccount")->select();
	  foreach($yxbz_info as $v)
	  {
	    unset($data);
	    $data['checked']=0;
		$raccount=$v['raccount'];
		$yxbz_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	  }
      for($i=0;$i<=count($_GET['arrIDlist']);$i++)
	  {
	    unset($data);
	    $data['checked']=1;
		$raccount=$_GET['arrIDlist'][$i]['account'];
	    $yxbz_model->where("waccount=$waccount and raccount=$raccount")->data($data)->save();
	  }
	}
		
	//返回信息
    $arr=Array(
	  'status'=>$_GET['arrIDlist'][0]['account'],
	  'gjbm'=>$_GET['gjbm'],
	  'renshu'=>$_GET['renshu'],
	);
	echo $this->_encode($arr);
  }
  //一键激活，包括：干事自评表，部长自评表，干事自评表，部长考核表，部门考核表
  public function funcyjjh()
  {
    //设置年月
	$year="2014";
	$month="4";
    //一键激活数据库表，包括：
	
	$person_model=new Model("Person");
	$gszp_model=new Model("Gszp");
	$interact_model=new Model("Interact");
	$bzzp_model=new Model("Bzzp");
	$gskh_model=new Model("Gskh");
	$president_model=new Model("President");
	$bzkh_model=new Model("Bzkh");
	$bmkh_model=new Model("Bmkh");
	$oneway_model=new Model("Oneway");
	//出现bug了，应该是bmty
	$bmty_model=new Model("Bzty");
	//找出所有干事
	$person_info=$person_model->where("type=1 or type=2")->select();
	foreach($person_info as $v)
	{
	  $account=$v['account'];
	  //基本信息
	  $apartment=$v['apartment'];
	  unset($data);
	  $data['account']=$account;
	  $data['apartment']=$v['apartment'];
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['zptext']="空";
	  //干事自评表，每个部门的干事都要初始化
	  $gszp_info=$gszp_model->add($data);
	  //干事推优干事
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['wapartment']=$v['apartment'];
	  $data['wtype']=$v['type'];
	  $data['rapartment']=$v['apartment'];
	  $data['rtype']=$v['type'];
	  $data['text']="空";
	  $interact_model->add($data);
	  //干事对部长的评价
	  //找出所有部长
	  $person_info_bz=$person_model->where("apartment=$apartment and type=3")->select();
	  foreach($person_info_bz as $v_bz)
	  {
        unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$account;
	    $data['wapartment']=$v['apartment'];
	    $data['wtype']=$v['type'];
		$data['raccount']=$v_bz['account'];
	    $data['rapartment']=$v['apartment'];
	    $data['rtype']=3;
		$data['nm']=1;
		$data['text']="空";
		$interact_model->add($data);
	  }
	  
	}
	//干事初始化完成
	//找出所有部长
	$person_info=$person_model->where("type=3")->select();
	foreach($person_info as $v)
	{
	  //基本信息
	  $apartment=$v['apartment'];
	  $account=$v['account'];
	  //部长自评表
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['wapartment']=$apartment;
	  $data['zptext']="空";
	  $bzzp_model->add($data);
	  //该部长对本部门其他部长的评价
	  $person_info_bz=$person_model->where("apartment=$apartment and type=3")->select();
	  foreach($person_info_bz as $v_bz)
	  {
	    if($v_bz['account']==$v['account'])
		  continue;
		unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$account;
	    $data['wapartment']=$apartment;
	    $data['wtype']=3;
		$data['raccount']=$v_bz['account'];
	    $data['rapartment']=$apartment;
	    $data['rtype']=3;
		$data['nm']=1;
		$data['text']="空";
		$interact_model->add($data);
	  }
	  //该部长对其主管副主席的评价
	  //找出主管副主席
	  $person_info_zg=$president_model->where("apartment1=$apartment or apartment2=$apartment")->find();
	  $zg_account=$person_info_zg['account'];
      unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['wapartment']=$apartment;
	  $data['wtype']=3;
      $data['raccount']=$zg_account;
	  $data['rapartment']=12;
	  $data['rtype']=4;
	  $data['text']="空";
      $interact_model->add($data);	
	  $person_info_zxt=$person_model->where("type=4")->select();
	  foreach($person_info_zxt as $v_zxt)
	  {
	    $zxt_account=$v_zxt['account'];
      unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['wapartment']=$apartment;
	  $data['wtype']=3;
      $data['raccount']=$zxt_account;
	  $data['rapartment']=12;
	  $data['rtype']=4;
	  $data['text']="空";
	  $data['nm']=1;
	   $interact_model->add($data);	
	  }
      //干事考核表，对部门所有干事的给分
      //找出该部长所有的干事
      $person_info_gs=$person_model->where("apartment=$apartment and (type=1 or type=2)")->select();
      foreach($person_info_gs as $v_gs)
      {
	    //给干事打分
	    unset($data);
	    $data['year']=$year;
	    $data['month']=$month;	
	    $data['waccount']=$account;	
	    $data['wapartment']=$apartment;
        $data['raccount']=$v_gs['account'];	
			$data['total']=0;
			$data['DF1']=0;
			$data['DF2']=0;
			$data['DF3']=0;
			$data['DF4']=0;
			$data['DF5']=0;
			$data['DF6']=0;
			$data['DF7']=0;
			$data['DF8']=0;
			$data['DF9']=0;
			$data['DF10']=0;
			$data['DF11']=0;
			$data['DF12']=0;
			$data['DF13']=0;
			$data['DF14']=0	;			
		$gskh_model->add($data);
		//对干事评价
		unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$account;
	    $data['wapartment']=$apartment;
	    $data['wtype']=3;
		$data['raccount']=$v_gs['account'];
	    $data['rapartment']=$apartment;
	    $data['rtype']=$v_gs['type'];
		$data['text']="空";
		$interact_model->add($data);
	  }	  
	}
	//部长初始化完成
	//找出所有主席团成员
	$person_info=$person_model->where("type=4")->select();
	var_dump($person_info);
	foreach($person_info as $v)
	{
	  //每个主席团成员都要对其主管的部门的部长进行考核
	  //而主席特殊点，要考核所有部长
	  //基本信息
	  $account=$v['account'];
	  $president_info=$president_model->where("account=$account")->find();

	  //不管是不是主席，都得对非主管部门推优
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  //$data['raccount']
	  $data['tyly']="空";
	  $bmty_model->add($data);
	    if($president_info['is_sub']=='y')//一般主管副主席
		{
		  $apartment_zxt_1=$president_info['apartment1'];
		  //根据第一个部门，对部长、部门进行考核
		  if($apartment_zxt_1!=0)
		  {
		    $person_info_bz=$person_model->where("apartment=$apartment_zxt_1 and type=3")->select();
			foreach($person_info_bz as $v_bz)
			{
			  //进行评分
			  unset($data);
			  $data['waccount']=$account;
			  $data['wapartment']=12;
			  $data['raccount']=$v_bz['account'];
			  $data['rapartment']=$apartment_zxt_1;
			  $data['year']=$year;
			  $data['month']=$month;
			  $bzkh_model->add($data);
			  //进行评价
			  unset($data);
	          $data['year']=$year;
	          $data['month']=$month;
	          $data['waccount']=$account;
	          $data['wapartment']=12;
	          $data['wtype']=4;
		      $data['raccount']=$v_bz['account'];
	          $data['rapartment']=$apartment_zxt_1;
	          $data['rtype']=3;
			  $data['text']="空";
		      $interact_model->add($data);
			}
			//对部门1进行考核
			unset($data);
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$apartment_zxt_1;
			$data['year']=$year;
			$data['month']=$month;
			$data['total']=0;
			$data['DF1']=0;
			$data['DF2']=0;
			$data['DF3']=0;
			$data['DF4']=0;
			$data['DF5']=0;
			$data['DF6']=0;
			$data['DF7']=0;
			$bmkh_model->add($data);
			//对部门的评价
			unset($data);
			$data['year']=$year;
			$data['month']=$month;
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$apartment_zxt_1;
			$data['text']="空";
			$oneway_model->add($data);
		  }
		  $apartment_zxt_2=$president_info['apartment2'];
		  //根据第二个部门，对部长进行考核
		  if($apartment_zxt_2!=0)
		  {
		    $person_info_bz=$person_model->where("apartment=$apartment_zxt_2 and type=3")->select();
			foreach($person_info_bz as $v_bz)
			{
			  //进行评分
			  unset($data);
			  $data['waccount']=$account;
			  $data['wapartment']=12;
			  $data['raccount']=$v_bz['account'];
			  $data['rapartment']=$apartment_zxt_2;
			  $data['year']=$year;
			  $data['month']=$month;
			  $bzkh_model->add($data);
			  //进行评价
			  unset($data);
	          $data['year']=$year;
	          $data['month']=$month;
	          $data['waccount']=$account;
	          $data['wapartment']=12;
	          $data['wtype']=4;
		      $data['raccount']=$v_bz['account'];
	          $data['rapartment']=$apartment_zxt_2;
	          $data['rtype']=3;
			  $data['text']="空";
		      $interact_model->add($data);
			}
			//对部门2进行考核
			unset($data);
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$apartment_zxt_2;
			$data['year']=$year;
			$data['month']=$month;
			$data['total']=0;
			$data['DF1']=0;
			$data['DF2']=0;
			$data['DF3']=0;
			$data['DF4']=0;
			$data['DF5']=0;
			$data['DF6']=0;
			$data['DF7']=0;
			$bmkh_model->add($data);
			//对部门的评价
			unset($data);
			$data['year']=$year;
			$data['month']=$month;
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$apartment_zxt_2;
			$data['text']="空";
			$oneway_model->add($data);
		  }
		}
		else//略叼主席
		{
		  //对管辖内的部长进行评分评价
		  $apartment_zxt_1=$president_info['apartment1'];
		  //根据第一个部门，对部长、部门进行考核
		  if($apartment_zxt_1!=0)
		  {
		    $person_info_bz=$person_model->where("apartment=$apartment_zxt_1 and type=3")->select();
			foreach($person_info_bz as $v_bz)
			{
			  //进行评分
			  unset($data);
			  $data['waccount']=$account;
			  $data['wapartment']=12;
			  $data['raccount']=$v_bz['account'];
			  $data['rapartment']=$apartment_zxt_1;
			  $data['year']=$year;
			  $data['month']=$month;
			  $bzkh_model->add($data);
			  //进行评价
			  unset($data);
	          $data['year']=$year;
	          $data['month']=$month;
	          $data['waccount']=$account;
	          $data['wapartment']=12;
	          $data['wtype']=4;
		      $data['raccount']=$v_bz['account'];
	          $data['rapartment']=$apartment_zxt_1;
	          $data['rtype']=3;
			  $data['text']="空";
		      $interact_model->add($data);
			}
		  }
		  $apartment_zxt_2=$president_info['apartment2'];
		  //根据第二个部门，对部长进行考核
		  if($apartment_zxt_2!=0)
		  {
		    $person_info_bz=$person_model->where("apartment=$apartment_zxt_2 and type=3")->select();
			foreach($person_info_bz as $v_bz)
			{
			  //进行评分
			  unset($data);
			  $data['waccount']=$account;
			  $data['wapartment']=12;
			  $data['raccount']=$v_bz['account'];
			  $data['rapartment']=$apartment_zxt_2;
			  $data['year']=$year;
			  $data['month']=$month;
			  $bzkh_model->add($data);
			  //进行评价
			  unset($data);
	          $data['year']=$year;
	          $data['month']=$month;
	          $data['waccount']=$account;
	          $data['wapartment']=12;
	          $data['wtype']=4;
		      $data['raccount']=$v_bz['account'];
	          $data['rapartment']=$apartment_zxt_2;
	          $data['rtype']=3;
			  $data['text']="空";
		      $interact_model->add($data);
			}
		}
		  //对11个部门进行考核
		  echo $account."</br>";
		  for($i=1;$i<=11;$i++)
		  {
			//对部门$i进行考核
			unset($data);
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$i;
			$data['year']=$year;
			$data['month']=$month;
			$data['total']=0;
			$data['DF1']=0;
			$data['DF2']=0;
			$data['DF3']=0;
			$data['DF4']=0;
			$data['DF5']=0;
			$data['DF6']=0;
			$data['DF7']=0;
			
			$bmkh_model->add($data);
			//对部门的评价
			unset($data);
			$data['year']=$year;
			$data['month']=$month;
			$data['waccount']=$account;
			$data['wapartment']=12;
			$data['rapartment']=$i;
			$data['text']="空";
			$oneway_model->add($data);
		  }
	  }
	
  }  
} 
//上面的一键激活中，部门推优写错了，写成部长推优
//一键考核补充：主席团的部门推优
public function funcinitbmty()
{
    $year="2014";
	$month="4";
	//找出所有主席团成员
	$person_model=new Model("Person");
	$bmty_model=new Model("Bmty");
	$person_info=$person_model->where("type=4")->select();
	//var_dump($person_info);
	foreach($person_info as $v)
	{
	  //每个主席团成员都要对其主管的部门的部长进行考核
	  //而主席特殊点，要考核所有部长
	  //基本信息
	  $account=$v['account'];


	  //不管是不是主席，都得对非主管部门推优
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['rapartment']=1;
	  $data['tyly']="空";
	  if($bmty_model->add($data))
	    echo "部长推优添加成功";
	}
}

//一键考核补充：成该月份的干事反馈表
public function funcinitgsfk()
{
  $year="2014";
  $month="4";
  $person_model=new Model("Person");
  $gsfk_model=new Model("Gsfk");
  //找到所有的干事
  $person_info=$person_model->where("type=1 or type=2")->select();
  foreach($person_info as $v)
  {
    echo $v['account']."</br>";
    unset($data);
	$data['year']=$year;
	$data['month']=$month;
	$data['account']=$v['account'];
	$data['total']=0;
	$data['rank']=0;
	$data['yxgs']=0;
	$data['zpdf']=0;
	$data['bzpjdf']=0;
	$data['cqdf']=0;
	$data['wddf']=0;
	$data['tydf']=0;
	$data['fkdf']=0;
	$data['qtdf']=0;
	if($gsfk_model->add($data))
	 echo $v['account']."初始成功";
	else 
	 echo $v['account']."初始错误";
  }
}
  //一键考核补充：该月份的部长反馈表
  public function funcinitbzfk()
  {
    //找出所有的部长
	$year="2014";
	$month="4";
	$person_model=new Model("Person");
	$bzfk_model=new Model("Bzfk");
	$person_info=$person_model->where("type=3")->select();
	foreach($person_info as $v)
	{
	  $bz_account=$v['account'];
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['account']=$bz_account;
	  $data['total']=0;
	  $data['rank']=0;
	  $data['yxbz']=0;
	  $data['zpdf']=0;
	  $data['zxpjdf']=0;
	  $data['gspjdf']=0;
	  $data['bzpjdf']=0;
	  $data['cqdf']=0;
	  $data['wddf']=0;
	  $data['fkdf']=0;
	  $data['qtdf']=0;
	  $bzfk_model->add($data);
	}
  }
 //一键考核补充，该月份的部门反馈表
 public function funcinitbmfk()
 {
   $year="2014";
   $month="4";
   $bmfk_model=new Model("Bmfk");
   //找出11个部门
   for($i=1;$i<=11;$i++)
   {
     unset($data);
	 $data['year']=$year;
	 $data['month']=$month;
	 $data['apartment']=$i;
	 $data['total']=0;
	 $data['rank']=0;
	 $data['yxbm']=0;
	 $data['zxpjdf']=0;
	 $data['zgpjdf']=0;
	 $data['cqdf']=0;
	 $data['wgkf']=0;
	 $data['fkdf']=0;
	 $data['tydf']=0;
	 $data['qtdf']=0;
	 $data['yxbz']=0;
	 $bmfk_model->add($data);
   }
 }
 //一键考核补充：该月的优秀部长评定表
  public function funcinityxbz()
  {
    $year="2014";
	$month="4";
    //找到所有主席
	$person_model=new Model("Person");
	$yxbz_model=new Model("Yxbz");
	$president_model=new Model("President");
	$yxbzhx_model=new Model("Yxbzhx");
	$yxbzhx_info=$yxbzhx_model->select();
    //从优秀部长候选中选
	$person_model=$person_model->where("type=4")->select();
	foreach($person_model as $v)
	{
	  //必须投四个部长
	  foreach($yxbzhx_info as $v_hx)
	  {
	    unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$v['account'];
		$data['raccount']=$v_hx['HX'];
		//被投部长默认为空，方便使用是用empty()判断
	    $data['checked']=0;
		$yxbz_model->add($data);
     }
   }
  }
 //一键考核补充，该月的外调次数表
 public function funcinitwdcs()
 {
   $year="2014";
   $month="4";
   $wdcs_model=new Model("Wdcs");
   $person_model=new Model("Person");
   //每个部门的干事初始化
   for($i=1;$i<=11;$i++)
   {
     $person_info=$person_model->where("apartment=$i and (type=1 or type=2)")->select();
	 foreach($person_info as $v)
	 {
	   unset($data);
	   $data['year']=$year;
	   $data['month']=$month;
	   $data['account']=$v['account'];
	   $data['wdcs']=0;
	   $data['rank']=0;
	   $wdcs_model->add($data);
	 }
   }
 }
  //成员的原始添加
  public function funcaddperson()
  {
 //主席团
$this->funcinsert("2011052351", "邓蔓菁", "2011052351", 4, 12);
$this->funcinsert("2011052363", "何颖欣", "2011052363", 4, 12);
$this->funcinsert("2011052418", "施国安", "2011052418", 4, 12);
$this->funcinsert("2011052473", "陈浩龙", "2011052473", 4, 12);
$this->funcinsert("2011052449", "盛茗珉", "2011052449", 4, 12);
$this->funcinsert("2011052364", "区靖雯", "2011052364", 4, 12);

//秘书处
$this->funcinsert("2012052297", "田聪聪", "2012052297", 3, 1);
$this->funcinsert("2012052345", "吴英文", "2012052345", 3, 1);
$this->funcinsert("2012053187", "刘小洁", "2012053187", 3, 1);
$this->funcinsert("2013053073", "张春梅", "2013053073", 1, 1);
$this->funcinsert("2013053193", "韦长杰", "2013053193", 1, 1);
$this->funcinsert("2013053064", "张雪", "2013053064", 1, 1);
$this->funcinsert("2013053068", "周可慧", "2013053068", 1, 1);
$this->funcinsert("2013053176", "温武佑", "2013053176", 1, 1);
$this->funcinsert("2013053089", "黄芷然", "2013053089", 1, 1);
$this->funcinsert("2013053106", "张舒婧", "2013053106", 1, 1);
$this->funcinsert("2013053091", "李薛毅", "2013053091", 1, 1);
$this->funcinsert("2013052949", "李辉峰", "2013052949", 1, 1);
$this->funcinsert("2013053122", "张雨晨", "2013053122", 1, 1);

//编辑部
$this->funcinsert("2012052358", "周嘉林", "2012052358", 3, 4);
$this->funcinsert("2012052306", "彭冬毡", "2012052306", 3, 4);
$this->funcinsert("2012052300", "何景源", "2012052300", 3, 4);
$this->funcinsert("2013052952", "薛梦钰", "2013052952", 1, 4);
$this->funcinsert("2013053166", "李露", "2013053166", 1, 4);
$this->funcinsert("2013053149", "罗婕", "2013053149", 1, 4);
$this->funcinsert("2013053136", "张蕾", "2013053136", 1, 4);
$this->funcinsert("2013053195", "周莹", "2013053195", 1, 4);
$this->funcinsert("2013053235", "王嘉仪", "2013053235", 1, 4);
$this->funcinsert("2013053054", "高耀源", "2013053054", 1, 4);
$this->funcinsert("2013053035", "郭兆能", "2013053035", 1, 4);
$this->funcinsert("2013053053", "杨卓权", "2013053053", 1, 4);
$this->funcinsert("2013053013", "吕俊龙", "2013053013", 1, 4);
$this->funcinsert("2013053098", "马坚津", "2013053098", 1, 4);
$this->funcinsert("2013052960", "黄搁贤", "2013052960", 1, 4);

//人力资源部
$this->funcinsert("2012052180", "卢思翰", "2012052180", 3, 2);
$this->funcinsert("2012052195", "陈蔚", "2012052195", 3, 2);
$this->funcinsert("2012052339", "陈康明", "2012052339", 3, 2);
$this->funcinsert("2013053175", "凌旺", "2013053175", 2, 2);
$this->funcinsert("2013053188", "陈桂涛", "2013053188", 2, 2);
$this->funcinsert("2013053189", "曾治金", "2013053189", 2, 2);
$this->funcinsert("2013053062", "彭勃", "2013053062", 2, 2);
$this->funcinsert("2013053092", "郑桂坤", "2013053092", 2, 2);
$this->funcinsert("2013053219", "欧海杰", "2013053219", 2, 2);
$this->funcinsert("2013053162", "董彩芹", "2013053162", 2, 2);
$this->funcinsert("2013053146", "李慧婷", "2013053146", 2, 2);
$this->funcinsert("2013053015", "高琳", "2013053015", 2, 2);
$this->funcinsert("2013053241", "余臻", "2013053241", 2, 2);
$this->funcinsert("2013053207", "陈玥轩", "2013053207", 2, 2);

//组织部
$this->funcinsert("2012052194", "陈慧莹", "2012052194", 3, 8);
$this->funcinsert("2012052206", "叶伟珊", "2012052206", 3, 8);
$this->funcinsert("2013053017", "李荣荣", "2013053017", 1, 8);
$this->funcinsert("2013053228", "张锴翰", "2013053228", 1, 8);
$this->funcinsert("2013053107", "王俊淞", "2013053107", 1, 8);
$this->funcinsert("2013053245", "冯梦西", "2013053245", 1, 8);
$this->funcinsert("2013053072", "张丹瑜", "2013053072", 1, 8);
$this->funcinsert("2013053143", "何楚仪", "2013053143", 1, 8);
$this->funcinsert("2013053215", "陈晓琳", "2013053215", 1, 8);
$this->funcinsert("2013053206", "陆  涛", "2013053206", 1, 8);
$this->funcinsert("2013053087", "曾  凯", "2013053087", 1, 8);
$this->funcinsert("2013053002", "张伟龙", "2013053002", 1, 8);


//宣传部
$this->funcinsert("2012052201","陈杰东","2012052201",3,3);//部长
$this->funcinsert("2012052331","周敏妹","2012052331",3,3);
$this->funcinsert("2012052245","邓小东","2012052245",3,3);
$this->funcinsert("2013053101","陈焕杰","2013053101",1,3);//干事
$this->funcinsert("2013052974","崔良梁","2013052974",1,3);
$this->funcinsert("2013053004","郭雪瑶","2013053004",1,3);
$this->funcinsert("2013052977","何雪","2013052977",1,3);
$this->funcinsert("2013053187","洪升耿","2013053187",1,3);
$this->funcinsert("2013052958","李进杰","2013052958",1,3);
$this->funcinsert("2013053007","林宏端","2013053007",1,3);
$this->funcinsert("2013053218","林伟南","2013053218",1,3);
$this->funcinsert("2013053005","林炜哲","2013053005",1,3);
$this->funcinsert("2013053067","刘英琪","2013053067",1,3);
$this->funcinsert("2013053042","陆舒豪","2013053042",1,3);
$this->funcinsert("2013053249","罗臻","2013053249",1,3);
$this->funcinsert("2013052987","马泽钰","2013052987",1,3);
$this->funcinsert("2013052966","许仲毅","2013052966",1,3);
$this->funcinsert("2013053071","唐睿婕","2013053071",1,3);

//学术部
$this->funcinsert("2012052254","冯泳钊","2012052254",3,5);//部长
$this->funcinsert("2012052377","余玫佳","2012052377",3,5);
$this->funcinsert("2013053167","张丹","2013053167",3,5);
$this->funcinsert("2013053145","伍书怡","2013053145",1,5);//干事
$this->funcinsert("2013053202","方力","2013053202",1,5);
$this->funcinsert("2013053065","凡梦霞","2013053065",1,5);
$this->funcinsert("2013053038","纪杰伦","2013053038",1,5);
$this->funcinsert("2013053034","谭灼伟","2013053034",1,5);
$this->funcinsert("2013052983","郝天英","2013052983",1,5);
$this->funcinsert("2013053024","张明珠","2013053024",1,5);

//公关部
$this->funcinsert("2012052296","苏迪","2012052296",3,10);//部长
$this->funcinsert("2012052348","曾炜瑶","2012052348",3,10);
$this->funcinsert("2012052338","李惠贤","2012052338",3,10);
$this->funcinsert("2013053117","李雁婷","2013053117",1,10);//干事
$this->funcinsert("2013053111","王冕","2013053111",1,10);
$this->funcinsert("2013053047","李澳","2013053047",1,10);
$this->funcinsert("2013053099","胡钦楼","2013053099",1,10);
$this->funcinsert("2013053240","蒋芷若","2013053240",1,10);
$this->funcinsert("2013053025","管必成","2013053025",1,10);
$this->funcinsert("2013053211","魏春雪","2013053211",1,10);
$this->funcinsert("2013053223","范施雅","2013053223",1,10);
$this->funcinsert("2013053082","曹琉","2013053082",1,10);
$this->funcinsert("2013053119","张宇豪","2013053119",1,10);
$this->funcinsert("2013052982","王馨茁","2013052982",1,10);
$this->funcinsert("2013053047","何文聪","2013053047",1,10);

//体育部
$this->funcinsert("2012052282","黄柳朋","2012052282",3,6);//部长
$this->funcinsert("2012053229","奚云逸","2012053229",3,6);
$this->funcinsert("2012052264","伍亚星","2012052264",3,6);
$this->funcinsert("2012052281","袁月明","2012052281",3,6);
$this->funcinsert("2013053139","范露","2013053139",1,6);//干事
$this->funcinsert("2013053095","邢建坤","2013053095",1,6);
$this->funcinsert("2013053123","李佳","2013053123",1,6);
$this->funcinsert("2013053037","陈高敏","2013053037",1,6);
$this->funcinsert("2013053213","谷博珊","2013053213",1,6);
$this->funcinsert("2013053088","李健龙","2013053088",1,6);
$this->funcinsert("2013052950","叶冠宇","2013052950",1,6);
$this->funcinsert("2013053093","邓阳","2013053093",1,6);
$this->funcinsert("2013052970","黄帝玲","2013052970",1,6);
$this->funcinsert("2013053134","李萍","2013053134",1,6);
$this->funcinsert("2013053157","李文想","2013053157",1,6);
$this->funcinsert("2013055027","陈有铭","2013055027",1,6);
$this->funcinsert("2013053171","赵耀之","2013053171",1,6);
$this->funcinsert("2013052393","陈泓锡","2013052393",1,6);
$this->funcinsert("2013053178","汤炜聪","2013053178",1,6);

//文娱部
$this->funcinsert("2012052364","陈敏慧","2012052364",3,9);
$this->funcinsert("2012052321","李慈","2012052321",3,9);
$this->funcinsert("2012053203","许莉婍","2012053203",3,9);
$this->funcinsert("2013053127","冯帆","2013053127",1,9);
$this->funcinsert("2013053151","陈雁佳","2013053151",1,9);
$this->funcinsert("2013053028","吴梦宇","2013053028",1,9);
$this->funcinsert("2013053110","周开泰","2013053110",1,9);
$this->funcinsert("2013053232","吴国山","2013053232",1,9);
$this->funcinsert("2013053179","陈旭琳","2013053179",1,9);
$this->funcinsert("2013057131","王业德","2013057131",1,9);
$this->funcinsert("2013053010","阮振杰","2013053010",1,9);
$this->funcinsert("2013053194","潘怡君","2013053194",1,9);
$this->funcinsert("2013052986","高艳阳","2013052986",1,9);
$this->funcinsert("2013053059","母国良","2013053059",1,9);
$this->funcinsert("2013053238","冉超","2013053238",1,9);

//KSC联盟
$this->funcinsert("2012053245","苗效毅","2012053245",3,7);
$this->funcinsert("2012052275","庄双玲","2012052275",3,7);
$this->funcinsert("2013052990","蓝梓蓉","2013052990",1,7);
$this->funcinsert("2011052449","李耀猛","2011052449",1,7);
$this->funcinsert("2013053220","莫敏华","2013053220",1,7);
$this->funcinsert("2013052991","龙伟强","2013052991",1,7);
$this->funcinsert("2013053026","孙雯曦","2013053026",1,7);
$this->funcinsert("2013052992","覃振宇","2013052992",1,7);
$this->funcinsert("2013053181","邵天木","2013053181",1,7);
$this->funcinsert("2013053158","杨雅希","2013053158",1,7);
$this->funcinsert("2013053125","余海铭","2013053125",1,7);
$this->funcinsert("2013053020","徐冬","2013053020",1,7);

//心理服务部
$this->funcinsert("2012053239","杨帅","2012053239",3,11);
$this->funcinsert("2012052294","田淼蕾","2012052294",3,11);
$this->funcinsert("2013053174","谢思维","2013053174",1,11);
$this->funcinsert("2013052297","陈昱栋","2013052297",1,11);
$this->funcinsert("2013053008","梁茗皓","2013053008",1,11);
$this->funcinsert("2013052993","骆竞潮","2013052993",1,11);
$this->funcinsert("2013053155","梁义千","2013053155",1,11);
$this->funcinsert("2013053160","石芮","2013053160",1,11);
$this->funcinsert("2013053165","孙铭谦","2013053165",1,11);


   
  
  }
 public function funcinsert($account,$name,$password,$type,$apartment)
{
$data['account']=$account;//"2012052308";//账号
$data['name']=$name;//"朱林杰";//名字
$data['password']=$password;//"2012052308";//初始密码
$data['type']=$type;//1;//类型
$data['apartment']=$apartment;//1;//部门
$person_model=new Model("Person");
$person_model->add($data);

}
/*
public function changename()
{
  $person_model=new Model("Person");
  $data['name']="何文聪";
  $person_info=$person_model->where("account='2013053047'")->data($data)->save();
  echo $person_info;
}
  */
  public function funccrud()
  {
    //删除信息
   // $this->funcdelete("2013053057");
	//$this->funcdelete("2013053167");
	//添加个人信息
   // $this->funcinsert("2013053167","张丹","2013053167",1,5);
	//$this->funcinsert("2013053057","李澳","2013053057",1,10);
	//本次考核
	//$this->funcadd("2013053167",5,1);
	//$this->funcadd("2013053057",10,1);
	//$this->funcdelete("2013053094");
	//$this->funcinsert("2013053094","李耀猛","2013053094",1,7);
	//$this->funcadd("2013053094",7,1);
	//出于某原因，干事考核表有些漏填，现在以程序形式补上
	/*
	$gsfk_model=new Model("Gsfk");
	$gskh_model=new Model("Gskh");
	$person_model=new Model("Person");
	//添加周嘉林
	$person_info=$person_model->where("apartment=4 and type=1")->select();
	foreach($person_info as $v)
	{
	$gskh_info1=$gskh_model->where("waccount='2012052306' and raccount=$gs_account")->find();
	$gskh_info2=$gskh_model->where("waccount='2012052300' and raccount=$gs_account")->find();
	$gs_account=$v['account'];	
	$data['DF1']=($gskh_info1['DF1']+$gskh_info2['DF1'])/2;
	$data['DF2']=($gskh_info1['DF2']+$gskh_info2['DF2'])/2;
	$data['DF3']=($gskh_info1['DF3']+$gskh_info2['DF3'])/2;
	$data['DF4']=($gskh_info1['DF4']+$gskh_info2['DF4'])/2;
	$data['DF5']=($gskh_info1['DF5']+$gskh_info2['DF5'])/2;
	$data['DF6']=($gskh_info1['DF6']+$gskh_info2['DF6'])/2;
	$data['DF7']=($gskh_info1['DF7']+$gskh_info2['DF7'])/2;
	$data['DF8']=($gskh_info1['DF8']+$gskh_info2['DF8'])/2;
	$data['DF9']=($gskh_info1['DF9']+$gskh_info2['DF9'])/2;
	$data['DF10']=($gskh_info1['DF10']+$gskh_info2['DF10'])/2;
	$data['DF11']=($gskh_info1['DF11']+$gskh_info2['DF11'])/2;
	$data['DF12']=($gskh_info1['DF12']+$gskh_info2['DF12'])/2;
	$data['DF13']=($gskh_info1['DF13']+$gskh_info2['DF13'])/2;
	$data['DF14']=($gskh_info1['DF14']+$gskh_info2['DF14'])/2;
	$gskh_model->where("waccount='2012052358' and  raccount=$gs_account")->data($data)->save();
	}
	//添加陈杰东
	$person_info=$person_model->where("apartment=3 and type=1")->select();
	foreach($person_info as $v)
	{
	$gskh_info1=$gskh_model->where("waccount='2012052331' and raccount=$gs_account")->find();
	$gskh_info2=$gskh_model->where("waccount='2012052245' and raccount=$gs_account")->find();
	$gs_account=$v['account'];	
	$data['DF1']=($gskh_info1['DF1']+$gskh_info2['DF1'])/2;
	$data['DF2']=($gskh_info1['DF2']+$gskh_info2['DF2'])/2;
	$data['DF3']=($gskh_info1['DF3']+$gskh_info2['DF3'])/2;
	$data['DF4']=($gskh_info1['DF4']+$gskh_info2['DF4'])/2;
	$data['DF5']=($gskh_info1['DF5']+$gskh_info2['DF5'])/2;
	$data['DF6']=($gskh_info1['DF6']+$gskh_info2['DF6'])/2;
	$data['DF7']=($gskh_info1['DF7']+$gskh_info2['DF7'])/2;
	$data['DF8']=($gskh_info1['DF8']+$gskh_info2['DF8'])/2;
	$data['DF9']=($gskh_info1['DF9']+$gskh_info2['DF9'])/2;
	$data['DF10']=($gskh_info1['DF10']+$gskh_info2['DF10'])/2;
	$data['DF11']=($gskh_info1['DF11']+$gskh_info2['DF11'])/2;
	$data['DF12']=($gskh_info1['DF12']+$gskh_info2['DF12'])/2;
	$data['DF13']=($gskh_info1['DF13']+$gskh_info2['DF13'])/2;
	$data['DF14']=($gskh_info1['DF14']+$gskh_info2['DF14'])/2;
	$gskh_model->where("waccount='2012052201' and  raccount=$gs_account")->data($data)->save();
	}
*/
  //优秀干事称号限制：
  /*
  $yxchxz_model=new Model("Yxchxz");
  $data['account']="2013053175"; 
  $yxchxz_model->add($data);
  $data['account']="2013053188";  
  $yxchxz_model->add($data);
  $data['account']="2013053189";
$yxchxz_model->add($data);  
  $data['account']="2013053062";
$yxchxz_model->add($data);  
  $data['account']="2013053092";
$yxchxz_model->add($data);  
  $data['account']="2013053219";
$yxchxz_model->add($data);  
  $data['account']="2013053162";
$yxchxz_model->add($data);  
  $data['account']="2013053146"; 
$yxchxz_model->add($data);  
  $data['account']="2013053015"; 
$yxchxz_model->add($data);  
  $data['account']="2013053241";
$yxchxz_model->add($data);  
  $data['account']="2013053207";
$yxchxz_model->add($data);  
  $data['account']="2013053117";
$yxchxz_model->add($data);  
  $data['account']="2013053111";
$yxchxz_model->add($data);  
  $data['account']="2013053047"; 
$yxchxz_model->add($data);  
  $data['account']="2013053099";
$yxchxz_model->add($data);  
  $data['account']="2013053240";
$yxchxz_model->add($data);  
  $data['account']="2013053025";
$yxchxz_model->add($data);  
  $data['account']="2013053211";
$yxchxz_model->add($data);  
  $data['account']="2013053223";
$yxchxz_model->add($data);  
  $data['account']="2013053082";
$yxchxz_model->add($data);  
  $data['account']="2013053119";
$yxchxz_model->add($data);
  $data['account']="2013052982";
  $yxchxz_model->add($data);
  $data['account']="2013053047";
  $yxchxz_model->add($data);
  */
  //被限制的账号补充
  $yxchxz_model=new Model("Yxchxz");
  //$data['account']="2013053057";
  //$yxchxz_model->add($data);
  //$data['account']="2013053213";
  //$yxchxz_model->add($data);
}
//删除部长，干事记录
  public function funcdelete($account)
  {
    $person_model=new Model("Person");
	$interact_model=new Model("Interact");
	$bzzp_model=new Model("Bzzp");
	$bzkh_model=new Model("Bzkh");
	$gszp_model=new Model("Gszp");
	$gskh_model=new Model("Gskh");

	$president_model=new Model("President");
	$account=$account;//"2013053167";
	$year="2014";
	$month="4";
	//删掉成员信息
	$person_model->where("account=$account")->delete();
	//删掉部长记录
	$interact_model->where("waccount=$account")->delete();
	$interact_model->where("raccount=$account")->delete();
	$bzzp_model->where("waccount=$account")->delete();
	$bzkh_model->where("raccount=$account")->delete();
	//$president_model->where("raccount=$account")->delete();
	//删除干事记录
	
	$gszp_model->where("account=$account")->delete();
	$interact_model->where("waccount=$account")->delete();
	$interact_model->where("raccount=$account")->delete();

	  
	}
	
	public function funcadd($account,$apartment,$type)
    {
 //一键激活数据库表，包括：
	$year="2014";
	$month="4";
	$person_model=new Model("Person");
	$gszp_model=new Model("Gszp");
	$interact_model=new Model("Interact");
	$bzzp_model=new Model("Bzzp");
	$gskh_model=new Model("Gskh");
	$president_model=new Model("President");
	$bzkh_model=new Model("Bzkh");
	$bmkh_model=new Model("Bmkh");
	$oneway_model=new Model("Oneway");
	$bmty_model=new Model("Bzty");
	//找出所有干事
	$person_info=$person_model->where("account=$account ")->select();
	foreach($person_info as $v)
	{
	  $account=$v['account'];
	  //基本信息
	  $apartment=$v['apartment'];
	  unset($data);
	  $data['account']=$account;
	  $data['apartment']=$v['apartment'];
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['zptext']="空";
	  //干事自评表，每个部门的干事都要初始化
	  if($gszp_model->add($data))
	    echo $account."添加成功";
	  //干事推优干事
	  unset($data);
	  $data['year']=$year;
	  $data['month']=$month;
	  $data['waccount']=$account;
	  $data['wapartment']=$v['apartment'];
	  $data['wtype']=$v['type'];
	  $data['rapartment']=$v['apartment'];
	  $data['rtype']=$v['type'];
	  $data['text']="空";
	  if($interact_model->add($data))
	     echo $account."添加成功";
	  //干事对部长的评价
	  //找出所有部长
	  $person_info_bz=$person_model->where("apartment=$apartment and type=3")->select();
	  foreach($person_info_bz as $v_bz)
	  {
        unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$account;
	    $data['wapartment']=$v['apartment'];
	    $data['wtype']=$v['type'];
		$data['raccount']=$v_bz['account'];
	    $data['rapartment']=$v['apartment'];
	    $data['rtype']=3;
		$data['nm']=1;
		$data['text']="空";
		if($interact_model->add($data))
		   echo $account."添加成功";
	  }
	  
	}
	//干事初始化完成

	
	
	//找出所有部长
	$person_info=$person_model->where("type=3 and apartment=$apartment")->select();
	foreach($person_info as $v)
	{
	  //基本信息
	  $bz_apartment=$v['apartment'];
	  $bz_account=$v['account'];

      //干事考核表，对部门所有干事的给分
      //找出该部长所有的干事
      $person_info_gs=$person_model->where("account=$account")->select();
      foreach($person_info_gs as $v_gs)
      {
	    //给干事打分
	    unset($data);
	    $data['year']=$year;
	    $data['month']=$month;	
	    $data['waccount']=$bz_account;	
	    $data['wapartment']=$bz_apartment;
        $data['raccount']=$v_gs['account'];	
			$data['total']=0;
			$data['DF1']=0;
			$data['DF2']=0;
			$data['DF3']=0;
			$data['DF4']=0;
			$data['DF5']=0;
			$data['DF6']=0;
			$data['DF7']=0;
			$data['DF8']=0;
			$data['DF9']=0;
			$data['DF10']=0;
			$data['DF11']=0;
			$data['DF12']=0;
			$data['DF13']=0;
			$data['DF14']=0	;			
		$gskh_model->add($data);
		//对干事评价
		unset($data);
	    $data['year']=$year;
	    $data['month']=$month;
	    $data['waccount']=$bz_account;
	    $data['wapartment']=$bz_apartment;
	    $data['wtype']=3;
		$data['raccount']=$v_gs['account'];
	    $data['rapartment']=$apartment;
	    $data['rtype']=$v_gs['type'];
		$data['text']="空";
		$interact_model->add($data);
	  }	  
	}
	//部长初始化完成
	}
public function functest()
{
  $arr=Array(
    'status'=>$_GET['arrIDlist'][0]['account'],
  );
  echo $this->_encode($arr);
}	
  }
?>