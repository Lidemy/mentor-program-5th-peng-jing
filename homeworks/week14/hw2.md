[我的部署](http://janetpj.tw/board/)
一直很害怕實作這週的部署忍不住一直跳過，覺得各種複雜好像一碰就會爆炸 XD 逃避到現在終於決定面對，試著了解整個流程不知道對不對

- 租虛擬主機
	- 先租一塊地(主機)
	- 決定房子空間要多大(建立 EC2，具有 scalability)
	- 房子蓋好(裝 Ubuntu 作業系統)
	- 設定好後就拿到房子鑰匙(金鑰)。
- 設定虛擬主機環境
	- 在 git bash 拿著地址 ( Public IPv4 address ) 跟鑰匙(金鑰)進入房子
	- 裝潢房子內部環境(安裝 LAMP，算是組合包?一次裝好作業系統、伺服器、資料庫、跟程式語言，可是已經有  Ubuntu 作業系統，然後又有 Linux 作業系統嗎?，沒辦法理解作業系統的差別，伺服器又是怎麼樣呢?查詢後我的理解是伺服器包含了硬體跟軟體，軟體又包含了作業系統跟應用程式)
	- 裝潢儲藏室並加一把鎖(安裝 phpmyadmin，算是指定圖形介面要使用這個系統當作資料庫這樣嗎?為了登入圖形介面，所以要設定密碼)
	- 把東西搬進儲藏室(在 phpmyadmin，用帳號 root 跟剛剛設定的密碼進去，把以前資料表匯出後在這邊匯入即可)
	- 把生活用品搬進房子各個房間 (在 /var/www/html 目錄中放入資料夾，資料夾相當於房間，要看到內容的話網址要變成 ip/資料夾名)
- 把域名連結到主機
	- 給自己的家取個名字，並詔告天下這個地址(IP) = 這個名字(域名)，要來我家用這個名字也到得了 (在  Gandi 購買好域名後，在區域檔記錄裡面設定 DNS，將 A 記錄的值輸入主機的 Public IPv4 address，可能不會立即生效，一般在 24 小時內生效)

剛把域名連接到主機時破不急到要進去看看有沒有成功，結果怎麼重整都沒有我的網站內容，簡直要哭了，還好只是 DNS 還沒生效而已 XDD
因為看了學長姐的筆記，感覺順順的部署完了，不知道有沒有我沒注意到的錯誤啊，總覺得很沒踏實感哈哈哈，但實際操作後對於部署的恐懼感覺少一點了(到底在怕蝦子小)。