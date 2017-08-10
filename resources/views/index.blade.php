<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Item Manager</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Item Manager</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
<h1>Add Item</h1>
<form id="itemForm">
<div class="form-group">
<label>Text</label>
<input type="text" id="text" class="form-control">
</div>	
<div class="form-group">
<label>Body</label>
<textarea id="body" class="form-control"></textarea>
</div>
<input type="submit" value="submit" class="btn btn-default">
</form>

<hr>

<ul id="items" class="list-group"></ul>
	
</div>



<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){

		getItems();

		//submit event
		$('#itemForm').on('submit', function(e){
			e.preventDefault();

			let text = $('#text').val();
			let body = $('#body').val();

			addItem(text, body);
		});

		//Delete event
		$('body').on('click','.deleteLink', function(e){
			e.preventDefault();
			let id = $(this).data('id');
			deleteItem(id);
		});
//function for delete
	
	function deleteItem(id){

			$.ajax({
				method: 'POST',
				url:'http://127.0.0.1:8000/api/items/'+id,
				data: {_method: 'DELETE'}

			}).done(function(item){
				alert('Item Removed');
				location.reload();
			});
	}

		//inset items using API
		function addItem(text, body){
			$.ajax({
				method: 'POST',
				url:'http://127.0.0.1:8000/api/items',
				data: {text:text, body:body}

			}).done(function(item){
				alert('Item #' + item.id + ' added');
				location.reload();
			});
		}
		//Get Items from API

		function getItems(){
			$.ajax({
				url:'http://127.0.0.1:8000/api/items/'
			}).done(function(items){
				let output = '';
				$.each(items, function(key, item){
					output +=`
					<li class="list-group-item">
					<strong>${item.text}: </strong>${item.body} <a href="#" class ="deleteLink" data-id="${item.id}">Delete</a>
					</li>
					`;

				});
				$('#items').append(output);
			});
		}
	});

</script>
</body>
</html>
