## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
在儲存字符串時，可使用 char、varchar 或是 text。
- char: 長度固定，長度可為 0~255的任何值。
- VARCHAR: 可變長度的字串，適合用在長度可辨的屬性(長度介於 0 ~ 65535，在 5.0.3 以下版本的最大長度限制為 255 ，而 5.0.3 以上版本中，長度支持到 655354)。
- TEXT: 不設置長度，當不知道屬性的最大長度時，適合用 TEXT 。
查詢速度: char 最快、varchar 次之、text 最慢。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
可以將使用者的狀態紀錄儲存在 Cookie ，Server 透過檢視 Cookie 的內容，就能辨識使用者是誰，也可以設定 Cookie 的有效時間。

向 Server 發送一個請求後，回傳帶有 Set-Cookie 的 Response Header，這樣就把 Cookie設置好了，之後瀏覽器發送請求時，Request Header 會帶有 Cookie ，就能讓 Server 認出使用者的狀態。


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
密碼儲存為明碼，沒有加密，網站管理者可以直接看到使用者的密碼。如果駭客駭進網站資料庫的主機，那使用者的帳號和密碼都會外洩。


