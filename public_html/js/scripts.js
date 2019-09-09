//allow for dynamic page by showing and revealing divs on click of tabs
function openMainTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("maintabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("maintablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

//allow for dynamic page by showing and revealing divs on click of tabs
//name with sub to avoid dactivating main tab when new sub tab is selected
function openSubTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("subtabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("subtablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

//default tab -- open sub tab functionality to be called from js. avoid event listener if not triggered by a click
function default_tab(tabButton, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("subtabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("subtablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    var button = document.getElementById(tabButton);    
    button.className += " active";
}
//
//
//
//
//
//Ajax div load functions
//
//
//
//
//
//allow for ajax to wait for div to exist before attempting to load into it
function waitForElement(elementId, callBack){
  window.setTimeout(function(){
    var element = document.getElementById(elementId);
    if(element){
      callBack(elementId, element);
    }else{
      waitForElement(elementId, callBack);
    }
  },500)
}

//Open new page with tabs for school info and then insert info into tabs with ajax
function openSchool(school){
loadSimpleTab('ViewSchools', 'schools/school_info.php');
	
	//open general tab once created
	 waitForElement("Grad_stats",function(){
          default_tab('school_default', 'gen');
        });

	//load info into tabs
	waitForElement("gen",function(){
	  loadTab('gen', 'schools/school_general.php?school_id=', school);
	});
	waitForElement("Population",function(){
          loadTab('Population', 'schools/school_population.php?school_id=', school);
        });
	waitForElement("Directors",function(){
          loadTab('Directors', 'schools/school_directors.php?school_id=', school);
        });
	waitForElement("Grad_stats",function(){
          loadTab('Grad_stats', 'schools/school_grad_stats.php?school_id=', school);
        });
}

//load tab using ajax for when a specific id is passed
function loadTab(tab, link, id) {
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById(tab).innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", link+id, true);
  xhttp.send();
}

//load tab using ajax of static page
function loadSimpleTab(tab, link) {
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById(tab).innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", link, true);
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

  xmlhttp.open("GET","school_by_state.php",true);
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
  xmlhttp.open("GET","schools/search_action.php?q="+str,true);
  xmlhttp.send();
}
}

//Delete functions

function delete_title(id, school_id){
  var xhttp = new XMLHttpRequest();
xhttp.open("GET", "schools/delete_title.php?position_id="+id, true);
xhttp.send();
loadTab('Directors', 'schools/school_directors_update.php?school_id=', school_id);
}

function delete_school(id){
  var xhttp = new XMLHttpRequest();
xhttp.open("GET", "schools/delete_school.php?school_id="+id, true);
xhttp.send();
location.reload();
}

function delete_association(id){
  var xhttp = new XMLHttpRequest();
xhttp.open("GET", "associations/delete_association.php?assoc_id="+id, true);
xhttp.send();
location.reload();
}

function delete_affil(id){
  var xhttp = new XMLHttpRequest();
xhttp.open("GET", "delete_affil.php?affil_id="+id, true);
xhttp.send();
location.reload();
}


//
//
//
//
//
//
//
//dynamic add faculty scripts for admin directors update---------------------------------------

function addRowToTable_update()
{
  var tbl = document.getElementById('tbl_update');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);

  // number cell
  var cellLeft = row.insertCell(0);
  var textNode = document.createTextNode(iteration);
  cellLeft.appendChild(textNode);

  // name cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'textRow' + iteration;
  el.id = 'textRow' + iteration;
  el.size = 40;

  el.onkeypress = keyPressTest_update;
  cellRight.appendChild(el);

  // email cell
  var cellMid = row.insertCell(2);
  var email = document.createElement('input');
  var textNode1 = document.createTextNode('Email   ');
  email.type = 'text';
  email.name = 'emailRow' + iteration;
  email.id = 'emailRow' + iteration;
  email.size = 40;

  email.onkeypress = keyPressTest_update;
  cellMid.appendChild(textNode1);
  cellMid.appendChild(email);

  // select cell
  var cellRightSel = row.insertCell(3);

  var original = document.getElementById('selectRow1');
  var options = original.innerHTML;

  var sel = document.createElement('select');
  var textNode2 = document.createTextNode('Title   ');
  sel.name = 'selectRow' + iteration;
  sel.style.width = '200px';
  sel.innerHTML = options;

  cellRightSel.appendChild(textNode2);
  cellRightSel.appendChild(sel);
}


function keyPressTest_update(e, obj)
{
  var validateChkb = document.getElementById('chkValidateOnKeyPress');
  if (validateChkb.checked) {
    var displayObj = document.getElementById('spanOutput');
    var key;
    if(window.event) {
      key = window.event.keyCode;
    }
    else if(e.which) {
      key = e.which;
    }
    var objId;
    if (obj != null) {
      objId = obj.id;
    } else {
      objId = this.id;
    }
    displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
  }
}

function removeRowFromTable_update()
{
  var tbl = document.getElementById('tbl_update');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}
function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');

  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';

  // submit
  frm.submit();
}

function validateRow_update(frm)
{
  var chkb = document.getElementById('chkValidate');
  if (chkb.checked) {
    var tbl = document.getElementById('tbl_update');
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i=1; i<=lastRow; i++) {
      var aRow = document.getElementById('textRow' + i);
      //var eRow = document.getElementById('emlRow' + i);
      if (aRow.value.length <= 0) {
        alert('Row ' + i + ' is empty');
        return;
      }
    }
  }
  openInNewWindow(frm);
}

//end of dynamic form script---------------------------------------
//
//
//
//
//
//
//dynamic add faculty scripts for NEW SCHOOL---------------------------------------


function addRowToTable1()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);

  // number cell
  var cellLeft = row.insertCell(0);
  var textNode = document.createTextNode(iteration);
  cellLeft.appendChild(textNode);

  // name cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.size = 40;

  el.onkeypress = keyPressTest;
  cellRight.appendChild(el);

  // email cell
  var cellMid = row.insertCell(2);
  var email = document.createElement('input');
  var textNode1 = document.createTextNode('Email   ');
  email.type = 'text';
  email.name = 'emlRow' + iteration;
  email.id = 'emlRow' + iteration;
  email.size = 40;

  email.onkeypress = keyPressTest;
  cellMid.appendChild(textNode1);
  cellMid.appendChild(email);

  // select cell
  var cellRightSel = row.insertCell(3);

  var original = document.getElementById('selRow1');
  var options = original.innerHTML;

  var sel = document.createElement('select');
  var textNode2 = document.createTextNode('Title   ');
  sel.name = 'selRow' + iteration;
  sel.style.width = '200px';
  sel.innerHTML = options;

  cellRightSel.appendChild(textNode2);
  cellRightSel.appendChild(sel);
}


function keyPressTest(e, obj)
{
  var validateChkb = document.getElementById('chkValidateOnKeyPress');
  if (validateChkb.checked) {
    var displayObj = document.getElementById('spanOutput');
    var key;
    if(window.event) {
      key = window.event.keyCode;
    }
    else if(e.which) {
      key = e.which;
    }
    var objId;
    if (obj != null) {
      objId = obj.id;
    } else {
      objId = this.id;
    }
    displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
  }
}

function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}
function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');

  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';

  // submit
  frm.submit();
}
function validateRow(frm)
{
  var chkb = document.getElementById('chkValidate');
  if (chkb.checked) {
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i=1; i<=lastRow; i++) {
      var aRow = document.getElementById('txtRow' + i);
      //var eRow = document.getElementById('emlRow' + i);
      if (aRow.value.length <= 0) {
        alert('Row ' + i + ' is empty');
        return;
      }
    }
  }
  openInNewWindow(frm);
}
//
//
//
//
//end of dynamic form script---------------------------------------

//java script to show and hide info for review tab, execute approve/discard on click
//
//
//
function openReview(schoolid, formid){
loadTab('update', 'review/review_new.php?temp_data_id=', formid)
loadTab('orig', 'review/review_current.php?school_id=', schoolid)
}

function return_to_list(){
  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("update").innerHTML = this.responseText;
document.getElementById("orig").innerHTML = "";
}
};
xhttp.open("GET", "list_reviews.php", true);
xhttp.send();
}

function discard(id) {

          $.ajax({
            type: 'GET',
            url: 'review/discard_update.php?temp_data_id='+id,
            success: function () {
              alert('Submission discarded');
            return_to_list();
           }
          });

        }

function approve(id) {

          $.ajax({
            type: 'GET',
            url: 'review/confirm_update.php?temp_data_id='+id,
            success: function () {
              alert('Submission confirmed. School information updated.');
            return_to_list();
           }
          });

        }
// end of review JS
//
//
//
//
//
//execute action for updates to schools without leaving admin page

function update_general(school_id) {

          $.ajax({
            type: 'post',
            url: 'schools/school_general_update_action.php',
            data: $('#update_general').serialize(),
            success: function () {
              alert('General information updated.');
            loadTab('gen', 'schools/school_general.php?school_id=', school_id);
	   }
          });

        }

function update_population(school_id) {

          $.ajax({
            type: 'post',
            url: 'schools/school_population_update_action.php',
            data: $('#update_population').serialize(),
            success: function () {
              alert('School population information updated.');
            loadTab('Population', 'schools/school_population.php?school_id=', school_id);
           }
          });

        }

function update_directors(school_id) {

          $.ajax({
            type: 'post',
            url: 'schools/school_directors_update_action.php',
            data: $('#update_directors').serialize(),
            success: function () {
              alert('Directors information updated.');
            loadTab('Directors', 'schools/school_directors.php?school_id=', school_id)
           }
          });

        }

function update_grad_stats(school_id) {

          $.ajax({
            type: 'post',
            url: 'schools/school_grad_stats_update_action.php',
            data: $('#update_grad_stats').serialize(),
            success: function () {
              alert('Graduation information updated.');
            loadTab('Grad_stats', 'schools/school_grad_stats.php?school_id=', school_id)
           }
          });

        }
