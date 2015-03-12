function get(idValue){
	return document.getElementById(idValue);
}

function changeTab(ntab,tid){
	if(ntab.className == 'active'){
		return;
	}
	get('resbox').style.display='none';
	if(tid == '0'){
		get('shortnav').className='active';
		get('expandnav').className='normal';
		get('shortbox').style.display='block';
		get('expandbox').style.display='none';
	}else if(tid == '1'){
		get('shortnav').className='normal';
		get('expandnav').className='active';
		get('shortbox').style.display='none';
		get('expandbox').style.display='block';
	}
}

function inputfocus(tag){
	if(tag.value=='请输入要缩短的网址' || tag.value=='请输入要还原的短址'){
		tag.value='';
	}
}

function shorturl(){
	var url = get('url').value;
	url = url.replace(/(^\s*)|(\s*$)/g, ""); 
	var zhchreg = /^[\u0391-\uFFE5]+$/; 
	var headreg = /^(http)?:///;  
	if(url!='' && !zhchreg.test(url)){	
		if(!headreg.test(url)){			
			var httpsreg = /^(https)?:///;
			if(httpsreg.test(url)){
				url = url.replace("https","http");
			}else{
				url = 'http://' + url;
			}
		}
		get('resbox').style.display = 'block';
		$.get('utilities/short.php?type=1&url=' + encodeURIComponent(url), function(msg){
      get('result').innerHTML = '<input type="text" id="urltext" value='+msg+' />';
    });
		
		get('url').value = '';
	}else{
		alert('出错了！请检查您输入的网址是否正确');
	}
	
	init();//若是chrome则初始化zeroclipboard
	return false;
}

function expandurl(){
	var surl = get('surl').value;
	surl = surl.replace(/(^\s*)|(\s*$)/g, ""); 
	var zhchreg = /^[\u0391-\uFFE5]+$/; 
	var headreg = /^(http)?:///;  
	if(surl!='' && !zhchreg.test(surl)){	
		if(!headreg.test(surl)){
			url = 'http://' + surl;
		}
		get('resbox').style.display = 'block';
		xmlhttp.open('get', 'utilities/short.php?type=2&url=' + encodeURIComponent(surl), true);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					var msg = xmlhttp.responseText;
					get('result').innerHTML = '<input type="text" id="urltext" value='+msg+' />';
				}
			}
		}
		xmlhttp.send(null);
		get('surl').value = '';
	}else{
		alert('出错了！请检查您输入的短址是否正确');
	}
	
	init();
	return false;
}

function copyurl(){
	if (window.clipboardData) { 
		url=get('urltext').value;
		window.clipboardData.setData('text', url);  
		alert('网址已成功复制到剪贴板');
	}else{
		alert('您的浏览器不支持复制功能，请按ctrl+C手动复制');
		get('urltext').select();
	}
}
//以下是zeroclipboard复制代码
function init(){
	if(navigator.userAgent.indexOf("Chrome") > -1){
		var clip = new ZeroClipboard(get('copybtn'));
		clip.on('complete', function(client, args){
			alert('网址已成功复制到剪贴板');
		});
	}
}
