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
	let star = ""
	for(let i=1;i<=lines;i++){
		star += "*"
		console.log(star)
	}
}