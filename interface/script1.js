/**
 * Created by monish.c on 8/11/2015.
 */
window.onload=function(){
    var temp=document.getElementsByName('template');
    var handler=function(e){
        var value=e.target.getAttribute('value');
        var select=document.getElementById('noOfAds')
        if(value==1||value==2)
            select.innerHTML='<option>4</option><option>6</option><option>8</option>';
        else
            select.innerHTML='<option>3</option><option>4</option><option>5</option><option>6</option><option>7</option>'+
            '<option>8</option>';
    }
    for(var i=0;i<temp.length;i++)
        temp[i].addEventListener('click',handler);
}