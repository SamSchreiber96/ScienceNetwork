var getFromServer = function(url, onSuccess, onFailure){
  	var u=url;
    console.log('url:' + u);
  	$.ajax({
  	 	url: u,
  		type: 'GET',
  		dataType: 'json',

  		success: function(response) {
  			   onSuccess(response);
  		},
  		error: function(request, error) {
        onFailure(error);
  		}
  	});
}

var postToServer = function(url, data, onSuccess, onFailure) {
  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'json',
    data: data,

    success: function(data) {
      onSuccess(data);
    },
    error: function(request, error) {
      onFailure(error);
    }
  });
}
