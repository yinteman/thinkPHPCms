/**
*登录类库
*/
var login={
    check:function(){

    	var username=$('input[name="username"]').val();
    	var password=$('#inputPassword').val();

    	if (username==''||password == '') {
    		dialog.error('不能为空');
    	}
    	var url ='/project/Index.php?m=Admin&c=Login&a=check';
    	var paramas={'username':username,'password':password};
    	$.post(url,paramas,func,'json');
    	
    	function func(response){
    		if (response.status == 0) {
    			dialog.error(response.msg);
    		}else{
    			dialog.success(response.msg,'/project/Index.php?m=Admin&c=Index')
    		}

    	}
    }


}