## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
DNS 為 Domain Name System 的縮寫，中文為網域名稱系統，用來建立網域名稱與 IP 位址的對應關係。IP 位址就像地址「台北市北平西路3號」，網域名稱則是地標「台北車站」，因為有 DNS 連結兩者關係，我們可以透過好記的域名到達 IP 位址。

公開的 DNS 的好處
對 Google 來說
- 可以收集使用者的瀏覽數據

對一般大眾來說
- 上網速度快
- 較高的安全性(及時最新的釣魚、詐騙網站清單)
- 減少網址重導
- 更新速度快


## 什麼是資料庫的 lock？為什麼我們需要 lock？
可以鎖定特定資料，避免同時對同一筆資料做操作，當有人正在操作時，下一個人的操作會被擋住直到當前操作完畢。

在銀行操作或是購買商品時，為了確保金額的正確、商品不超賣，需要確保每個操作不互搶，所以當有人進入該筆資料操作時，就不能有其他人同時變動。

lock 程式碼
```sql=
$conn->autocommit(FALSE);  
$conn->begin_transaction();  
$conn->query("SELECT amount from products where id = 1 for update");  
$conn->commit();  
```

## NoSQL 跟 SQL 的差別在哪裡？
NoSQL 是非關聯式資料庫，在 SQL 中有資料表跟欄位屬於關聯式資料庫，而 NoSQL 相反，它沒有 Schema ，想放什麼資料型態都可以，用 key-value 儲存，通常用來存結構不固定的資料。

## 資料庫的 ACID 是什麼？
分別代表
Atomicity（原子性）: 只能全部成功或全部失敗
Consistency（一致性）: 維持資料的一致性，轉出去的錢跟對方收的錢要一樣
Isolation（隔離性）: 不能同時改同一個值
Durability（持久性）: 交易成功後，資料不會不見