<link href="../style/followRecommendation.css" type="text/css" rel="stylesheet"/>
<script src="../business/jQuery.js"></script>

<div>

  <ul id="fr_ul">
  </ul>
</div>

<script>
var loadConnections = function(){
	var user_id='<?php echo $user_id ?>';
  console.log(user_id);
	var u='http://localhost:7080/api/users/' + user_id + '/followrecommendations/60';

	$.ajax({
	 	url: u,
		type: 'GET',
		dataType: 'json',

		success: function(data) {
			console.log(data);
			for (var i in data.response) {
				let name = data.response[i].first_name + ' ' + data.response[i].last_name;
        let field = data.response[i].field;
				let id = data.response[i].user_id;
        let followButton = document.createElement("button");//'<button class=\'followButton\'><div class=\'follow_button\' id=\'' + id + '\'> follow </div></button>';
        let mutualFollowings = data.response[i].mutual_followings;

        followButton.innerHTML = "follow";
        followButton.className = 'follow_button';
        followButton.id = id;

        let li = document.createElement("li");
        let h3 = document.createElement("h3");
        let p = document.createElement("p");

        p.innerHTML =  field + " <i> (" + mutualFollowings + " mutual followings)";
        h3.innerHTML = name;
        li.appendChild(h3);
        li.appendChild(p);
        li.appendChild(followButton);

        document.getElementById("fr_ul").appendChild(li);
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
