/**
 * Created by monish.c on 8/7/2015.
 */
window.onload=function(){
    console.log('I am ready');

    function fillOptions() { //fills the options for select friends in add bill modal
        console.log('I am self invoking');
        var el, i,j;
        var parent=document.getElementById('friends');  //The select tag
        //console.log(parent.children);
        j=parent.children.length;   //You can't use i<parent.children.length directly(don't know why)
        //console.log(j);
        for(i=0;i<j;i++){//Remove all previously populated options first
            console.log('Removing child');
            console.log(parent.firstChild);
            parent.removeChild(parent.firstChild);
        }
        var friends=JSON.parse(localStorage.getItem('friendsList'));
        j = (friends==null) ? 0 : friends.length;
        for(i=0;i<j;i++) {
            el = document.createElement('option');
            el.innerHTML=friends[i];
            parent.appendChild(el);
        }
    }
    document.getElementById('addBill').addEventListener('click',fillOptions);//In case add bill is clicked after add friend,then list should be updated

    var addFriend=function(e){      //When add button is clicked in add friend modal
        console.log('I am clicked');
        var el=document.createElement('input');
        el.setAttribute('type','text');
        var ph=e.target.previousElementSibling.getAttribute('placeholder');
        var no=parseInt(ph.substr(ph.length-2,ph.length-1))+1;
        el.setAttribute('placeholder','Friend '+no);
        e.target.parentNode.insertBefore(el, e.target);
    }
    document.getElementById('addButtonInFriend').addEventListener('click',addFriend);

    var addFriendInBill=function(e){      //When add button is clicked in add bill modal
        console.log('I am clicked in bill');
        var el=event.target.previousSibling.cloneNode(true);
        e.target.parentNode.insertBefore(el, e.target);
    }
    document.getElementById('addButtonInBill').addEventListener('click',addFriendInBill);

    var markPaid=function(e){       //When Mark as PAID button is clicked
        var el=document.createTextNode('PAID');
        e.target.parentNode.replaceChild(el,e.target);
        var temp=JSON.parse(localStorage.getItem('bill'));
        temp[e.target.getAttribute('id')]['paid']=1;
        localStorage.setItem('bill',JSON.stringify(temp));
    }


    document.getElementById('saveFriend').addEventListener('click',function(e){ //When save button is clicked in add friend modal
        console.log('Saving Friend');
        var nearestParent= e.target.parentElement;
        while(nearestParent.tagName!=='MAIN') {     //Go upto the main element
            nearestParent = nearestParent.parentElement;
        }
        var ch=nearestParent.children;          //Get all children of main
        var friends=JSON.parse(localStorage.getItem('friendsList'));
        if(friends==null)   friends=[];
        var  j = friends.length;
        var re=/^[a-zA-Z ]{3,20}$/; //To validate input
        for(i=0;i<ch.length;i++){
            if(ch[i].tagName=='INPUT'&&re.test(ch[i].value)){ //Save only those which are input elements
                friends[j]=ch[i].value;
                j++;
            }
        }
        localStorage.setItem('friendsList',JSON.stringify(friends));
        document.getElementsByClassName("overlay")[1].style.visibility="hidden";
    });

    document.getElementById('saveBill').addEventListener('click',function(e){ //When save button is clicked in add bill modal
        console.log('Saving Bill');
        var nearestParent= e.target.parentElement;
        while(nearestParent.tagName!=='MAIN') {     //Go upto the main element
            nearestParent = nearestParent.parentElement;
        }
        //var bill=[];        //Create a JSON array of objects in which we will store everything
        var bill=JSON.parse(localStorage.getItem('bill'));
        console.log(bill);
        var tempL=(bill!==null)? bill.length : 0;
        if(bill==null) bill=[];
        bill[tempL]={};             //You must tell the interpreter that the next array element is an object!
        console.log(bill);
        console.log('This is bill'+bill);
        var ch=nearestParent.children;          //Get all children of main
        var j=0;    //for the friends array
        bill[tempL]['friends']=[]  //define friends as an array
        for(i=0;i<ch.length;i++){
            if(ch[i].tagName=='INPUT'&&ch[i].getAttribute('placeholder')=='Bill title'){
                bill[tempL]['title']=ch[i].value;
            }
            if(ch[i].tagName=='INPUT'&&ch[i].getAttribute('placeholder')=='Amount(1000.0)'){
                bill[tempL]['amount']=ch[i].value;
            }
            if(ch[i].tagName=='SELECT'){
                bill[tempL]['friends'][j]=ch[i].value;
                j++;
            }
        }
        bill[tempL]['paid']=0;
        for(i=0;i<tempL;i++){
            bill[i]['paid']=0;
        }
        console.log(bill);
        localStorage.setItem('bill',JSON.stringify(bill));
        document.getElementsByClassName("overlay")[0].style.visibility="hidden";
        displayBills(tempL);
    });

    var displayBills= function(t){  //Parameter t decides from which index to display bills from(Adding new bill)
        //Now we insert this into the DOM
        var bill=JSON.parse(localStorage.getItem('bill'));
        console.log(bill);
        var tempL=(bill!==null)? bill.length : 0;   //No.of bills
        if(bill==null) bill=[];
        for(t;t<tempL;t++) {

            var j = bill[t]['friends'].length;//To get no.of friends
            //console.log(bill[t]['friends']);
            var el=document.createElement('article');
            var friendsLi='';//To store li of friends
            var amountsLi='';//To store the amounts
            for (i = 0; i < j; i++) {
                friendsLi += '<li>' + bill[t]['friends'][i] + '</li>';
            }
            for (i = 0; i < j; i++) {
                amountsLi += '<li>' + (parseInt(bill[t]['amount']) / j).toFixed(2) + '</li>';
            }
            var paidOrNot=(bill[t]['paid'])? 'PAID' :'<button class="payMark" id="'+t+'">Mark as PAID</button>';
            el.innerHTML = '<header>' +
                bill[t]['title'] +
                '<span class="right">Amount</span>\
                    <hr>\
                    </header>\
                    <main>\
                    <ul>' + friendsLi + '</ul>\
                <ul class="right">' + amountsLi + '</ul>\
            <div style="clear: both"></div>\
                </main><hr>\
                <footer>\
                <span>Total Amount</span>\
            <span class="right">' + parseInt(bill[t]['amount']).toFixed(2) + '</span>\
                <div>'+paidOrNot+'</div>\
            </footer>';
            document.getElementById('mainSection').insertBefore(el, document.getElementById('mainSection').firstChild);
        }
        var b = document.getElementsByClassName('payMark');
        for(i=0;i< b.length;i++)
            b[i].addEventListener('click',markPaid);
    };
    displayBills(0);    //Display bills from start!
}

//These functions open and close the modals
function overlay() {
    el = document.getElementsByClassName("overlay")[0];             //This is add bill modal
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
}
function overlay1() {
    el = document.getElementsByClassName("overlay")[1];             //This is add friend modal
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
}