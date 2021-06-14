## 什麼是 Ajax？
非同步的 JavaScript 與 XML 技術( Asynchronous JavaScript and XML)，透過 JavaScript 發 Request，Server 回傳 Response 給瀏覽器，瀏覽器再將 Response 回傳給 JS ，不用換頁也能跟 Server 溝通。
什麼是同步?什麼是非同步?
- 同步:會等這行程式執行完畢並得到 Response 後才繼續往下執行，確保執行順序。
- 非同步:執行後不等 Response 回來就繼續往下執行，就像排隊時拿了呼叫器，可以先去做別的事情，等餐點好了呼叫器響了，再來拿餐點。

## 用 Ajax 與我們用表單送出資料的差別在哪？
- 表單: 透過表單送出資料，就會換頁，並直接將 Response render 出來。
- Ajax: 透過 JavaScript 發 Request，Server 回傳 Response 給瀏覽器，瀏覽器再將 Response 回傳給 JS ，不用換頁也能跟 Server 溝通。

## JSONP 是什麼？
利用像是在 \<img>、<script> 中，用 src 來載入圖片或是 js 檔案的功能，透過 src 標籤來傳遞資料，就能達成跨網域取得資料。
缺點是只能透過 GET 方式將參數附加在網址上傳遞出去，沒辦法用 POST。

## 要如何存取跨網域的 API？
必須要 Server 端的 Resopnse 的 Header 有加上 'access-control-allow-origin' 才能允許 Client 端收到 Response。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
node.js : 沒有任何限制與干擾，從本地端直接傳遞 request 。
瀏覽器: 透過瀏覽器將 request 傳送到 server 端，瀏覽器就像大樓管理員，基於安全性的考量會針對出入有某些限制與規範(同源政策、 CORS 等)。遇到跨網域的 API 時，若 Server 端的 Response header 沒有 'access-control-allow-origin' 這個參數的話，就會被禁止傳遞。

