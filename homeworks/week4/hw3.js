const request = require('request')
const process = require('process')
let country = process.argv[2]

request(
	'https://restcountries.eu/rest/v2/name/' + country ,
	function(error, response, body){
		const json = JSON.parse(body)
		if(response.statusCode === 404) console.log ('找不到國家資訊')
		for(let i=0; i<json.length; i++){
			console.log('============')
			console.log( '國家 : ' + json[i].name)
			console.log( '首都 : ' + json[i].capital)
			console.log( '貨幣 : ' + json[i].currencies[0].code)
			console.log( '國碼 : ' + json[i].callingCodes[0])
		}
	}
)