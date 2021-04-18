## 教你朋友 CLI
### 什麼是 CLI ?
一般電腦上所看見的畫面為圖形使用者介面( GUI )，就是採用圖形的方式顯示使用者介面，使用上會比較直覺。而CLI僅透過純文字輸入指令來跟電腦溝通。

### 建立環境
在使用前須先設定好輸入指定的環境
- Windows
安裝[載點](https://git-scm.com/download/win)
下載後一直下一步即可
- Mac
直接開啟 terminal 即可

### 開啟
安裝好後開啟 Git Bash ( Mac 開啟 terminal )會進入這樣的畫面

![命令提示字元](https://github.com/peng-jing/test/blob/main/2.JPG?raw=true)

### 最基本的四個指令

- 顯示目前位置: **pwd** (**P**rint **W**orking **D**irectory)

- 印出在資料夾底下的檔案: **ls** (**l**i**s**t)
    - 印出資料夾的詳細資料，透過「-」加參數: **ls -al**(-al可印出更詳細資料)

- 移動位置: **cd** (**C**hange **D**irectory)
    - cd 加一個空白鍵後，再按下tab鍵會列出當前目錄的清單
    - - 移動到上一層: **cd .\.**
    - 移動到根目錄: **cd ~**
    - 移動到指定資料夾: **cd <<資料夾名稱>>**

- 使用說明書: **man** 

## h0w 哥想要的功能
### 建立資料夾
mkdir（**m**a**k**e **dir**ectory，建立目錄)
可透過 makdir 來建立資料夾
```git
makdir wifi //建立名為 wifi 的資料夾
```
### 在資料夾裡面建立檔案
要在 wifi 資料夾裡面建立檔案的話，需先將當前位置移動到 wifi 資料夾裡面
```git
cd wifi
```
移動到資料夾裡之後，要透過指令 touch 來建立檔案
- **touch** : 用於建立檔案or更改檔案時間(輕輕碰一下檔案) 
```git
touch afu.js
```
這樣就達成 h0w 哥想要的需求了。