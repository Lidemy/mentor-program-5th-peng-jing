const request = require('request')
request(
	'https://lidemy-book-store.herokuapp.com/books?_limit=10',
	function( error, response, body){
		console.log(body)
	}
)