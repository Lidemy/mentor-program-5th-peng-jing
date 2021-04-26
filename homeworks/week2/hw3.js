function reverse(str) {
	var resStr = ""
	for(var i=str.length-1;i>=0;i--){
		resStr+= str[i]
	}
	console.log(resStr)
}

reverse('hello');
