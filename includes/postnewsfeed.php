<link href="../style/newsFeed.css" type="text/css" rel="stylesheet"/>
<script src="../business/jQuery.js"></script>
<script src="utils.js"></script>

<div id='nf_container'>
	<ul id="nf_buttons">
		<li><a id="responses">RESPONSES</a></li>
		<li><a id="share">SHARE</a></li>
		<li><a id="more">MORE</a></li>
	</ul>
	<textarea id="news_feed_post" rows="4" cols="50" name="news update" placeholder="What's on your mind?"></textarea>
  <ul id="nf_ul">
  </ul>
</div>

<script>

var appendToList = function(data, front=false) {
	let name = data.first_name + ' ' + data.last_name;
	let field = data.field;
	let id = data.user_id;
	let content = '\n' + data.content;
	console.log(content);

	let headerList = document.createElement("ul");
	let li = document.createElement("li");
	let p = document.createElement("p");
	let text = document.createElement("p");
	let like = document.createElement("i");
	let likeCount = document.createElement("p");
	/* Temporary icon */
	let icon = document.createElement("i");
	let li1 = document.createElement("li");
	let li2 = document.createElement("li");
	let aIcon = document.createElement("a");
	let userFullName = document.createElement("a");

	userFullName.id = "user-full-name";
	text.id = "post-content";

	aIcon.appendChild(icon);
	userFullName.innerHTML = name;
	li1.appendChild(aIcon);
	li2.appendChild(userFullName);

	headerList.appendChild(li1);
	headerList.appendChild(li2);

	headerList.id = "header_list";

	icon.className = "fas fa-user-circle";
	icon.id = "user-icon";


	p.innerHTML =  field;
	text.innerHTML = content;
	like.className = "fas fa-thumbs-up";
	like.id = "like";
	likeCount.innerHTML = "0"
	like.appendChild(likeCount);


	li.appendChild(headerList);

	//li.appendChild(document.createElement("br"));
	li.appendChild(p);
	li.appendChild(text);
//	li.appendChild(like);

	element = document.getElementById("nf_ul");
	if (!front){
		element.appendChild(li);
	}
	else {
		element.insertBefore(li, element.firstChild);
	}
}



var loadNewsFeed = function(){
	var user_id='<?php echo $user_id ?>';
	var u='http://localhost:7080/api/post/user/' + user_id + '/feed/from/0/to/20';
	getFromServer(u, (response) => {
			console.log(response);
			for (var i in response.data) {
			appendToList(response.data[i]);
		}
	}, (error) => {console.log("Failure" + " " + error);});
}

var postNewsFeed = function() {
	let text = document.getElementById('news_feed_post').value;

	if (text.length === 0 || text.length > 63206) {
		return;
	}
	let user_id='<?php echo $user_id ?>';
	let url='http://localhost:7080/api/post/user/' + user_id;
	let post = JSON.stringify({content: text, type: 'text', category: 'test', post_url: 'holder'});
	postToServer(url, post, (response)=>{
		appendToList(response, true);
		console.log('recieved response: ' + JSON.stringify(response));
	},
	(error)=>{
		console.log('recieved error: ' + error);
	});
}

loadNewsFeed();
$("#share").click(postNewsFeed);

</script>
