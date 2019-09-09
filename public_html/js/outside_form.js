function GetSchool() {
    var pin = prompt("Please enter your 4 digit PIN", "eg. 1234");
    if (pin != null) {
   loadTab("Confirm", "outside_confirm_school.php?pin=", pin);
   }
}

function OpenForm(pin, schoolname) {
   loadTab("dynamic_form", "outside_form.php?pin="+pin+"&school_name=", schoolname);
   shows_form_part(1);
 }

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

function addRowToTable2()
{
  var tbl = document.getElementById('sampleTbl');
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
  var tbl = document.getElementById('sampleTbl');
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
    var tbl = document.getElementById('sampleTbl');
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

function shows_form_part(n){
    var i = 1, p = document.getElementById("form_part"+1);
    while (p !== null){
        if (i === n){
            p.style.display = "";
        }
        else{
            p.style.display = "none";
        }
        i++;
        p = document.getElementById("form_part"+i);
    }
}
