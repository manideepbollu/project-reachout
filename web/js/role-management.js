/**
 * Created by alwaysbollu on 19/12/14.
 */

$(document).ready(function(){
    //Tree view on the Permission management table
    $('a.treehead').click(function(){
        var childClass = '.' + $(this).parent().parent().attr('id') + '-child';

        if($(this).hasClass('fa-caret-right'))
        {
            $(childClass).show();
            $(childClass).find('a').removeClass('fa-caret-down fa-caret-right').addClass('fa-caret-down');
        }
        else
            $(childClass).hide();
        $(this).toggleClass('fa-caret-right fa-caret-down');

    });
    //End of Tree view code

    //Vertical parent-child relation between the check boxes
    $('ins').click(function(){
        var inputClassName = '.' + $(this).prev().attr('class');
        var childClass = '.' + $(this).parent().parent().parent().parent().attr('id') + '-child';

        $(this).parent().removeClass('indeterminate');
        $(childClass).find(inputClassName).parent().removeClass('indeterminate');

        if($(this).parent().hasClass('checked')){
            $(childClass).find(inputClassName).parent().addClass('checked');
            $(childClass).find(inputClassName).prop('checked', true);

            var classes = $(this).parent().parent().parent().parent().attr('class').split(" ");
            var numberClasses = classes.length - 1;
            var flag = 0;

            while(numberClasses >= 0){

                $('.' + classes[numberClasses]).find(inputClassName).each(function() {
                    if(!$(this).parent().hasClass('checked'))
                        flag++;
                });
                console.log(flag);
                if(flag != 0)
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).parent().addClass('indeterminate');
                else{
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).parent().removeClass('indeterminate').addClass('checked');
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).prop('checked', true);
                }

                numberClasses--;
            }
        }
        else {
            $(childClass).find(inputClassName).parent().removeClass('checked');
            $(childClass).find(inputClassName).prop('checked', false);

            var classes = $(this).parent().parent().parent().parent().attr('class').split(" ");
            var numberClasses = classes.length - 1;
            var flag = 0;

            while(numberClasses >= 0){

                $('.' + classes[numberClasses]).find(inputClassName).each(function() {
                    if($(this).parent().hasClass('checked'))
                        flag++;
                });
                console.log(flag);
                if(flag != 0)
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).parent().addClass('indeterminate');
                else{
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).parent().removeClass('indeterminate').removeClass('checked');
                    $('#' + classes[numberClasses].replace('-child', '')).find(inputClassName).prop('checked', false);
                }

                numberClasses--;
            }
        }
    });

    //Page Onload Data filling
    $('[data-fill="js-determined"]').each(function(){
        checkCheckedChildren(this);
    });

    function checkCheckedChildren(el){
        var childClass = '.' + $(el).attr('id') + '-child';
        var parentId = '#' + $(el).attr('id');

        $('[data-fill="js-determined"]' + childClass).each(function() {
            checkCheckedChildren(this);
        });

        $(el).find('input').each(function(){
            var inputClass = '.' + $(this).attr('class');
            var checkFlag = 0;
            var uncheckFlag = 0;
            $(childClass).find(inputClass).each(function(){
                if($(this).parent().hasClass('checked'))
                    checkFlag++;
                else
                    uncheckFlag++;
            });
            if(checkFlag > 0 && uncheckFlag == 0)
                $(parentId).find(inputClass).parent().addClass('checked');
            else if(checkFlag == 0 && uncheckFlag > 0)
                $(parentId).find(inputClass).parent().removeClass('checked');
            else
                $(parentId).find(inputClass).parent().removeClass('checked').addClass('indeterminate');
        });
    }

    //Copy permissions from an existing role
    $('#copy-button').click(function(){
        sessionStorage.setItem('role', 'Admin');
        $('#permission-table').load('../views/auth-item/_permissiontable.php');
    })


});