/****计数器*/
var newslist={};
$('.news_count').each(function(i){
	newslist[i]=$(this).attr('id');
});
var url="index.php?m=Home&c=Index&a=getCount";

$.post(url,newslist,func,'json');
function func(result){
	if (result.status){
         var list=result.data;
         
        $.each(list,function(news_id,count){
        	$(".node-"+news_id).html(count);
        });
	}else{
		return dialog.error(result.msg);
	}
}