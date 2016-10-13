/**
*公共js类库
*
**/
/***********添加*************/
//跳转页面
$('#button-add').click(function(){
    window.location.href=SCOPE.add_url ;
});
//执行表单操作
$('#singcms-button-submit').click(function(){

	var data=$('#singcms-form').serializeArray();
	var postdata={};
	$.each(data,function(i,val){
		postdata[val.name]=val.value;
	});

	var url=SCOPE.save_url;
	$.post(url,postdata,func,'json');
	function func(response){
		if (response.status==0){
			return dialog.error(response.msg);
		}else{
			return dialog.success(response.msg,SCOPE.jump_url)
		}
	}
});
/******************修改********************/
function edit(id){

	var url=SCOPE.edit_url+"&id="+id;
	window.location.href=url;
}

$('#singcms-button-edit').click(function(){
     var data=$('#singcms-form').serializeArray();
     var postdata={};
     $.each(data,function(i,val){
        postdata[val.name]=val.value;
     })

     var url=SCOPE.updata_url;
     $.post(url,postdata,func,'json');
     function func(response){
     	if (response.status ==0){
     		return dialog.error(response.msg);
     	}else{return dialog.success(response.msg,SCOPE.jump_url);}     
     }
});
/******************************删除数据***********************/

function deleteMenu(id){
	
	var url=SCOPE.set_status_url;
	var data={};
	data['id']=id;
	data['status']=-1;
	layer.open({
		type:0,
		title:'是否提交',
		btn:['yes','no'],
		icon:3,
		closebtn:2,
		content:"是否删除",
		scrollbar:true,
		yes:function(){
			todelete(url,data);
		}
	});

	function todelete(url,data){
		$.post(url,data,func,'json');
		function func(response){
			if (response.status==1){
				return dialog.success(response.msg,SCOPE.jump_url);
			}else{
				return dialog.error(response.msg);
			}
		}
	}
}
/****
*排序
*/
$('#order').click(function(){
	var url=SCOPE.listorder_url;
	var listorder={};
	var data=$("#singcms-listorder").serializeArray();
	$.each(data,function(i,val){
		listorder[val.name]=val.value;
	});
	$.post(url,data,func,'json');
	function func(response){
		if (response.status==1){
			return dialog.success(response.msg,response['data']['jump_url']);
		}
		else{
			return dialog.error(response.msg,response['data']['jump_url']);
		}
	}
});
/*******点击切换状态*******/
$('#singcms-on-off').click(function(){
    var newid=$(this).attr('attr-id');
    var cuStatus=$(this).attr('attr-status');
    var url=SCOPE.set_status_url;
	var data={};
	data['id']=newid;
	data['status']=cuStatus==1?0:1;
	layer.open({
		type:0,
		title:'是否提交',
		btn:['yes','no'],
		icon:3,
		closebtn:2,
		content:"是否更换",
		scrollbar:true,
		yes:function(){
			todelete(url,data);
		}
	});

	function todelete(url,data){
		$.post(url,data,func,'json');
		function func(response){
			if (response.status==1){
				return dialog.success(response.msg,SCOPE.jump_url);
			}else{
				return dialog.error(response.msg);
			}
		}
	}
}
);

/***********推送***************/
$('#singcms-push').click(function(){
	var position=$('#select_push').val();

	var pushdata={};
	var push={};
	if (!position){ return dialog.error('请选择推荐位');}
	$("input[name='pushcheck']:checked").each(function(i,val){
          push[i]= val.value;
	});
	pushdata['push']=push;
	pushdata['position_id']=position;
	console.log(position);
	var url=SCOPE.push_url;
	$.post(url,pushdata,func,'json');
	function func(response){
		if (response.status==1) {
			return dialog.success(response.msg,response['data']['jump_url']);

		}else{
			return dialog.error(response.msg);
		}
	}
})