var readline = require('readline');

var lines = []
var rl = readline.createInterface({
  input: process.stdin
});

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
})

function solve(lines) { 
	let M = Number(lines[0])
	for(let i=1;i<=M;i++){
		console.log(gameResult(lines[i]))
	}
}
function gameResult(str){
	let arr = str.split(' ')
	let A = arr[0]
	let B = arr[1]
	let K = Number(arr[2])
	if(A === B) return "DRAW"
	if(K === 1) return isWinner(A,B) ? 'A' : 'B'
	if(K === -1) return	isWinner(A,B) ? 'B' : 'A'
}
function isWinner(A,B){
	if (A.length === B.length) return A > B
	return A.length > B.length
}