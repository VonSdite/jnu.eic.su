<?php if (!defined('THINK_PATH')) exit();?>﻿<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="EN" xml:lang="EN">
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!--说明字符集-->
	<meta http-equiv="content-language" content="zh-CN" /><!--说明语言-->
	<meta name="author" content="ZuohengDeng" /><!--作者-->
	<meta name="copyright" content="jnu.ksc" /><!--声明版权-->
	
	
	<link rel="shortcut icon" href="__PUBLIC__/image/logo.jpg" />
	
	<link href="__PUBLIC__/css/perform.css"			type="text/css"		rel="stylesheet" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/admin.js"></script>
    <script type="text/javascript">
        var URL = "__URL__";
        var APP = "__APP__";
        var ROOT = "__ROOT__";
		var PUBLIC="__PUBLIC__";
		//ajax请求
		var obj;
	    $.ajax({
		url:URL+"/funcBindInfo",
		data:{},
		async:false,
		dataType:"json",
		type:"POST",
		success:function(result){obj=result;}
		});
    </script>	
	<style>
		*{font-family:"Microsoft YaHei UI","Microsoft YaHei","微软雅黑","宋体";}
		table.erjibiao th{text-align:left;}
		table.erjibiao td.normal_input,th.normal_input{padding-left:10px;}
		h2{color:#018f89;font-weight:normal;}
		
	</style>
	
	<title>暨南大学电气信息学院团委学生会-管理员</title>
	</head>
	<body>
		<!--指定主席团主管部门-->
		<form name="bind-depart-chairman" id="bind-depart-chairman" method="post" action="#">
			加载中...
		</form>
	</body>
</html>