const request = require('request')
const process = require('process')
let country = process.argv[2]

request(
	'https://restcountries.eu/rest/v2/name/' + country ,
	function(error, response, body){
		let json
		//若是 response 不是一個合法的 JSON 字串，會回傳錯誤
		try {
			json = JSON.parse(body)
		} catch(e) {
			console.log(e)
		}
		// response.statusCode 範圍不寫死
		if(response.statusCode >= 400 && response.statusCode < 500) console.log ('找不到國家資訊')
		for(let i=0; i<json.length; i++){
			console.log('============')
			console.log( '國家 : ' + json[i].name)
			console.log( '首都 : ' + json[i].capital)
			console.log( '貨幣 : ' + json[i].currencies[0].code)
			console.log( '國碼 : ' + json[i].callingCodes[0])
		}
	}
)