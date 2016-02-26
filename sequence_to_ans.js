var http_request=false;
var numberdiv;
function sequence_to_ans(statues1,statues2,statues3,statues4,statues5)
{
	 numberdiv=statues4;
	 st1=statues1;
	 st2=statues2;
	 st3=statues3;
	 st4=statues4;
	 st5=statues5;
	 var checkbox =  document.getElementById('box'+st5);
	 //console.log(checkbox.checked);
	 if(checkbox.checked){
		setTimeout("sequence_to_ans(st1,st2,st3,st4,st5)", 2000)
		 http_request=false;
		 if(window.XMLHttpRequest)
		 {
		  http_request=new XMLHttpRequest();	  
		  if(http_request.overrideMimeType)
		  {
				http_request.overrideMimeType('text/xml');
		  }
		 }
		 else if(window.ActiveXObject)
		 {
		  try
		  { //6.0+
				http_request=new ActiveXObject("Msxml2.XMLHTTP");
		  }
		  catch(e)
		  {
			   try
			   { //5.5+
					http_request=new ActiveXObject("Microsoft.XMLHTTP");
			   }catch (e){}
		  }
	 
	 }
		 if(!http_request)
		 {
				alert('Giving up :( Cannot create a XMLHTTP instance');
				return false;
		 }
		 http_request.onreadystatechange=show_area;
		 http_request.open('GET','irs_test_ans_sequence_to_ans.php?lessonid='+statues1+'&n='+statues2+'&examno='+statues3+'&div='+statues4+'&userid='+statues5,true);
		 http_request.send(null);
	 }else{
		//alert('you do not check!')
	 }

	 
}

function show_area()
{
	 if(http_request.readyState==4)
	 {
		  if(http_request.status==200)
		  {
			document.getElementById("num_"+numberdiv).innerHTML =http_request.responseText;
		  }
	 }
}