const request = require('request')

const options = {
	url: 'https://api.twitch.tv/kraken/games/top',
	headers: {
		'Accept': 'application/vnd.twitchtv.v5+json',
		'Client-ID': 'yfe6473olq7x1ok9n87fcbzfx1rx2o'
	}
}

function callback(error, response, body){
	const json = JSON.parse(body)
	for(let i=0; i<json.top.length; i++ ){
		console.log(json.top[i].viewers + ' ' + json.top[i].game.name)
	}
}

request(options, callback)


// curl -H 'Accept: application/vnd.twitchtv.v5+json' \
// -H 'Client-ID: yfe6473olq7x1ok9n87fcbzfx1rx2o' \
// -X GET 'https://api.twitch.tv/kraken/games/top'