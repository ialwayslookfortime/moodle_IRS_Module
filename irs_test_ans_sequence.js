var http_request=false;
function open_to_ans_sequence(statues1,statues2,statues3)
{
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
	 http_request.open('GET','irs_test_ans_sequence.php?lessonid='+statues1+'&n='+statues2+'&examno='+statues3,true);
	 http_request.send(null);
}

function show_area()
{
	 if(http_request.readyState==4)
	 {
		  if(http_request.status==200)
		  {
			document.getElementById("show_area").innerHTML =http_request.responseText;
		  }
	 }
}