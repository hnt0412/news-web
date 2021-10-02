ClassicEditor
.create( document.querySelector( '#body' ) )
.catch( error => {
    console.error( error );
} );

$(document).ready(function(){
	alert('heee');
});

function loadUsersOnline(){
    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}
setInterval(function(){
    loadUsersOnline();
},500);