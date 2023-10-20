var xhr = new XMLHttpRequest();
xhr.open("POST", "http://localhost/PRO_SELL_LAND/FE/export.php"); 
xhr.onload = function(event){ 
    alert("Success, server responded with: " + event.target.response); // raw response
}; 
// or onerror, onabort
var formData = new FormData(document.getElementById("form_fields")); 
xhr.send(formData);