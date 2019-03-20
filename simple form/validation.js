function mainFunction(){
    var x1=document.getElementsByName('name');
    /*x1.focus(); --can't be used on a NodeList Object
    console.log(x1); //NodeList object
    console.log(x1[0]); //Html element node*/
    x1[0].focus();

    x1[0].onkeyup=function(){
        var input=this.value;
        var re=/^[a-zA-Z. ']{3,30}$/; //creates a regEx object;var re=new RegExp("[a-z]") in javascript
        if(re.test(input)){
            this.removeAttributeNode(this.getAttributeNode('class'));
            this.setAttribute('class','valid');
            this.nextElementSibling.innerHTML='';
        }
        else{
            this.removeAttribute('class');//Another way to remove attribute.
                                            // http://www.w3schools.com/jsref/met_element_removeattribute.asp
            this.setAttribute('class','invalid');
            this.nextElementSibling.innerHTML='Invalid first name.(3-30 characters)';
        }
    }

    document.getElementsByName('email')[0].onkeyup=function(){
        var input=this.value;
        var re=/^(([\w#\-_~!$&'()*+,;=:]+\.)+[\w#\-_~!$&'()*+,;=:]+|[\w#\-_~!$&'()*+,;=:]{2,}|[a-zA-Z]{1})@([a-zA-Z0-9]+[\w-]+\.)+[a-zA-Z]{1}[a-zA-Z0-9]{1,23}$/i;
        if(re.test(input)){
            this.removeAttributeNode(this.getAttributeNode('class'));
            this.setAttribute('class','valid');
            this.nextElementSibling.innerHTML='';
        }
        else{
            this.removeAttribute('class');
            this.setAttribute('class','invalid');
            this.nextElementSibling.innerHTML='Invalid email format';
        }
    }

    document.getElementsByName('contact')[0].onkeyup=function(){
        var input=this.value;
        var re=/\d{10}/;
        if(re.test(input)){
            this.removeAttributeNode(this.getAttributeNode('class'));
            this.setAttribute('class','valid');
            this.nextElementSibling.innerHTML='';
        }
        else{
            this.removeAttribute('class');
            this.setAttribute('class','invalid');
            this.nextElementSibling.innerHTML='Only 10-digit mobile nos.are allowed!';
        }
    }
}
