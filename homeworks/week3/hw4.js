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
	let str = lines[0].split('')
	if(isPalindrome(str)){
		console.log("True")
	}else{
		console.log("False")
	}
	
}

function isPalindrome(str){
	let max = Math.floor(str.length / 2)
	let n = str.length-1
	for(let i=0; i<max; i++){
		if(!(str[i] === str[n-i])){
			return false
		}
	}
	return true
}