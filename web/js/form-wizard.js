$(document).ready(function(){

    var obj = 0;

    $('.wizard').on('changed.fu.wizard',function(evt, data){
        if(obj < (($('.wizard').wizard('selectedItem')).step - 1)){
            obj = (($('.wizard').wizard('selectedItem')).step - 1);
            var flag = 0;
            $('#step' + obj).find('.form-group').each(function(){
                if($(this).hasClass('has-error'))
                    flag++;
            });
            $('#step' + obj).find('.form-group').each(function(){
                if($(this).hasClass('required'))
                    if($(this).find('input, select').val() == "")
                        flag++;
            });
            if(flag != 0){
                $('.wizard').wizard('previous');
                alert("Fill in the required fields with valid entries. Please check fields with (*) and red outline");
            }
        }
        obj = (($('.wizard').wizard('selectedItem')).step - 1);

    })

    $('.wizard').on('finished.fu.wizard',function(evt, data){
        $('#w0').submit();
    });



});