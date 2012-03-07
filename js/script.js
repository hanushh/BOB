function loadpage(id,date1,date2,user){
	var xmlhttp;

	url="editattendance.php?date1="+date1+"&date2="+date2+"&user="+user;

	if (window.XMLHttpRequest){
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			document.getElementById(id).innerHTML=xmlhttp.responseText;
    		}
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
