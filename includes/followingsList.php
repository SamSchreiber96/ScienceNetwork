<link href="../style/followingsList.css" type="text/css" rel="stylesheet"/>
<script src="../business/jQuery.js"></script>
<script src="utils.js"></script>


<div>
  <i id="following_spinner" class="fa fa-spinner fa-spin">
  </i>

  <table id="following_table">
    <tr id="following_row">
      <td id="following_connect_column">
        <p id ="following_connect_header">
          YOUR NETWORK.
        </p>
        <p id="following_connect_subtitle">EXPLORE YOUR NETWORK</p>
        <p id="following_connect_paragraph">
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
	var u='http://localhost:7080/api/users/' + user_id + '/followings';
  console.log(u);
	$.ajax({
	 	url: u,
		type: 'GET',
		dataType: 'json',

		success: function(data) {
      let tbl = document.getElementById("following_table");
      let spinner = document.getElementById("following_spinner");

      tbl.style.visibility = "hidden";
      console.log(tbl.style);
			console.log(data);
      let tr = document.getElementById("following_row");
      tr.id = "following_row";
      let count = 1;
			for (var i in data.response) {
        let td = document.createElement("td");
				let name = data.response[i].first_name + ' ' + data.response[i].last_name;
        let field = data.response[i].field;
				let id = data.response[i].user_id;

        let icon = document.createElement("img");

        icon.className = "fas fa-user-circle";
        icon.id = "following_user_icon";
        icon.src = getUserIconURL(id);

        let li = document.createElement("li");
        let pName = document.createElement("p");
        let p = document.createElement("p");

        p.innerHTML =  field;
        pName.innerHTML = name;

        td.appendChild(icon);
        td.appendChild(pName);
        td.appendChild(p);

        pName.id = "following_name";
        td.id = "following_column";

        td.className = id;

        tr.appendChild(td);

        if (count % 4 == 3) {
          document.getElementById("following_table").appendChild(tr);
          tr = document.createElement("tr"); // get a new row
          tr.id = "following_row";
        }
        ++count;
			}
      if (tr.childElementCount > 0) {
        document.getElementById("following_table").appendChild(tr);
      }
      spinner.style.visibility = "hidden";
      tbl.style.visibility = "visible";
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}


loadConnections();
</script>
