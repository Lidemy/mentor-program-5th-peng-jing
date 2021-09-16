## 什麼是 MVC？
將架構分為 module、view、controller
- model: 負責拿資料。
- view: 負責顯示畫面，使用 res.render('view 底下的檔案名')，就會自動去 view 底下抓取。
- contorller: 負責決定要執行什麼動作，當要顯示包含資料時的畫面時，會先去 model 拿完資料，再去 view 將資料塞進去後 render 出來。

## 請寫下這週部署的心得
heroku 部屬簡直困難重重 QQ
- 問題 1 (解決)
一開始遇到了 302 無限轉址的問題，重新佈署也還是一樣，後來發現 log 資料最一開始的地方有顯示 Error: Cannot find module 'EJS'(因為一直無限 302 就把一開始的 log 洗掉的樣子)，我到 package.json 裡面看，發現是小寫後就把 app.set('view engine', 'EJS') 改成小寫 ejs，重新 push 後就可以了。
- 問題 2 (未解決)
在 heroku Config Vars 設定 process.env.SESSION_SECRET 的變數，但在 index.js 中將變數改為 secret: process.env.SESSION_SECRET 後就會回傳錯誤 500，頁面顯示 "internal server error"，log 顯示如下，爬文後還是無法解決就先放著了QQ
![Alt text](https://i.imgur.com/WciLdWF.png)
這周真的重複部屬好多次，但錯誤訊息好像來來去去就那幾個，表示我一直在犯同樣的錯誤哈哈哈...，302 轉址研究了兩天才解決，debug 真的好需要練習，希望經過這周後我的 debug 技能能提升一點QQ

## 寫 Node.js 的後端跟之前寫 PHP 差滿多的，有什麼心得嗎？
方便好多喔~架構變得好整齊，功能、資料跟頁面都分開，要找東西也很方便，但是對於 middleware next() 的概念我好像還是不太清楚，對於權限檢查的部分我原本有拉出來做一個 middleware(如圖)
原本我的寫法
![](https://i.imgur.com/G3SGKHx.png)
這樣寫會顯示 TypeError: req.next is not a function，執行完 hasAdmin 仍會繼續執行印出，之前的每一行加上 console.log(typeof req.next) 的話就會印出 function
![](https://i.imgur.com/3KTG1OA.png)



看了自我檢討後改成老師的寫法
- 檢查權限的 function
![](https://i.imgur.com/A9XLvXI.png)
- 在 controller 裡面執行
![](https://i.imgur.com/dfnq4qp.png)
- 執行結果
![](https://i.imgur.com/ag4rf2P.png)
印出 2 3 4 的是還沒登入時
印出 2 5 的是已經登入後，但登入後去點新增文章會沒辦法進入頁面
因為沒辦法解決所以還是先改回原本寫在 controller 裡面的寫法XD