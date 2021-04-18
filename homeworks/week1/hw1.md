## 交作業流程

### **STEP1** 設定 GitHub repo
透過 GitHub classroom 連結產生一個新的 repositories

### **STEP2** 複製連結
![在這邊複製連結](https://github.com/peng-jing/test/blob/main/1.JPG?raw=true)

### **STEP3** 下載到本地端
``` git
git clone <<連結>>
```

### **STEP4** 新增一個分支(重要!)
```git
git branch week1 //建立了名為week1的分支
git checkout week1 //切換到week1分支
```

### **STEP5** 寫作業
切換到分支後開始寫作業，完成後新增一個版本
```git
git commit -am "版本名稱"
```

### **STEP6** 上傳到 GitHub
```git
git push origin <<分支名稱>>
```

### **STEP7** Pull requests
確定上傳完成後，在 GitHub 中切換到 Pull requests 畫面，或是點擊 Compare & Pull request，打好標題跟內容後，按下 Create Pull request 。

### **STEP8** 提交作業網址
畫面跳轉後，複製頁面網址，到[這裡](https://learning.lidemy.com/course)按下繳交作業，貼上複製連結後送出，就完成交作業流程。

### 作業改完並 merge 後
1. 在本地端切換到 master : git checkout master
2. 將最新版本 pull 下來 : git pull origin master
3. 將分支 week1 刪除 : git branch -d week1