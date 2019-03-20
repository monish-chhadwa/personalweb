<!---->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="mainStyle.css"/>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    var handler=function(e){
        var ll=e.latLng;
        //var l=JSON.stringify(ll);
        //$('#insta').append('<br>'+l);
        //console.log(ll);
        $.ajax({
           url: 'https://maps.googleapis.com/maps/api/geocode/json',
           dataType: 'json',
           data: 'latlng='+ll['G']+','+ll['K'],
           success: function(data){
                //console.log(data);
                $('#insta').append('<br>'+data['results'][1]['formatted_address']); //https://developers.google.com/maps/documentation/geocoding/intro#ReverseGeocoding
           }
        });
    }
</script>
<script>
function initialize() {
    var mapProp = {
      center:new google.maps.LatLng(19.199251, 72.974581),
      zoom:13,
      mapTypeId:google.maps.MapTypeId.ROADMAP   //default 
    };
    var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
    //basic ends here
    
    google.maps.event.addListener(map,'click',handler);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap"></div>
<div id="insta">Hello</div>
<div class="next">
    <br/><br/>
    <button id="instaButton" type="button" class="btn btn-info btn-lg">
        <a href="https://api.instagram.com/oauth/authorize/?client_id=b8fb9251a28d4ddd9d91ff8f300ce056&redirect_uri=http://localhost/projects/mapinstagram/processing.php&response_type=code" style="text-decoration: none;">Login with Instagram</a>
    </button>
</div>
</body>
<script>/*
    $(function(){
        $('#instaButton').click(function(){
            $.aja
        });
    });*/
</script>
</html>
