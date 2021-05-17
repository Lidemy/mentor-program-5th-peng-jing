const request = require('request')
request(
	'https://lidemy-book-store.herokuapp.com/books?_limit=10',
	function( error, response, body){
		if(error){
			console.log('error',error)
			return
		}
		//若是 response 不是一個合法的 JSON 字串，會回傳錯誤
		try {
			let json
			json = JSON.parse(body)
			for(let i=0; i<json.length; i++){
			console.log(`${json[i].id} ${json[i].name}`)
			}
		} catch(e) {
			console.log(error)
			return
		}
	}
)