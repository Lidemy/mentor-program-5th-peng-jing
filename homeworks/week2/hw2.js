function capitalize(str) {
	strUpper1 = str[0].toUpperCase()
	for(var i=1;i<str.length;i++){
		strUpper1 += str[i]
	}
	return strUpper1
}

console.log(capitalize('hello'));
