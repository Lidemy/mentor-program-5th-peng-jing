const API_URL = 'https://api.twitch.tv/kraken'
const CLIENT_ID = 'yfe6473olq7x1ok9n87fcbzfx1rx2o'
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
// 取得被點擊的 list 遊戲名稱
document.querySelector('.nav__list').addEventListener('click', (e) => {
	if (e.target.tagName.toLowerCase() === 'li') {
		const gameName = e.target.innerText
		changeStreams(gameName)
	}
})
// 拿到前五名的遊戲並顯示在 nav
async function getGames() {
	try {
		const response = await fetch(`${API_URL}/games/top?limit=5`, {
			headers: {
				'Client-ID': CLIENT_ID,
				Accept: 'application/vnd.twitchtv.v5+json'
			}
		})
		const gamesJson = await response.json()
		const games = gamesJson.top
		for (const game of games) {
			const li = document.createElement('li')
			li.innerText = game.game.name
			document.querySelector('.nav__list').appendChild(li)
		}
		changeStreams(games[0].game.name) // 用第一名遊戲名稱拿到前 20 名實況
	} catch (err) {
		console.log('err', err)
	}
}
getGames()// 呼叫執行 getGames function
// 拿到前 20 名實況並顯示
async function changeStreams(gameName) {
	document.querySelector('.games__title').innerText = gameName
	document.querySelector('.games__live').innerHTML = `<div class="live__card empty"></div>
		<div class="live__card empty"></div>`
	try {
		const response = await fetch(`${API_URL}/streams/?game=${encodeURIComponent(gameName)}&limit=20`, {
			headers: {
				'Client-ID': CLIENT_ID,
				Accept: 'application/vnd.twitchtv.v5+json'
			}
		})
		const streamsJson = await response.json()
		const { streams } = streamsJson
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
	} catch (err) {
		console.log('err', err)
	}
}
