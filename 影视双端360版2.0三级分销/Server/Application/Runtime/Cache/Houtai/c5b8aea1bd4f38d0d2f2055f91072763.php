<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/Public/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Public/admin/css/style.css"/>       
        <link href="/Public/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/Public/admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/Public/admin/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/Public/admin/js/jquery-1.9.1.min.js"></script>
		<script src="/Public/admin/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/Public/admin/js/lrtk.js" type="text/javascript" ></script>		
		<script src="/Public/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Public/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/Public/admin/assets/layer/layer.js" type="text/javascript" ></script>          
        <script type="text/javascript" src="/Public/admin/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/Public/admin/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/Public/admin/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/Public/admin/Widget/swfupload/handlers.js"></script>
<title>广告管理</title>
</head>

<body>
<div class=" clearfix" id="advertising">
      <div class="Ads_list Widescreen" style="width: 1709px;">
   <div class="border clearfix">
       <span class="l_f">
        <a href="/Houtai/Adver/add" id="ads_add" class="btn btn-warning"><i class="fa fa-plus"></i> 添加广告</a>
        <!-- <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a> -->
       </span>
       
     </div>
     <div class="Ads_lists">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				
				<th width="40">ID</th>
                <th width="30">排序</th>
				<th width="30">标题</th>
				<th width="120px">图片</th>
				<th width="120px">图片地址</th>
				<th width="150px">链接地址</th>
				
				             
				<th width="150px">操作</th>
			</tr>
		</thead>
	<tbody>
	 <?php if(is_array($mod)): $i = 0; $__LIST__ = $mod;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    
       <td><?php echo ($vo["id"]); ?></td>
       <td><?php echo ($vo["sort"]); ?></td>
       <td><?php echo ($vo["title"]); ?></td>
       <td><span class="ad_img"><img src="<?php echo ($vo["picname"]); ?>" height="80"/></span></td>
   <td><?php echo ($vo["picname"]); ?></td>
       <td><?php echo ($vo["link"]); ?></td>
       
      <td class="td-manage">
        
        <a title="编辑"  href="/Houtai/Adver/edit?id=<?php echo ($vo["id"]); ?>"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>      
         <a title="删除" href="javascript:;"  onclick="member_del(this,<?php echo ($vo["id"]); ?>)"   class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
    </table>
     </div>
 </div>
</div>

</body>
</html>
<script>


/*广告图片-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',{icon:0,},function(index){
		$(obj).parents("tr").remove();
			$.ajax({
						url:"/Houtai/Adver/del",	//请求地址
						type:"get",		//请求方式
						data:{id:id},//发送数据
						async:true,			//异步情趣
						dataType:"text",	//响应数据格式
						 success:function(res){
						 
						 if(res=="y"){
							alert('删除成功');location="./index";	
							}else{
							$("#code").html("");	
							}
						},
					});
		layer.msg('已删除!',{icon:1,time:1000});
	});
}

</script>