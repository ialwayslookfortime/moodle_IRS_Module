var http_request=false;
function sequence_delete(statues1)
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
	 http_request.open('GET','sequence_delete.php?lessonid='+statues1,true);
	 http_request.send(null);
}

function show_area()
{
	 if(http_request.readyState==4)
	 {
		  if(http_request.status==200)
		  {
			//document.getElementById("num_"+numberdiv).innerHTML =http_request.responseText;
		  }
	 }
}