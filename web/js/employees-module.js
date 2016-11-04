/**
 * Created by Kalyan on 1/31/2015.
 */
$(document).ready(function(){
    $( "#employees-copypresentaddress" ).change(function() {
        if($(this).is(":checked")){
            $("#employees-permanent_address_line1").val($("#employees-present_address_line1").val());
            $("#employees-permanent_address_line2").val($("#employees-present_address_line2").val());
            $("#employees-permanent_city").val($("#employees-present_city").val());
            $("#employees-permanent_state").val($("#employees-present_state").val());
            $("#employees-permanent_country_id").val($("#employees-present_country_id").val());
            $("#employees-permanent_phone1").val($("#employees-present_phone1").val());
            $("#employees-permanent_phone2").val($("#employees-present_phone2").val());
        }
        else if($(this).is(":not(:checked)")){
            $("#employees-permanent_address_line1").val("");
            $("#employees-permanent_address_line2").val("");
            $("#employees-permanent_city").val("");
            $("#employees-permanent_state").val("");
            $("#employees-permanent_country_id").val("");
            $("#employees-permanent_phone1").val("");
            $("#employees-permanent_phone2").val("");
        }
    });
});
