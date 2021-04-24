## 跟你朋友介紹 Git
### 什麼是 Git?
能做版本控制的程式，每一階段的更新，可產生一個版本紀錄異動的內容，隨時能輕鬆回舊版本查看編輯。

### 如何安裝 Git
[官網下載](https://git-scm.com/)
右邊 Downloads 點下去，一直下一步即可。

### 登入使用者
>如果已經有 GitHub 帳戶的話可以設定與帳戶相同的 name 及 mail
```bash
git config --global user.name "your name"
git config --global user.email "your email"
```
### 開始設定版本控制
#### **STEP1** 新增一個要拿來裝笑話的資料夾
先新增一個 joke 資料夾，並移動到資料夾位置
```bash
mkdir joke #建立名為joke的資料夾
cd joke #位置移動到資料夾裡
```

#### **STEP2** 將資料夾初始化
讓 git 開始對資料夾進行版本控制
```bash
git init #將產生一個隱藏檔案 .git
```
可透過指令 **ls -al** 確認是否有產生 .git 資料夾
.git 裡面會包含系統檔

- 如何停止版本控制?
刪除.git資料夾
```bash
rm -r .git
```
它會詢問是否確定刪除，輸入 Y 即可完成刪除。

#### **STEP3** 時常檢查狀態
可以知道有哪些資料沒有被加入版本控制。
```bash
git status
```
#### **STEP4** 新增笑話檔案
方法1.可以直接在資料夾裡按右鍵新增檔案
方法2.使用 Command Line 指令建立檔案
```bash
touch test.js
touch note.txt
```
此時檔案尚未加入版本控制
#### **STEP5** 決定哪些檔案要加入版本控制
```bash
git add test.js #指定將test.js加入版本控制中
```
- 如果資料夾內全部檔案均要版控，可以使用 `git add .` ，就能把當前路徑的檔案全部加入版控。
- 若要取消加入版控，可使用 `git rm --cached 檔案名稱` 
- 排除檔案: 若有確定不想加入版控的檔案，可使用.gitignore忽略該檔案，這樣就不需要每一次commit前特別挑出來。
```bash
touch .gitignore #新增一個 .gitignore 檔
vim .gitignore #進入 vim 模式後將排除檔案輸入再離開即可
```
#### **STEP6** 新建一個版本
```bash
git commit
```
將進入vim模式，輸入版本名稱後儲存離開即可
- 變化型
```bash
git commit -m "版本名稱" #不會進入vim模式，可直接命名
git commit -am "版本名稱" #結合add跟版本命名，可省略 git add 步驟 (若有新檔案未曾被加入的話人需要git add這個步驟!))
```
每次笑話有新版本時就要commit一次

### 若要檢視有哪些笑話版本，可使用 log 檢視 Commit 紀錄
越新的版本會在越上面
```bash
git log
```
- 變化型
```bash
git log oneline #輸出簡潔的版本紀錄
```
### 在各笑話版本 / 分支中切換
透過輸入版本編號或分支名稱，就能切換到任何commit過的版本
```bash
git checkout 版本編號 #切換commit過的版本
git checkout 分支名稱 #切換branch新增的分支
git checkout master #切換到最新版本
```
### Branch 分支
#### 為什麼需要 Branch
可以平行修改互不影響，多人協作時不用擔心互相影響。
ex 如果有人要跟你一起同時想笑話的話，為了避免檔案互相覆蓋，可以建立新的分支，等大家都修改好後再合併在一起。

![流程](https://github.com/peng-jing/test/blob/main/3.JPG?raw=true)

### 與遠端協作
#### 如何將檔案上傳到 GitHub
##### **STEP1** 在 GitHub 上建立 new repositories
在 GitHub 頁面右上角按下 「+」，點選 new repositories ，為 Repository name 命名， 按下 Create  repositories 。
##### **STEP2** 
根據 GitHub 提供的指令，在本地端輸入指令後，就能將本地端的資料庫的檔案上傳到 GitHub 遠端的資料庫。
```bash
git remote add origin https://github.com/peng-jing/test2.git
git branch -M main #可自己決定名稱
git push -u origin main
```
#### 如何上傳更新的檔案 ( push )
若本地端有新的 commit ，可透過指令 push 來上傳最新版本，若是有新分支也可用此指令上傳。
```bash
git push origin main 
git push origin << brance name >>

```

#### 如何下載更新的檔案 ( pull )
若在 GitHub 上更新了檔案想要讓本地端同步更新，可使用指令 pull
```bash
git pull origin main
git pull origin << brance name >>
```

