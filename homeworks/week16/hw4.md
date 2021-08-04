this 的值跟怎麼定義無關，跟怎麼被呼叫有關
1. obj.inner.hello() 等同於 obj.inner.hello.call(obj.inner)，第一個參數就是 this 的值，所以 this = obj.inner
2. obj2.hello() 等同於 obj2.hello.call(obj2)，所以 this = obj2
3. hello() 等於 hello.call()，因為前面沒有加東西，參數為 undefined =>hello.call(undefined)，所以 this = undefined
輸出
```
obj.inner
obj2
undefined
```