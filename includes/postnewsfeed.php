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

var likeElementsClicked = new Set();
var appendToList = function(data, front=false) {
	let name = data.first_name + ' ' + data.last_name;
	let field = data.field;
	var date = timestampToLocalDate(data.date_created);

	console.log(data.date_created + " Date: " + date);
	let id = data.user_id;
	let content = '\n' + data.content;
	console.log(content);

	let headerList = document.createElement("ul");
	let li = document.createElement("li");
	let p = document.createElement("p");
	let text = document.createElement("p");
	let like = document.createElement("i");
	let likeCount = document.createElement("p");
	let icon = document.createElement("img");
	let li1 = document.createElement("li");
	let li2 = document.createElement("li");
	let aIcon = document.createElement("a");
	let userFullName = document.createElement("a");
	let li3 = document.createElement("li");
	let trash = document.createElement("i");

	likeCount.id = 'like_count';
	userFullName.id = "user_full_name";
	text.id = "post-content";

	aIcon.appendChild(icon);
	userFullName.innerHTML = name;
	li1.appendChild(aIcon);
	li2.appendChild(userFullName);

	headerList.appendChild(li1);
	headerList.appendChild(li2);

	trash.id ="trash";
	trash.className="fas fa-trash";
	headerList.id = "header_list";

	icon.className = "fas fa-user-circle";
	icon.id = "user-icon";
	icon.src = getUserIconURL(id);


	p.innerHTML =  field + ' (<i>' + date + '</i>)';
	text.innerHTML = content;
	like.className = "fas fa-thumbs-up";
	like.id = "like";
	likeCount.innerHTML = "0";
	likeCount.className=data.post_id;
	getLikesForElement(data.post_id, likeCount);
	handleIfUserLikesPost(data.post_id, like);
	like.appendChild(likeCount);


	li.appendChild(headerList);

	//li.appendChild(document.createElement("br"));
	li.appendChild(p);
	li.appendChild(text);
	li.appendChild(like);
	li.appendChild(trash);

	element = document.getElementById("nf_ul");
	if (!front){
		element.appendChild(li);
	}
	else {
		element.insertBefore(li, element.firstChild);
	}
}


var getLikesForElement = function(post_id, likeCount){
	var u='http://localhost:7080/api/post/likes/' + post_id;
	getFromServer(u, (response) => {
			console.log("Count: " + response.count);
			likeCount.innerHTML = response.count;
	}, (error) => {console.log("Failure" + " " + error);});
}

var handleIfUserLikesPost = function(post_id, thumbsUp){
	var user_id='<?php echo $user_id ?>';
	var u='http://localhost:7080/api/post/user/' + user_id + '/like/' + post_id;
	getFromServer(u, (response) => {
			if (response.likes) {
				thumbsUp.style.color = "#00F";
				likeElementsClicked.add(thumbsUp);
			}
	}, (error) => {});
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

var likeOrUnlikePost = function(post_id, countElement=undefined) {
	let user_id='<?php echo $user_id ?>';
	let url='http://localhost:7080/api/post/user/' + user_id + '/like/' + post_id;
	postToServer(url, undefined, (response) => {
		if (countElement == undefined) {
			return;
		}

		if (response.posted==true){
			countElement.innerHTML = parseInt(countElement.innerHTML) + 1;
			countElement.parentElement.style.color = "#00F";
			likeElementsClicked.add(countElement.parentElement);
		}
		else {
			url='http://localhost:7080/api/post/user/' + user_id + '/unlike/' + post_id;
			postToServer(url, undefined, (response) => {
				if (response.posted==true){
					countElement.innerHTML = parseInt(countElement.innerHTML) - 1;
					countElement.parentElement.style.color = "#3498FF";
				}
				likeElementsClicked.delete(countElement.parentElement);
			});
		}
	},
	(error)=> {

	});
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
$('#nf_ul').on('click', '#like', function(e){
	let element = $(this).find('#like_count')[0];
	let post_id = element.className;
	console.log(element);
	likeOrUnlikePost(post_id, element);
});

$('#nf_ul').on('mouseenter', '#like', function(e) {
	let element = $(this)[0];
	element.style.color = "#00F";
});

$('#nf_ul').on('mouseleave', '#like', function(e) {
	let element = $(this)[0];
	if (likeElementsClicked.has(element)) {
		return;
	}
	element.style.color = "#3498FF";
});

</script>
