$(document).ready(function() {
var max_fields = 10; //maximum input boxes allowed
var wrapper = $(".wrap_services"); //Fields wrapper
var add_button = $("#addMoreServices"); //Add button ID

var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
	e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="row mb-2"><div class="col-md-4"><input type="text" id="addMoreServices" name="service_name" class="form-control form-line" placeholder="Ticket type" required></div><div class="col-md-4"><input type="text" id="amount" name="amount[]" class="form-control form-line" placeholder="Amount" required></div><div class="col-md-4"><a href="#" class="remove_field add_field_button btn btn-warning waves-effect">Remove</a></div></div>'); //add input box
}
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	e.preventDefault(); 
	$(this).closest('.row').remove(); x--;
})

});

function confirmBeforeDelete(thisHREF) {
    swal({
        title: "Delete?",
        text: "By doing this, event will be deleted!",
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            location.href = thisHREF
        }
    });

    return false
}




// #vid1{
//     position:relative;
//     object-fit:cover;
// }

// #vid1 video{
//     height:100vh;
//     width:50%;
//     background position:absolute;
//     object-fit:cover;
    
// }