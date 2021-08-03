1. global 定義 
    ```
    global EC: {
        VO: {
            function fn() => fn: function
            var a => a: undefined
        },
        scopeChain: [globalEC.VO]
    }
    隱藏屬性: fn.[[Scope]] = global.scopeChain // 等於 [globalEC.VO]
    ```

2. global 賦值 & 執行
    - a = 1 => 賦值 a: 1
    - fn() => 呼叫函式 fu()，進入 fn() 的 execution context
    此時
    ```
    global VO: {
        fn: function
        a: 1
    }
    ```
3. fn() 定義
```
fnEC: {
    AO: {
        function fn2() => fn2: function
        var a => a: undefined
    },
    scopeChain: [fn.AO, fn.[[Scope]]] // 等於 [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = fnEC.scopeChain // 等於 [fnEC.AO, globalEC.VO]
```
4. fn() 賦值 & 執行
    - console.log(a) => 找到 fn vo 中的 a 值，==印出 undefined==
    - a = 5 => 賦值 fn vo 中的 a: 5
    - console.log(a) => 這時 fn vo 裡面的 a 值被更新為 5，所以==印出 5==
    - a++ => fn vo 中的 a 值 +1 變成 6
    - var a => 已經在 fn 裡面定義過了所以忽略
    - fn2() => 呼叫函式 fn2，進入 fn2() 的 execution context
    此時
    fn AO: {
        &nbsp;&nbsp; fn2: function
        &nbsp;&nbsp; a: 6
    }
5. fn2() 定義
    ```
    fn2EC: {
        AO: {},
        scopeChain: [fn2AO, fn2[[Scope]]] // 等於 [fn2AO, fnEC.scopeChain] = [fn2AO, fnEC.AO, globalEC.VO]
    }
    ```
6. fn2() 執行
    - console.log(a) => 在 fn2() 裡面沒有定義 a ，所以找 fn2 的上層 fn vo，找到 a = 6，==印出6==
    - a = 20 => fn2() 中沒有定義 a ，往上層找到 fn() 的 a，賦值 a = 20
    - b = 100 => fn2() 沒有定義 b，往上層到 fn() 也沒有定義，再往上到 global 發現也沒有定義，所以就在 global 定義了一個 b 並賦值 100
    此時
    fn AO {
        &nbsp;&nbsp; fn2: function
        &nbsp;&nbsp; a: 20
    }
    global VO {
        &nbsp;&nbsp; fn2: function
        &nbsp;&nbsp; a: 1
        &nbsp;&nbsp; b: 100
    }
    - fn2() 執行完畢，移除 fn2() 的 execution context，回到上一層繼續執行
7. fn() 繼續執行
   - console.log(a) => 找到 fn vo 的 a 值為 20，==印出 20==
   - fn() 執行完畢，移除 fn() 的 execution context，回到上一層繼續執行
8. global 繼續執行
    - console.log(a) => 找到 global vo 中 a 值為 1，==印出 1==
    - a = 10 => 將 global vo 中 a 值更新為 10
    - console.log(a) => 找到 global vo 中 a 值為 10，==印出 10==
    - console.log(b) => 找到 global vo 中 b 值為 100，==印出 100==

輸出
```
undefined
5
6
20
1
10
100
```