1. 定義 i 
2. 賦值 i = 0
3. console.log('i: ' + 0) 印出 i: 0
4. 啟動計時器，進入 webapis 開始倒數 0 * 1000 豪秒，程式碼繼續執行
    倒數完 console.log(0) 會進入 tack queue，等待 Stack 變成清空狀態
5. i++ 後 i 變成 1 ，符合條件小於 5，繼續執行
6. console.log('i: ' + 1) 印出 i: 1
7. 啟動計時器->倒數 1 秒-> console.log(1) 進入 tack queue 排隊
8. i++ 後 i 變成 2 ，符合條件小於 5，繼續執行
9. console.log('i: ' + 2) 印出 i: 2
10. 啟動計時器->倒數 2 秒-> console.log(2) 進入 tack queue 排隊
11. i++ 後 i 變成 3 ，符合條件小於 5，繼續執行
12. console.log('i: ' + 3) 印出 i: 3
13. 啟動計時器->倒數 3 秒-> console.log(3) 進入 tack queue 排隊
14. i++ 後 i 變成 4 ，符合條件小於 5，繼續執行
15. console.log('i: ' + 4) 印出 i: 4
16. 啟動計時器->倒數 4 秒-> console.log(4) 進入 tack queue 排隊
17. i++ 後 i 變成 5 ，不符合條件小於 5，跳出迴圈結束執行
18. Event Loop 發現 Stack 空了，把 callback function 丟進 Stack 執行，依序執行->清空->確認清空->再執行下一個 cb，直到 4 個 cb 都執行完畢。

輸出
```
i: 0
i: 1
i: 2
i: 3
i: 4
0
1
2
3
4
```