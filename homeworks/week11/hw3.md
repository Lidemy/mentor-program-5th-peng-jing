## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
### 雜湊與加密的差別
明文可逆 : 明文加密後會產生**密文**與**密鑰**，透過**密文**與**密鑰**可以逆推拿到原本的明文內容。
雜湊不可逆 : 無法從獲得的雜測值逆推回原本的內容。

### 為什麼密碼要雜湊後才存入資料庫?
如果以明文的方式將密碼存在資料庫會產生的問題
- 如果資料庫被駭客入侵，所有使用者帳號密碼都會直接被偷走使用。
- 若是資料庫管理者居心不良，或是不小心電腦畫面被別人看到，密碼都會直接外洩。

## `include`、`require`、`include_once`、`require_once` 的差別
都是屬於可以直接引入外部檔案的函式。
- include
	- 每次使用include語句時，它都會重新將請求的檔案匯入，即使這個檔案已經被匯入過。
	- 若是載入文件丟失，仍會繼續執行。
	- 告訴PHP提取特定的檔案，並載入它的全部內容
- require
    - 檔案只處理一次，通常放在 PHP 指令碼的最前面。
    - 若是載入文件丟失，就會停止執行。
    - 執行時就會先讀入目標檔案的內容，讓它變成 PHP 指令碼檔案的一部分。
- include_once
    功能跟 include 一樣，差別在於會檢查檔案是否被匯入過了，若有就會忽略，避免檔案一直被重複載入導致函數重定義，變量重新賦值等問題。
- require_once
    功能跟 require 一樣，差別在於如果該文件中的代碼已經被包含了，則不會再次包含。
    例如:如果本身有 session_start()，載入的文件也包含同樣代碼，就會發生錯誤。

## 請說明 SQL Injection 的攻擊原理以及防範方法
### 攻擊原理
把「 輸入的惡意資料」 變成「 程式的一部分 」，駭客在輸入資料時填上惡意 SQL 指令，來竄改原始網頁的 SQL 指令，達到竊取/破壞資料的行為。
### 攻擊方法
- 例如 : 登入頁面背後的檢查 SQL
    
    ```~~~~mysql
    select * from users where username='$name' and password='$password'
    ```
    如果駭客在輸入框填入帳號:「' or 1=1 #」;密碼:「任意值」
    實際執行時就會變成
    ```~~~~mysql
    select * from users where username='' or 1=1 #' and password='任意值'
    ```
    因為「#」在 MySQL 語法中代表註解的意思，所以「#」後面的字串通通沒有執行，而這句判斷式「1=1」永遠成立，駭客就能登入此網站成功。
    |  語法   | 意義  |
    |  :----:  | :----:  |
    | '        | 將 name 的 input 內容結束 |
    | 1=1      | 恆正 |
    | #       | 註解 |
    
    註解也可使用「/*」、「--」
### 防範方法
使用prepared statements(預先準備SQL語句)，再透過 bind_param (綁定參數)，將輸入值以引數的方式填入，會保證輸入值作為數值傳遞，不可能成為 SQL 語句的一部分。

```~~~~mysql
$sql = "SELECT * FROM user WHERE username = ? AND password = ?"; // 將要放輸入值的地方以問號填入
$stmt = $conn->prepare($sql); // 先將 SQL 準備好
$stmt = bind_param('ss', $username, $password); // 傳入引數，第一個參數代表每個引數的型態，s: String / i:Int
$stmt->execute; // 執行 SQL
```

##  請說明 XSS 的攻擊原理以及防範方法
### 攻擊原理
>在別人網站執行 JavaScript
跟 SQL Injection 一樣，本質也是讓使用者「 輸入的資料」 變成「 程式的一部分 」
利用 input 欄位，輸入特別的 JS 語法，當網頁 **輸出此內容** 時，就可以竄改網頁或竊取資料。
XSS 漏洞分為幾種類型：

- 儲存型 XSS ( Stored )
    - 網址列看不出問題
    - 最常見的例子就是網站留言板或是訊息，因為使用者可以留任何訊息。
    - 存在 DB 裡，所以每個使用者打開都會看到被修改的內容
    - 殺傷力最大
    ```~~~~mysql
    輸入頁
    <input type="text" placeholder="輸入內容"> // 輸入欄位
    <script>alert("XSS攻擊測試");</script> // 輸入惡意碼
    
    顯示頁
    <p>文字文字文字</p> // => 正常輸出
    <p><script>alert("XSS攻擊測試");</script></p> // => 不正常輸出，且每個使用者都會中標
    ```
- 反射型 XSS ( Reflected )
    - 把惡意程式藏在網址列裡，放在 GET 參數傳遞
    - 必須誘導使用者點到假連結才有用
    - 但網址列看起來會很可疑，可用短網址或特殊編碼魚目混珠

如果網頁是在網址上用參數判斷狀態：login.php?status='登入失敗'，且輸出錯誤訊息的方式是 直接把 value 印在網頁上，那麼只要把 value 換成 js 語法就可以攻擊成功
```~~~~mysql
// 網頁程式
if (isset($_GET['status']) && !empty($_GET['status'])) {
    echo $_GET['status'];
}

// 網址列
http://www.login.com?status='登入失敗'  => 印出登入失敗
http://www.login.com?status=<script>alert(1)</script>  => 執行惡意程式
```
- DOM 型 XSS
可能是頁面上有使用到 .html() 或 .innerHTML() 的語法
所以就可以直接放 JS 語法
跟前兩種 XSS 不一樣，此漏洞要在前端檢查
最好都改成 .innerText()=> 只會輸出純文字
### 防範方法
與其在輸入時驗證使用者的輸入，不如輸出時針對內容來做處理，也避免先處理後儲存在資料庫的資料，其他的系統看不懂。
使用 **htmlspecialchars** 來跳脫字元
任何使用者輸入的內容都不可信任，不能直接輸出原碼顯示，需要經過處理，將內容轉譯成純文字，而不是程式碼。
```~~~~mysql
 function escape($str) {
     return htmlspecialchars($str, ENT_QUOTES, $encoding, $double_encode)
 }
```
- 第 1 個參數是要轉換的字串
- 第 2 個參數為選用項目
    - ENT_COMPAT：預設，只轉換雙引號，不轉換單引號。
    - ENT_QUOTES：雙引號與單引號都要轉換。
    - ENT_NOQUOTES：單引號與雙引號都不轉換。

- 第 3 個參數用來設定要轉換的編碼
如果 PHP 版本是 PHP 5.4.0 之前的舊版本，\$encoding 的預設值會是 ISO-8859-1，如果是 PHP5.4.0 以上的新版本，$encoding 的預設值則是萬國碼 UTF-8，也可以自己設定。

- 第 4 個參數為選用項目，預設值是轉換全部的 HTML 碼。

## 請說明 CSRF 的攻擊原理以及防範方法
### CSRF ( Cross Site Request Forgery )，跨站請求偽造
一種 Web 上的攻擊手法，在不同網域下發送一個偽裝成使用者的 Request 給 Server。
假如今天進入了駭客提供的 A 網站，裡面包含了發送給 B 網站的 Request
```htmlembedded=
<html>
    <img src="https://blog.tw/delete?id=1"/>
</html>
```
如果在 B 網站的 SESSION 還沒過期，那在載入 A 網站後，就會發送一個 Request 給 B 網站
B網站會收到這樣的請求
```
GET https://blog.tw/delete?id=1
Cookie: PHPSESSID=使用者在 B 網站的 SESSID
```
B 網站以為是使用者本人的操作，就會把檔案刪除。

### 如何防範
- 檢查 Referer (不建議)
    透過 request 中叫做 referer 的欄位，檢查是不是合法的 domain ，不是的話就 reject 掉。
    漏洞 : 瀏覽器可能沒有帶 referer 或是使用者自動關閉
- 加上圖形驗證碼、簡訊驗證碼
    安全但對使用者麻煩，通常是金流網站才會使用。
- 加上 CSRF token
    在 form 裡面隱藏一個欄位 `name='csrftoken' value='<亂碼>'`
    value 由 server 隨機產生並儲存在 server 的 session 裡面，比對 $_POST['csrftoken'] 是否等於 $_SESSION['csrftoken'] 來確認是否本人。
    漏洞 : 攻擊者可以先發一個 request 取得 csrftoken
-  Double Submit Cookie
    一樣在表單放 csrftoken ，但這次不把值存在 server 的 session，而是在 clint side 設定一個名叫 csrftoken 的 cookie，值也是同一組 token。
    利用 Cookie 只能在同一個 domain 帶上來，攻擊者無法從不同的 domain 帶上此 Cookie
- SameSite cookie
    在 set-cookie 時多加上一個參數 **SameSite**，幫 Cookie 再加上一層驗證，不允許跨站請求。
    ```
    Set-Cookie: session_id=ewfewjf23o1; SameSite
    ```
    SameSite 有兩種模式，Lax跟Strict，默認是 Lax
    - Lax 寬鬆 : 除了 GET 外，POST、DELETE、PUT 等都不會帶上 cookie。
    - Strict 嚴格 : 只要不同 domain 都不會帶上 cookie。
但如果每次從外部進來都不會帶 cookie 的話，若有朋友傳連結卻因為沒有帶 cookie 的關係，每次都要重新登入也很麻煩，所以有些網站會準備兩組不同 cookie ，第一組不做設定，負責維持登入狀態，當有敏感操作(購買、設定帳戶等)則是使用第二組帶 **SameSite=strict** 的 cookie。
