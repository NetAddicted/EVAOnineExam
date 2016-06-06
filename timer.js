var maxtime = 30 * 60 

function CountDown()
{   
	if(maxtime>=0)
	{   
		minutes = Math.floor(maxtime/60);   
		seconds = Math.floor(maxtime%60);   
		msg = "距离结束还有 "+minutes+" 分 "+seconds+" 秒";   
		document.all["timer"].innerHTML=msg;   
		if(maxtime == 5 * 60) alert('请注意，离考试结束还有5分钟!\n倒计时结束将强制交卷。');   
		--maxtime;
	}   
	else
	{   
		clearInterval(timer); 
		document.getElementById("form1").submit();
		alert("考试时间结束，现在系统将马上为您交卷。");
	}   
}

timer = setInterval("CountDown()",1000);   