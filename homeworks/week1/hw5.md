## 請解釋後端與前端的差異。
- 前端: 網頁看得到的部分，負責瀏覽器上的畫面互動，如購物網站的登入畫面。
- 後端: 網頁看不到的部分，在收到前端的 request 時，負責到資料庫撈資料再回傳給前端，如購物網站登入會員時，在登入畫面按下 login 按鈕後，前端會發送 request 到後端 server 請它到資料庫去查詢資料，再根據查詢結果回傳給前端來顯示畫面。
## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
1. 按下 Enter 後，瀏覽器將發送 request 到 Google 的伺服器
2. Google 伺服器會再跟資料庫查詢跟 JavaScript 相關的資料
3. 查詢完畢後會再將資料回傳給前端顯示出來。
## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
1. notepad: 開啟記事本
2. nslookup: 可以查到本機 DNS 基礎訊息
3. start << file name >>: 後面加上位置底下的檔案或資料夾名稱即可開啟檔案/資料夾