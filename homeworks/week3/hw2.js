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
	let Num = lines[0].split(' ')
	let N = Number(Num[0])
	let M = Number(Num[1])
	for(let i=N;i<=M;i++){
		if(isNarcissistic(i)){
			console.log(i)
		}
	}	
}
function count(n){
	let result=0;
	while(n!=0){
		n = Math.floor(n/10)
		result++
	}
	return result
}
function isNarcissistic(n){
	let m = n
	let digits = count(n)
	let sum = 0
	while(m!=0){
		let num = m % 10
		sum+= num ** digits
		m = Math.floor(m/10)
	}
	return sum === n
}