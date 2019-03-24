<link href="../style/followRecommendation.css" type="text/css" rel="stylesheet"/>
<script src="../business/jQuery.js"></script>
<script src="utils.js"></script>


<div>
  <i id="fr_spinner" class="fa fa-spinner fa-spin">
  </i>

  <table id="fr_table">
    <tr id="fr_row">
      <td id="fr_connect_column">
        <p id ="fr_connect_header">
          CONNECT.
        </p>
        <p id="fr_connect_subtitle">EXPAND YOUR NETWORK</p>
        <p id="fr_connect_paragraph">
          Lorem ipsum dolor sit amet, consectetur
          adipisicing elit, sed do elusmod tempor
          incididunt ut ero labore et dolore
        </p>
      </td>
    </tr>
  </table>
</div>

<script>
var loadConnections = function(){
	var user_id='<?php echo $user_id ?>';
  console.log(user_id);
	var u='http://localhost:7080/api/users/' + user_id + '/followrecommendations/60';
  console.log(u);
	$.ajax({
	 	url: u,
		type: 'GET',
		dataType: 'json',

		success: function(data) {
      let tbl = document.getElementById("fr_table");
      let spinner = document.getElementById("fr_spinner");

      tbl.style.visibility = "hidden";
      console.log(tbl.style);
			console.log(data);
      let tr = document.getElementById("fr_row");
      tr.id = "fr_row";
      let count = 1;
			for (var i in data.response) {
        let td = document.createElement("td");
				let name = data.response[i].first_name + ' ' + data.response[i].last_name;
        let field = data.response[i].field;
				let id = data.response[i].user_id;
        let mutualFollowings = data.response[i].mutual_followings;
        let icon = document.createElement("img");

        icon.className = "fas fa-user-circle";
        icon.id = "fr_user_icon";
        icon.src = getUserIconURL(id);

        let li = document.createElement("li");
        let pName = document.createElement("p");
        let p = document.createElement("p");

        p.innerHTML =  field + " <i> (" + mutualFollowings + " mutual followings)";
        pName.innerHTML = name;

        td.appendChild(icon);
        td.appendChild(pName);
        td.appendChild(p);

        pName.id = "fr_name";
        td.id = "fr_column";

        td.className = id;

        tr.appendChild(td);

        if (count % 4 == 3) {
          document.getElementById("fr_table").appendChild(tr);
          tr = document.createElement("tr"); // get a new row
          tr.id = "fr_row";
        }
        ++count;
			}
      if (tr.childElementCount > 0) {
        document.getElementById("fr_table").appendChild(tr);
      }
      spinner.style.visibility = "hidden";
      tbl.style.visibility = "visible";
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}

var followUser = function(event) {
  let follow_id = $(event.target).attr('class');

  if (follow_id == undefined) {
    return;
  }

  var user_id='<?php echo $user_id ?>';
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

$("#fr_row").click(followUser);

loadConnections();
</script>
