// Add event listeners for gallery buttons
var yearButtonsElements = document.getElementsByClassName("button-school-year");

for (var i = yearButtonsElements.length - 1; i >= 0; i--) {
	yearButtonsElements[i].addEventListener("click", execute_request);
}

// Find container for gallery list
var galListContainer = document.getElementById("listing-found-galleries-container");

function execute_request(event) 
{
	// Handle ".selected" class
	var prevBtn = document.getElementsByClassName("selected");
	prevBtn[0].className = "button-school-year";
	event.currentTarget.className += " selected";

	var yearData = event.currentTarget.getAttribute("data");
	var firstSemestr = yearData.substr( 0, 4 );
	var secondSemestr = yearData.substr( 5 );
	var request = new XMLHttpRequest();

	// set URL with appropriate attributes
	var newURL = "?selected_year_fs=" + firstSemestr;
	history.replaceState(null, null, newURL);

	// Set school year end and start
	firstSemestr = firstSemestr + "-08-31T00:00:00.000Z";
	secondSemestr = secondSemestr + "-09-01T00:00:00.000Z";

	var requestSpecs = '';
	requestSpecs = "?categories=8";
	requestSpecs += "&after=" + firstSemestr;
	requestSpecs += "&before=" + secondSemestr;
	requestSpecs += "&_embed";

	request.open('GET', magicalData['siteURL'] + '/wp-json/wp/v2/posts' + requestSpecs);
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = JSON.parse(request.responseText);

			// Render response into galListContainer
			printResponse( response );
		} else {
			console.log("Connection to the server was succesful, but we recieved an error to our request.");
		}
	};

	request.onerror = function() {
		console.log("Connection error");
	};

	request.send();

}

function printResponse( responseData )
{
	HTMLtoprint = "";

	for (var i = 0; i < responseData.length; i++) {
		HTMLtoprint += "<li>";
		HTMLtoprint += "<a href='" + responseData[i].link + "'>";

		if ( responseData[i]._embedded['wp:featuredmedia'] ) {
			var originalSource = responseData[i]._embedded['wp:featuredmedia'][0].source_url;
			var sourceLength = originalSource.length;
			var sourceExt = originalSource.substr( (sourceLength - 4), 4 );
			var source = originalSource.substr( 0, (sourceLength - 4) ) + "-252x189" + sourceExt;


		} else {
			var source = "";	
		}
		HTMLtoprint += "<img src='" + source + "'>";

		HTMLtoprint += "</a>";
		HTMLtoprint += "<div class='title-overlay-container'>";
		HTMLtoprint += "<a class='title' href='" + responseData[i].link + "'>";
		HTMLtoprint += responseData[i].title.rendered + "</a>";
		HTMLtoprint += "<span class='gallery-date'>";
		HTMLtoprint += parseIsoDatetime( responseData[i].date ) + "</span>";
		HTMLtoprint += "</div>";
		HTMLtoprint += "</li>";
	}

	galListContainer.innerHTML = HTMLtoprint;

}

function parseIsoDatetime(dtstr) {
    var dt = dtstr.split(/[: T-]/).map(parseFloat);

    var months = [
    	'leden',
    	'únor',
    	'březen',
    	'duben',
    	'květen',
    	'červen',
    	'červenec',
    	'srpen',
    	'září',
    	'říjen',
    	'listopad',
    	'prosinec'
    ]

    var date = dt[2] + ". " + months[ dt[1] - 1 ] + ", " + dt[0];
    return date;
}