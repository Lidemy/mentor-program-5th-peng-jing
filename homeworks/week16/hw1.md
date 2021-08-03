1. `console.log(1)` 進入 Stack 執行，==印出 1==，執行完從 stack 上移除。
2. 第一個 `setTimeout` 進入 Stack 執行，叫瀏覽器啟動了一個倒數 0 秒的計時器，setTimeout 呼叫執行完畢從 stack 上移除，進入下一段 `console.log(3)` 進入 Stack。
計時器倒數 0 秒後，function call : `() => {console.log(2)}` 進入 task queue (任務佇列)，等待 Stack 清空。
3. console.log(3) 進入 stcak 執行，==印出 3==，執行完從 stack 上移除。
4. 第二個 setTimeout 進入 Stack 執行，叫瀏覽器啟動了一個倒數 0 秒的計時器，setTimeout 呼叫執行完畢從 stack 上移除，進入下一段 `console.log(5)` 進入 Stack
計時器倒數 0 秒後，function call: `() => {console.log(4)}` 進入 task queue，排在 `() => {console.log(2)}` 後面，等待 Stack 清空
5. `console.log(5)` 進入 Stack 執行，==印出 5==，執行完從 stack 上移除。
6. Event Loop 發現 Stack 清空了，將 task queue 中的 `() => {console.log(2)}` 丟進 Stack 執行，呼叫 `console.log(2)`
7. `console.log(2)` 進入 stack 執行，==印出 2==，執行完移除 console.log(2)，移除 cb。
8. Event Loop 發現 Stack 又空了，將 task queue 中的 `() => {console.log(4)}` 丟進 Stack 執行，呼叫 `console.log(4)`。
9. `console.log(4)` 進入 stack 執行，==印出 4==，執行完移除 console.log(4)，移除 cb，結束整個執行。

輸出
```
1
3
5
2
4
```