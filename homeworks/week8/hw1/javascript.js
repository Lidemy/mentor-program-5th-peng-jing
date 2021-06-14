document.querySelector('.games__btn').addEventListener('click', () => {
	const request = new XMLHttpRequest()
	request.onload = () => {
		if (request.status >= 200 && request.status < 400) {
			const data = request.responseText
			const dataArr = JSON.parse(data)
			if (dataArr.prize === 'FIRST') return prizeResult('恭喜你中頭獎了！日本東京來回雙人遊！', 'url(./first.jpg) center/cover no-repeat')
			if (dataArr.prize === 'SECOND') return prizeResult('二獎！90 吋電視一台！', 'url(./second.jpg) center/cover no-repeat')
			if (dataArr.prize === 'THIRD') return prizeResult('恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！', 'url(./third.jpg) center/cover no-repeat')
			if (dataArr.prize === 'NONE') return prizeResult('銘謝惠顧', 'black')
		} else {
			alert('系統不穩定，請再試一次')
		}
	}
	const game = document.querySelector('.games')
	function prizeResult(prizeTitle, prizeImage) {
		const div = document.createElement('div')
		div.innerText = prizeTitle
		div.classList.add('prize__title')
		game.appendChild(div)
		game.style.background = prizeImage
		game.removeChild(document.querySelector('.games__content'))
	}
	request.onerror = function() {
			console.log('error')
	}
	request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true)
	request.send()
})
