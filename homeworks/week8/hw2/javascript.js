
const API_URL = 'https://api.twitch.tv/kraken'
const CLIENT_ID = 'yfe6473olq7x1ok9n87fcbzfx1rx2o'
const request = new XMLHttpRequest()
const STREAM_TEMPLATE = `<a href="$channelUrl">
		<img class="live__image" src="$preview"/>
			<div class="live__information">
				<div class="live__avatar">
					<img src="$logo" >
				</div>
				<div class="live__description">
					<div class="live__title">$title</div>
					<div class="live__author">$channelName</div>
				</div>
			</div>
  		</a>`
getGames((games) => {
	for (const game of games) {
		const li = document.createElement('li')
		li.innerText = game.game.name
		document.querySelector('.nav__list').appendChild(li)
	}
	changeStreams(games[0].game.name)
})
// 取得被點擊的 list 遊戲名稱
document.querySelector('.nav__list').addEventListener('click', (e) => {
	if (e.target.tagName.toLowerCase() === 'li') {
		const gameName = e.target.innerText
		changeStreams(gameName)
	}
})
// 取得前五名遊戲名稱陣列
function getGames(callback) {
	request.open('get', `${API_URL}/games/top?limit=5`, true)
	request.setRequestHeader('Client-ID', CLIENT_ID)
	request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json')
	request.onload = () => {
		if (request.status >= 200 && request.status < 400) {
			const games = JSON.parse(request.responseText).top
			callback(games)
		} else {
			console.log('err')
		}
	}
	request.onerror = () => {
		console.log('error')
	}
	request.send()
}
function changeStreams(gameName) {
	document.querySelector('.games__title').innerText = gameName
	document.querySelector('.games__live').innerHTML = `<div class="live__card empty"></div>
		<div class="live__card empty"></div>`
	getStream(gameName, (streams) => {
		for (let i = streams.length - 1; i >= 0; i--) {
			const div = document.createElement('div')
			div.classList.add('live__card')
			div.innerHTML = STREAM_TEMPLATE
			.replace('$channelUrl', streams[i].channel.url)
			.replace('$preview', streams[i].preview.large)
			.replace('$logo', streams[i].channel.logo)
			.replace('$title', streams[i].channel.status)
			.replace('$channelName', streams[i].channel.name)
			const gameLive = document.querySelector('.games__live')
			gameLive.insertBefore(div, gameLive.childNodes[0])
		}
	})
}
function getStream(gameName, callback) {
	const request = new XMLHttpRequest()
	request.open('get', `${API_URL}/streams/?game=${encodeURIComponent(gameName)}&limit=20`, true)
	console.log(gameName)
	request.setRequestHeader('Client-ID', CLIENT_ID)
	request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json')
	request.onload = () => {
		if (request.status >= 200 && request.status < 400) {
			const { streams } = JSON.parse(request.responseText)
			callback(streams)
		}
	}
	request.send()
}
