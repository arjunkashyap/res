$(document).ready(function(){
	$('#vol').change(function(){
		var volume  = $(this).val();
		$("#issue_div").load("get_issues.php?volume="+volume); 
	}); 
});


function addRow(tableID)
{
   var table = document.getElementById(tableID);
   var rowCount = table.rows.length;
   var row = table.insertRow(rowCount);
 
   var cell1 = row.insertCell(0);
   var element1 = document.createElement("input");
   element1.type = "checkbox";
   cell1.appendChild(element1);
 
   var cell2 = row.insertCell(1);
   var element2 = document.createElement("input");
   element2.type = "text";
   element2.name = "auth[]";
   cell2.appendChild(element2);
}
 
function deleteRow(tableID)
{
 try{
       var table = document.getElementById(tableID);
       var rowCount = table.rows.length;
 
       for(var i=0; i<rowCount; i++) {
           var row = table.rows[i];
           var chkbox = row.cells[0].childNodes[0];
           if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }
 }catch(e) {
      alert(e);
         }
}

function validate()
{
	var x=document.forms["frm1"]["authorname_up"].value;
	if (x==null || x=="")
	{
		alert("Author name can not be empty");
		return false;
	}
}

function validate1()
{
	var title=document.forms["frm2"]["title"].value;
	var page=document.forms["frm2"]["pagestart"].value;
	var page_end=document.forms["frm2"]["pageend"].value;
	var issue=document.forms["frm2"]["issue"].value;
	if(issue==null || issue=="")
	{
		alert("Issue can not be empty");
		return false;
	}
	else if(title==null || title=="")
	{
		alert("Title can not be empty");
		return false;
	}
	else if(page==null || page=="")
	{
		alert("Page start can not be empty");
		return false;
	}
	else if(page_end==null || page_end=="")
	{
		alert("Page end can not be empty");
		return false;
	}
}


function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 
        && (charCode < 48 || charCode > 57))
          return false;

       return true;
}
