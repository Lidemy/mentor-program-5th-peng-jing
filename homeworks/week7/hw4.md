## 什麼是 DOM？
連結 HTML 跟 JavaScript 的橋樑，透過 DOM API ，JavaScript 可以存取操縱 HTML 的節點，來動態改變畫面。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
事件傳遞分為三階段
- 捕獲階段 ( Capture Phase ) : 由根結點開始往下傳遞到 Target
- 目標階段 ( Target Phase ) : 點擊到的元素
- 冒泡階段 ( Bubbling Phase ) : 從點擊到的元素開始一路逆向傳回去根節點

先捕獲再冒泡，在 addEventListener 中可設定第三個參數
- true : 將監聽事件加在捕獲階段
- false : 將監聽事件加在冒泡階段

## 什麼是 event delegation，為什麼我們需要它？
事件代理機制，將事件監聽新增在父元素，而不是直接加在子元素上，當子元素觸發時，事件會冒泡到父元素，就會觸發監聽事件。
不用每個子元素都分別加上事件監聽，讓程式更有效率，統一交由父元素來監聽，動態新增的子元素也能使用。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
- event.preventDefault() : 阻止瀏覽器的預設行為，如跳轉頁面、 form 的提交。
- event.stopPropagation() : 阻止事件的傳遞，根據放的位置，事件將斷在這邊不會繼續往下傳遞，若是放在 window 捕獲階段，那不管頁面加了多少事件監聽都不會被觸發，因為事件一開始就被阻止了。