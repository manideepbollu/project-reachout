$(document).ready(function(){

    function maskInit(){
        var courseName = $('#batches-course_id option:selected').text();
        $("#batches-batch_name").attr("placeholder", courseName + " - (Auto prefixes the parent course)");
        $("#batches-batch_name").mask(courseName + " ^?^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^", {placeholder: ""});
    }

    maskInit();

    $('#batches-course_id').change(function(){
        maskInit();
    });
});