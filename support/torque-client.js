var url = "latest.php"; // API endpoint for getting data
var id = ""; // Holds our user token through repeated calls
var map; // Holds our map data.
var addedMarkers; // Holds a "set" sorta of our added markers so we don't duplicate markers.
var elements; // Holds our document elements.

function initialize() {
	findElements();
	getIds();
	var mapProp = {
		center:new google.maps.LatLng(47.508742, -117.120850),
		zoom:5,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

function updateData(user_id) {
        id = user_id;
	addedMarkers = new Set();
        intervalId = setInterval(httpGet, 2500);
}


// Only run getElementById once...
function findElements() {
	elements = new Array();
	elements["time"] = document.getElementById("time");
	elements["rpm"] = document.getElementById("rpm");
	elements["lat"] = document.getElementById("lat");
	elements["longitude"] = document.getElementById("longitude");
	elements["speed_obd"] = document.getElementById("speed_obd");
	elements["mpg_instant"] = document.getElementById("mpg_instant");
	elements["should_center"] = document.getElementById("should_center");
	elements["should_zoom"] = document.getElementById("should_zoom");
	elements["kph"] = document.getElementById("kph");
	elements["user_id_dropdown"] = document.getElementById("user_id_dropdown");
}

// Periodic function which is called to update data on-screen.
function httpGet()
{    
        $.getJSON(url + "?id=" + id, function(data)
        {
                var res = data[0];
                elements["time"].innerHTML = epochToHuman(res.time);
                elements["rpm"].innerHTML = res.rpm;
                elements["lat"].innerHTML = res.lat;
                elements["longitude"].innerHTML = res.longitude;

		// Check for KPH or MPH
		if (elements["kph"].checked) {
                	elements["speed_obd"].innerHTML = res.speed_obd;
		} else {
                	elements["speed_obd"].innerHTML = res.speed_obd_mph;
		}

                elements["mpg_instant"].innerHTML = res.mpg_instant;

                var myLatlng = new google.maps.LatLng(res.lat, res.longitude);

		if (elements["should_center"].checked) {
                	map.setCenter(myLatlng);
		}

		if (elements["should_zoom"].checked) {
			map.setZoom(17);
		}

		var marker = new google.maps.Marker({
                        position: myLatlng,
                        title: "Position",
                });

		// LatLng objects don't compare well...
		var comparable = myLatlng.lat() + "x" + myLatlng.lng();
		if (!addedMarkers.has(comparable)) {
			marker.setMap(map);
		}
		addedMarkers.add(comparable);

        })  
}

// Given a millisecond epoch time, returns a human-readable time/date.
function epochToHuman(epoch) {
	var date = new Date(epoch);
	return (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}

function loadScript() {
	var script = document.createElement('script');
	script.type = 'text/javascript';
	// This line calls the actual initialize, which starts our application for real once the google map is loaded.
	script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
		'&signed_in=true&callback=initialize';
	document.body.appendChild(script);
}

// Loads values from id list script dynamically to populate the dropdown.
function getIds() {
	var selector = elements["user_id_dropdown"];
	var idurl = "idlist.php";

	jQuery.getJSON(idurl, function(data) {
		for(var i = 0; i < data.length; i++){
		        var obj = data[i];
		        for(var key in obj){
		       	 var attrName = key;
		       	 var attrValue = obj[key];
		       	 var myOption = document.createElement("option");
		       	 myOption.text = obj[key];
		       	 selector.add(myOption);
		        }
		}

	 })  
	
}

// Helper function. Returns text of current selected dropdown element.
function getSelectedText(elementId) {
	    var elt = document.getElementById(elementId);

	    if (elt.selectedIndex == -1)
		    return null;

	    return elt.options[elt.selectedIndex].text;
}

window.onload = loadScript;
