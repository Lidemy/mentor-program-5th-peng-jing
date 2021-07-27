## Webpack 是做什麼用的？可以不用它嗎？
- 瀏覽器不支援的語法，經過 Webpack 轉譯打包成一個 main.js 後就能直接在瀏覽器上運行。
使用 webpack 後，任何資源都能被視為模組來使用，連 npm 安裝的模組都能一起打包，不須多做設定。

- 原始碼不經處理，瀏覽器無法執行，所以需要經過 webpack 打包處理後才能讓瀏覽器執行。
    - 不使用 webpack 的情況
        1. 不支援 CommonJS 模組，無法使用 module.exports 與 require，所有東西就都要寫在一起，難以管理。
        2. 若使用 ES6 的 import 與 export，雖然大多瀏覽器都支援，但 IE 不支援，也無法直接引入 npm 套件( 不可能上傳全部安裝的模組、import 路徑不好維護)。

## gulp 跟 webpack 有什麼不一樣？
- gulp: 負責管理任務。
自訂要執行的 task ，依需求安排檔案要執行哪些任務，用程式化的方式來管理任務，是個管理任務的工具。
- webpack: 把模組打包。
將 JS、CSS、圖片等各種資源視為模組，將這些模組打包在一起讓瀏覽器執行。
若是檔案有瀏覽器不支援的東西，可先透過 loader 將檔案經過轉換後，再打包在一起。

## CSS Selector 權重的計算方式為何？
ID > Class/pseudo-classes(偽類別)/attribute(屬性選擇器) > Element/pseudo-elements(偽元素) > *
- Element: 0-0-1
- Class/attribute: 0-1-0
- ID: 1-0-0
ex:
```css=
body div ul li a span  /* 6 個 element=> 0-0-6 */

li.myclass /* 1個 element， 1個 class => 0-1-1 */

h1 + input[name=nickname]  /* 2 個 element, 1個 attribute => 0-1-2 */

#s12:not(FOO) /* 1 個 ID，1 個偽元素，所以是 1-0-1 */
```

!important & inline style
- inline style: 會永遠覆寫 stylesheets 當中的樣式
- !important: 可以蓋過所有的權重
