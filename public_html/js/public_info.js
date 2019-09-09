function openSchool(id) {
        var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("info").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "public_info_action.php?school_id="+id, true);
  xhttp.send();
}

function return_to_schools(){
  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("info").innerHTML = this.responseText;
}
};
xhttp.open("GET", "./public_info_list_schools.php", true);
xhttp.send();
}

//function to search directory by school name
function showResult(str) {
  if (str.length==0) {

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="0px solid #A5ACB2";
    }
  }

  xmlhttp.open("GET","list_school_action.php",true);
  xmlhttp.send();
  }

//to return to list ordered by state if empty search box
  else {

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="0px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search_action.php?q="+str,true);
  xmlhttp.send();
}
}
