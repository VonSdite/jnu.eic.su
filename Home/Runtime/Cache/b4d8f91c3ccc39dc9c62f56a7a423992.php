<?php if (!defined('THINK_PATH')) exit();?>	<?php  $sto=new SaeStorage(); $domain="upload"; $imgURL=$sto->getUrl($domain,"image/"); if(!IS_SAE) { $imgURL="/".$imgURL; } ?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="EN" xml:lang="EN">
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!--说明字符集-->
	<meta http-equiv="content-language" content="zh-CN" /><!--说明语言-->
	<meta name="author" content="ZuohengDeng" /><!--作者-->
	<meta name="copyright" content="jnu.ksc" /><!--声明版权-->	
	
	<link rel="shortcut icon" href="<?php echo $imgURL;?>logo.jpg" />
	
	<link href="__PUBLIC__/css/stdindex_footer.css" 	type="text/css" 	rel="stylesheet" />
	<link href="__PUBLIC__/css/stdindex_title.css" 	type="text/css" 	rel="stylesheet" />
	<link href="__PUBLIC__/css/usercenter.css"			type="text/css" 	rel="stylesheet" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
	<script  type="text/javascript" src="__PUBLIC__/js/userCenter.js"></script>

	<script type="text/javascript">
        var URL = "__URL__";
        var APP = "__APP__";
        var ROOT = "__ROOT__";
		var PUBLIC = "__PUBLIC__";
    </script>

<!--
	<script>
	$(document).ready(function(){
	var person_info=getjson();
	alert(person_info.name+person_info.account+person_info.sex);
function getjson()
{
	    var obj;
	    $.ajax({
		url:"__URL__/message",
		data:{},
		async:false,
		dataType:"json",
		success:function(result){obj=result;}
		});
		return obj;
}
	    
	});
	</script>
-->
	<title>个人中心-暨南大学电气信息学院团委学生会</title>
	</head>
<body>
		<div id="hdr">
			<div id="hdr_main">
				<div id="hdr_top">
					<!--表头徽标-->
					<div id="logo">
						<img src="<?php echo $imgURL;?>std_title_logo.png" width="54px" height="54px" alt="团委学生会的徽标"/>
					</div>
					<!--标题-->
					<div id="title">
						<p id="chs_title">
							暨南大学电气信息学院团委学生会<span class="subtitle">|个人中心</span>
						</p>
						<p id="eng_title">
							Electrcal and Information College of Jinan University Youth League Committee &#38; Student Union<span class="subtitle">|User Center</span>
						</p>
						<div id="help_nav">
							<a class="head_help_nav" href="liaojie.html">了解团委学生会</a>
							<a class="head_help_nav" href="caozuofangfa.html">操作方法</a>
							<a class="head_help_nav" href="zhichi.html">支持</a>
						</div>		
					</div>
					
					<div id="search_and_info">
						<div id="login_info">
							<a class="user_info" id="login_info_user_name" href="#"><?php echo ($name); ?></a>
							<a class="user_info" id="login_info_user_id" href="#"><?php echo ($account); ?></a>
							<a class="user_info" id="login_info_log_out" href="<?php echo __APP__; ?>/Login/logout">注销</a>
						</div>
					</div>
					
				</div>
			</div>
			<div id="hdr_guide">
				<div id="guide">		
					<button type="button" class="user_center_buttom" id="main_user_info" 	name="main_user_info" 		title="个人资料">
						个人资料
					</button>
					<button type="button" class="user_center_buttom" id="user_kong_ke_biao" name="user_kong_ke_biao" 	title="空课表">
						空课表
					</button>
					<button type="button" class="user_center_buttom" id="user_address_book" name="user_address_book" 	title="通讯录">
						通讯录
					</button>
				</div>
			</div>
			
		</div>
		
		<div id="personal_data">
			
		</div>
		
		<!--下面是个人资料-修改的样式-->
		<div id="change_personal_data">
		
		</div>
		
		<!--下面是个人资料中修改密码的样式-->
		<div id="change_password">

		</div>
		
		<!--下面是空课表的样式-->
		<div id="empty_schedule">
			
		</div>
		
		
		<!--下面是空课表修改的样式-->
		<div id="change_empty_schedule">
			
		</div>
		
		<!--下面是通讯录样式-->
		<div id="contacts_books">

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