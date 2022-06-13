$(document).ready(function(){
	// starting parameters
	init();
});

function init() {
	var source = $('#deleteTemplate').html();
	var template = Handlebars.compile(source);

	//add rendered template
	$('.delete-container').html(template());

	addEventsInit();
};

function addEventsInit() {
	$('.delete').on('click', function(event) {
		var url_string = window.location.href;
		var url = new URL(url_string);
		var unique_id = url.searchParams.get("reserv");
		var lang = url.searchParams.get("lang");
		getResponseOnDelete('./backend/index.php/delete?reserv='+unique_id+'&lang='+lang);
	});
};

function getResponseOnDelete(path) {
	//get data from URL and render template
    $.ajax({
    	type: 'GET',
        url: path,
        dataType: 'json',
        cache: false,
        success: function(data) {
        	renderDeleteResponse(data);
        }
    });
};

function renderDeleteResponse(data) {
	$('.deleteTemplate').remove();
	var source = $('#responseTemplate').html();
	var template = Handlebars.compile(source);

	//add rendered template
	$('.delete-container').html(template(data));

	$('.to-torch').on('click', function(event) {
		window.location.replace('./booking.html');
	});
};


