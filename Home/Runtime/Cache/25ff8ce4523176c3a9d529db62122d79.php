<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="EN" xml:lang="EN">
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!--说明字符集-->
	<meta http-equiv="content-language" content="zh-CN" /><!--说明语言-->
	<meta name="author" content="ZuohengDeng" /><!--作者-->
	<meta name="copyright" content="jnu.ksc" /><!--声明版权-->
	<meta name="description" content="电气信息学院团委学生会门户网站" /><!--网站概述-->
	<meta name="keywords" content="暨大 暨南大学 电气院 电气信息学院 团委学生会 暨南大学电气信息学院团委学生会 团委学生会首页" /><!--关键词-->
	<meta name="keywords" content="Electrcal and Information College of Jinan University Youth League Committee Student Union" />
	
	<link rel="shortcut icon" href="__PUBLIC__/image/logo.jpg" />
	
	<link href="__PUBLIC__/css/stdindex_footer.css" 	type="text/css" 	rel="stylesheet" />
	<link href="__PUBLIC__/css/stdindex_title.css" 	type="text/css" 	rel="stylesheet" />
	<link href="__PUBLIC__/css/home.css"				type="text/css"		rel="stylesheet" />
	<script type="text/javascript" src="__PUBLIC__/js/news_javascript.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/searchbutton.js"></script>
	
	<title>暨南大学电气信息学院团委学生会</title>
	</head>
	<body>
		<div id="hdr">
			<div id="hdr_main">
				<div id="hdr_top">
					<!--表头徽标-->
					<div id="logo">
						<img src="__PUBLIC__/image/std_title_logo.png" width="54px" height="54px" alt="团委学生会的徽标"/>
					</div>
					<!--标题-->
					<div id="title">
						<p id="chs_title">
							暨南大学电气信息学院团委学生会
						</p>
						<p id="eng_title">
							Electrcal and Information College of Jinan University Youth League Committee &#38; Student Union
						</p>
						<div id="help_nav">
							<!--这里几个链接的url还没决定的-->
							<a class="head_help_nav" href="liaojie.html">了解团委学生会</a>
							<a class="head_help_nav" href="caozuofangfa.html">操作方法</a>
							<a class="head_help_nav" href="zhichi.html">支持</a>
						</div>
						
						
					</div>
					
					<div id="search_and_info">
					
						<!--站内搜索框，样式和代码均未完成-->
						<div id="search_bar">
							<input type="text" name="q" id="query" title="站内搜索" />
							<button type="submit" name="qsub" id="searchsubmit" title="搜索" value="" ><img src="__PUBLIC__/image/site_search.png" alt="搜索按钮徽标" /></button>
						</div>
					
						<!--用户信息，未登陆是为“登陆”锚标签，登陆后为“用户名”，“个人中心”，“注销”3个锚标签-->
						<div id="login_info">
							<a class="user_info" id="login_info_user_name" href="#">邓作恒</a>
							<a class="user_info" id="login_info_user_id" href="#">2012052207</a>
							<a class="user_info" id="login_info_user_center" href="#">个人中心</a>
							<a class="user_info" id="login_info_log_out" href="#">注销</a>
						</div>
						
					</div>
					
				</div>
			</div>
			<div id="hdr_guide">
				<div id="guide">		
					<div id="guide_table">
						<table id="main_guide">
							<tr>
								<!--这里几个链接的url还没决定的-->
								<td class="about_us_td">
									<a class="main_nav" id="a_home" href="#">首页</a>
								</td>
								<td class="about_us_td">
									<a class="main_nav" id="a_news" href="news.html">新闻中心</a>
								</td>
								<td class="about_us_td">
									<a class="main_nav" id="a_work" href="work.html">学生工作</a>
								</td>
								<td class="about_us_td">
									<a class="main_nav" id="a_act" href="activities.html">活动</a>
								</td>
								<td class="about_us_td">
									<a class="main_nav" id="a_files" href="files.html">现行制度浏览与下载</a>
								</td>
							</tr>
						</table>					
					</div>
				</div>
			</div>
			
		</div>	
		
		<div id="real_body">
			<div id="slide_news">
				<div id="main_news_div">
					<a href="#"><img src="__PUBLIC__/image/news_picture7.jpg" id="pic1" alt="newsPic"/></a>
					<a href="#"><img src="__PUBLIC__/image/news_picture0.jpg" id="pic2" alt="newsPic"/></a>
					<a href="#"><img src="__PUBLIC__/image/news_picture1.jpg" id="pic3" alt="newsPic"/></a>
					
					<div id="news">
						<p id="news_text"></p>
					</div>
					
					<div class="news_slide_button" id="button">
						<img id="pre_news" src="__PUBLIC__/image/pre_mouseout.png" alt="pre_mouseout" />
						<img id="next_news" src="__PUBLIC__/image/next_mouseout.png" alt="next_mouseout" />
					</div>
					
				</div>
				
				<div class="s-mod-hotnews-newstitle-mask" id="mask"></div>
				<div id="news_active">
					<img id="Active" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic1" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic2" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic3" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic4" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic5" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic6" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
					<img id="pic7" src="__PUBLIC__/image/news_mouseout.png" alt="point_buttom" />
				</div>
			</div>
			<div id="main_stu_sys" class="main_right_top">
				<div id="inner_border" >
					
					<div id="performance_system">
						<div class="center_the_logo">
							<a href="#" class="sys_logo_img" id="logo_of_per_sys">
								<img src="__PUBLIC__/image/performance_system_logo.png" width="50px" height="50px" alt="绩效考核系统的徽标" />
							</a>
						</div>
						<p class="sys_alt">
							绩效考核系统
						</p>
					</div>
					<div id="allocate_system">
						<div class="center_the_logo">
							<a href="#" class="sys_logo_img" id="logo_of_alloc_sys">
								<img src="__PUBLIC__/image/allocate_system_logo.png" width="50px" height="50px" alt="人员调配系统的徽标" />
							</a>
						</div>
						<p class="sys_alt">
							人员调配系统
						</p>
					</div>
					
					<div id="secretariat">
						<div class="center_the_logo">
							<a href="#" class="sys_logo_img" id="logo_of_secr_sys">
								<img src="__PUBLIC__/image/secretariat_logo.png" width="50px" height="50px" alt="秘书处的徽标" />
							</a>
						</div>
						<p class="sys_alt">
							秘书处
						</p>
					</div>
				</div>
			</div>
			<div id="hot_and_notice" class="main_right_top">
				<div id="what_s_hot">
					<h2>热点</h2>
					
					<!--这里是热点的几个链接，其中新版首页反馈是基本固定的，其余3个就从新闻、活动的数据库里面检索文章的
					关键词，以访问量和更新日期最好最新的3篇生成链接，锚标签的class是"hot_a"是决定样式的,下面仅举例-->
					<div id="hot_key_word">
						<a href="#" class="hot_a">
							新版首页反馈
						</a>
						<a href="#" class="hot_a">
							APP嘉年华
						</a>
						<a href="#" class="hot_a">
							群雄争霸
						</a>
						<a href="#" class="hot_a">
							留学那点事
						</a>
					</div>
					
					<!--这里是热点活动，从活动的数据库你选取最新的活动文章，生成链接，标签的样式依旧是“hot_a",下面仅举例-->
					<div id="hot_activity">
						<a href="#" class="hot_a">
							KSC程序设计大赛完满落幕
						</a>
						<img src="hot_activity.png" width="36px" height="20px" alt="热点活动" />
					</div>
					<!--这里是取学生工作的数据库中最新的文章-->
						
					<div id="hot_stuwork">
						<a href="#" class="hot_a">
							学长交流会，师生趣味活动
						</a>
						<img src="__PUBLIC__/image/hot_stuwork.png" width="59px" height="20px" alt="热点学生工作" />
					</div>
				</div>
				
				<!--公告栏，建议设专门的公告栏的数据库，因为前端并没有设计更改公告栏的部分，所以公告栏的内容只能
				在后台直接更改数据库，字数限制如下，下面事例恰好占完整个公告栏的div-->
				<!--在学生会为发出第一份公告时，采用默认公告：
					新版首页已正式上线，请使用mozilla firefox或google chrome最新版浏览器以获得最好使用体验
				-->
				<div id="notice">
					<h2>公告</h2>
					新版首页已正式上线，请使用mozilla firefox或google chrome最新版浏览器以获得最好使用体验.
				</div>		
			</div>
			
			<div id="division">
				<hr />
			</div>
		
		
			<!--即将举办也是跟公告栏类似，标题，举办时间，举办地点，口号，举办单位是需要后台写的
			下面的例子中，标题是“诺贝尔数学奖颁奖仪式”
						举办时间是“2月9日星期八”，要包括几月几日星期几
						地点是“学生活动中心15楼”
						口号是“挡我者挂高数”
						举办单位是“KSC联盟，秘书处”
						-->
			<div id="coming_soon">
				<h1>
					即将举办
				</h1>
				<div id="coming_soon_body">
					<div id="coming_activity_info">
						<p id="the_title_of_activity_come_soon">
							诺贝尔数学奖颁奖仪式
						</p>
						<p id="when_the_activity_hold">
							2月29日星期八
						</p>
						<p id="where_the_activity_hold">
							学生活动中心15楼
						</p>
					</div>
					<div id="coming_activity_main_post">
						<img src="__PUBLIC__/image/coming_activity_main_post.png" width="520px" height="380px" alt="活动主海报"/>		
					</div>
					<div id="coming_activity_small_post">
						<div id="small_post_img">
							<img src="__PUBLIC__/image/coming_activity_small_psot.png" width="160px" height="180px" alt="活动副海报"/>
						</div>
						<p id="activity_slogan">
							挡我者挂高数
						</p>
						<p id="activity_sponsor">
							KSC联盟，秘书处
						</p>
						
					</div>
						
				</div>
			</div>
		
		</div>
		
		<div id="footer">
			<div id="footer_bg">
			
				<div id="footer_hr1">
				</div>
				
				<div id="footer_hr2">
				</div>
				<div id="footer_details">
					<div id="footer_main">
						<table id="about_us">
							<thead>
								<tr>
									<th class="footer_about_us_th"></th>								
									<th class="footer_about_us_th">关于我们</th>
									<th class="footer_about_us_th"></th>	
									<th class="footer_about_us_th">关注我们</th>
									<th class="footer_about_us_th"></th>	
									<th class="footer_about_us_th">友情链接</th>
									<th class="footer_about_us_th"></th>	
								</tr>
							</thead>
							<!--以下一系列锚标签的url都是无效的、实验性的-->
							<tbody>
								<tr>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											关于团委学生会
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											新浪微博
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											电气信息学院
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
								</tr>
								<tr>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											免责声明
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											微信
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											信息科学院
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
								</tr>
								<tr>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											联系开发人员
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											人人网
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											暨南风
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
								</tr>
								<tr>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											报告错误
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td">
										<a href="a.html" class="footer_about_a">
											QQ空间
										</a>
									</td>
									<th class="footer_about_us_th"></th>	
									<td class="footer_about_us_td"></td>
									<th class="footer_about_us_th"></th>	
								</tr>
							</tbody>
						</table>
										
						<div id="Copyright">
							<p class="copy_main">Copyright&copy;2014电气信息学院团委学生会</p>
							<p class="copy_main">技术支持:暨南大学KSC联盟</p>
							<p class="copy_main">jnu.ksc@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>