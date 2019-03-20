<link href="../style/followingsList.css" type="text/css" rel="stylesheet"/>
<script src="../business/jQuery.js"></script>

<div>

  <ul id="fl_ul">
  </ul>
</div>

<script>
var loadConnections = function(){
	var user_id='<?php echo $user_id ?>';
  console.log(user_id);
	var u='http://localhost:7080/api/users/' + user_id + '/followings';

	$.ajax({
	 	url: u,
		type: 'GET',
		dataType: 'json',

		success: function(data) {
			console.log(data);
			for (var i in data) {
				let name = data[i].first_name + ' ' + data[i].last_name;
        let field = data[i].field;
				let id = data[i].user_id;
        let li = document.createElement("li");
        let h3 = document.createElement("h3");
        let p = document.createElement("p");

        p.innerHTML =  field;
        h3.innerHTML = name;
        li.appendChild(h3);
        li.appendChild(p);

        document.getElementById("fl_ul").appendChild(li);
			}
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}

var followUser = function(event) {
  let cls = $(event.target).attr('class');
  console.log(cls);
  if (!(cls === 'follow_button'))
    return;

  var user_id='<?php echo $user_id ?>';
  let follow_id = event.target.id;
  console.log('button class follow_button clicked with user id=' + user_id);
  var u='http://localhost:7080/api/users/' + user_id + '/followings/' + follow_id;


  $.ajax({
	 	url: u,
		type: 'POST',
		dataType: 'json',

		success: function(data) {
			location.reload();
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});
}

$("#fr_ul").click(followUser);

loadConnections();
</script>
