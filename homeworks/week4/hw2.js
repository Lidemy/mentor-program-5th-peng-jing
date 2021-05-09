const request = require('request')
const process = require('process')
let booksUrl = 'https://lidemy-book-store.herokuapp.com/books/'
let Method = process.argv[2]
let idName = process.argv[3]
let Name = process.argv[4]
// console.log(process.argv)
resMethod() (
	result(),
	function( error, response, body){
		console.log(body)
	}
)

function result(){ //印出的內容
	if(Method === undefined) return booksUrl
	if(Method === 'list') return booksUrl + '?_limit=20' // 印出前二十本書的 id 與書名
	if(Method === 'read') return booksUrl + idName // 輸出指定 id 的書籍
	if(Method === 'delete') return booksUrl + idName // 刪除指定 id 的書籍
	if(Method === 'create') return Add() // 新增書籍
	if(Method === 'update') return Modify() //修改書籍名稱
} 
function resMethod(){  //判斷執行動作
	if(Method === 'list' || Method === 'read' || Method === undefined) return request
	if(Method === 'delete') return request.delete
	if(Method === 'create') return request.post
	if(Method === 'update') return request.patch
}
function Add(){ // 新增指定名稱的書
	return {
		url: booksUrl,
		form: {
			name: idName
		}
	}
}
function Modify(){ // 修改指定書籍的名稱
	return {
		url: booksUrl+idName,
		form: {
			name: Name
		}
	}
}
