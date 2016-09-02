var kirbyRatings = (function () {
	var fn = {};

	fn.init = function(url) {
		document.addEventListener("DOMContentLoaded", function() {
			fn.trigger();
			fn.outside();
			fn.form();
			fn.submit();
			fn.hover();

			fn.url = url;
		});
	};

	fn.trigger = function() {
		document.querySelector('.rating-trigger').addEventListener('click', function(e){
			document.querySelector('.ratings-modal').classList.add('ratings-modal-show');
			document.querySelector('.ratings-title').innerHTML = this.getAttribute('data-title');

			document.querySelector('.ratings-fields').setAttribute('data-id', this.getAttribute('data-id') );
			document.querySelector('.ratings-fields').setAttribute('data-secret', fn.secret() );
		});
	};

	fn.outside = function() {
		document.querySelector('.ratings-modal').addEventListener('click', function(e){
			document.querySelector('.ratings-modal').classList.remove('ratings-modal-show');
		});
	};

	fn.form = function() {
		document.querySelector('.ratings-form').addEventListener('click', function(e){
			e.stopPropagation();
		});
	};

	fn.secret = function() {
		var length = document.querySelector('.ratings-fields').getAttribute('data-id').length;
		var d = new Date();
		var n = d.getFullYear();
		var m = d.getMonth() + 1;
		var secret = length * n * m;
		return secret;
	};

	fn.submit = function() {
		document.querySelector('.ratings-submit').addEventListener('click', function(e){
			var value = document.querySelector('.ratings-fields').getAttribute('data-value');

			if( value != '' ) {
				fn.ajax();

			} else {
				 document.querySelector('.ratings-error').classList.add('ratings-message-show');
			}
		});
	};

	fn.hover = function() {
		var elements = document.querySelectorAll('.ratings-stars [type="radio"]'), i;
		for (i = 0; i < elements.length; ++i) {
			elements[i].addEventListener('click', function(e){
				document.querySelector('.ratings-fields').setAttribute('data-value', this.value );
				document.querySelector('.ratings-error').classList.remove('ratings-message-show');
			});

			elements[i].addEventListener('mouseover', function(e){
				document.querySelector('.ratings-vote-value').innerHTML = this.value;
				document.querySelector('.ratings-vote').classList.add('ratings-information-show');
			});

			elements[i].addEventListener('mouseout', function(e){
				document.querySelector('.ratings-vote').classList.remove('ratings-information-show');
			});
		}
	};

	fn.ajax = function() {
		var selector = document.querySelector('.ratings-fields');
		var id = selector.getAttribute('data-id');
		var secret = selector.getAttribute('data-secret');
		var value = selector.getAttribute('data-value');

		var url = fn.url + '/plugin.ratings/' + id + '?secret=' + secret + '&value=' + value;

		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){

			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var array = JSON.parse(xmlhttp.responseText);

				if( ! array['success'] ) {
					document.querySelector('.ratings-error').innerHTML = array.message;
					document.querySelector('.ratings-error').classList.add('ratings-message-show');

				} else {
					document.querySelector('.ratings-modal').classList.remove('ratings-modal-show');
					document.querySelector('.ratings-success').classList.add('ratings-message-show');
				}
			}
		}
		xmlhttp.open("POST", url, true);
		xmlhttp.send();
	};

	return fn;
})();
