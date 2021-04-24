function join(arr, concatStr) {
  var arrJoin=arr[0]
  for(var i=1; i<arr.length; i++){
  	arrJoin+= concatStr + arr[i]
  	
  }
  return arrJoin
}

function repeat(str, times) {
	var strRep=""
  	for(var i=0; i<times; i++){
  		strRep+= str
  	}
  	return strRep
}

console.log(join(["a",1,"b",2,"c",3], ','));
console.log(repeat('a', 5));
