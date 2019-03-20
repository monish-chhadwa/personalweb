$(document).ready(function(){
    $('.right input').attr('size','35');
    $('input[name="fname"]').focus();
    
    $('input[name="fname"]').keyup(function(){
        var input=$(this).val();
        var re=/^[a-zA-Z\.']{3,20}$/; //creates a regEx object;var re=new RegExp("[a-z]") in javascript
        if(re.test(input)){
            $(this).removeClass().addClass('valid');
            $('#fnameErr').text('');
        }
        else{
            $(this).removeClass().addClass('invalid');
            $('#fnameErr').text('Invalid first name.(3-20 characters)');
        }
    });
    
    $('input[name="lname"]').keyup(function(){
        var input=$(this).val();
        var re=/^[a-zA-Z\.']{0,20}$/;
        if(re.test(input)){
            $(this).removeClass().addClass('valid');
            $('#lnameErr').text('');
        }
        else{
            $(this).removeClass().addClass('invalid');
            $('#lnameErr').text('Invalid last name.(max 20 characters)');
        }
    });
    
    $('input[name="email"]').keyup(function(){
        var input=$(this).val();
        var re=/^(([\w#\-_~!$&'()*+,;=:]+\.)+[\w#\-_~!$&'()*+,;=:]+|[\w#\-_~!$&'()*+,;=:]{2,}|[a-zA-Z]{1})@([a-zA-Z0-9]+[\w-]+\.)+[a-zA-Z]{1}[a-zA-Z0-9]{1,23}$/i;
        if(re.test(input)){
            $(this).removeClass().addClass('valid');
            $('#emailErr').text('');
        }
        else{
            $(this).removeClass().addClass('invalid');
            $('#emailErr').text('Invalid email format');
        }
    });
    
    $('input[name="password"]').keyup(function(){
        var input=$(this).val();
        var re=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
        if(re.test(input)){
            $(this).removeClass().addClass('valid');
            $('#passErr').text('');
        }
        else{
            $(this).removeClass().addClass('invalid');
            $('#passErr').text('Invalid last name.(max 20 characters)');
        }
    });
    
    $('input[name="contact"]').keyup(function(){
        var input=$(this).val();
        var re=/\d{10}/;
        if(re.test(input)){
            $(this).removeClass().addClass('valid');
            $('#contErr').text('');
        }
        else{
            $(this).removeClass().addClass('invalid');
            $('#contErr').text('Only 10-digit mobile nos.are allowed!');
        }
    });
    
    $('input').blur(function(){
        if ($('.invalid').length==0) {
            //This doesn't work:$('input[type="submit"]').attr('disabled','false');
            $('input[type="submit"]').removeAttr('disabled');
        }
        else{//This is to disable submit button again if correct values are changed to incorrect
            $('input[type="submit"]').attr('disabled','true');
        }
    });
});
