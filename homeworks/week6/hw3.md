## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- `<strong>` 強調文字，需包覆在 p 元素的內容中 <p>hello <strong> 我是強調文字 </strong></p>
- `<hr>` 分隔線，可以對它調樣式，做出想要的分隔線效果。<hr>

- `<del>` 標示被刪除的文字，針對文字顯示刪除線。
<del>我是被刪掉的文字</del>
## 請問什麼是盒模型（box modal）
從 CSS 角度來看，網頁上的元素都像是一個個被盒子裝起來。
盒子的結構從內到外依序為
- content: 元素本身的內容
- padding: 內邊距
- border: 包覆內容的框線
- margin: 外邊距
### 兩種尺寸模式
在不同的 Box Model 尺寸模式下，一個擁有相同 CSS 樣式設定的元素，會有不同的外觀尺寸
- standard box-model
該模式下， margin、padding 跟 border 是在 width、height 的基礎上，往外擴張，因此元素的實際寬度與高度，會大於 CSS 樣式中設定的 width 跟 height 。
- alternative box-model
該模式下，物件的實際寬度與高度是將 padding 跟 border 納入 CSS 樣式表中的 width 跟 height 一起計算，所以實際寬度與高度會跟 CSS 樣式表中的 width 跟 height 設定一致。
透過 CSS 樣式中設定 `box-sizing: border-box` 即可達到此效果。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
inline (行內元素)
- 元素可在同一行內呈現，圖片或文字均不換行，也不會影響版面配置。
- 不可設定長寬，元素的寬高由內容撐開。

block (區塊元素)
- 元素寬度會撐到最大，占滿整個容器。
- 可以設定長寬，但仍會占滿一整行。

inline-block (行內區塊)
- 以 inline 的方式呈現，但同時擁有 block 的屬性。
- 可以設定元素的寬高
- 可水平排列

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- static: 預設值，不會被特別定位，而是照著瀏覽器預設的配置自動排版，無法使用 top、left、bottom 與 right。
- relative: 初始與 static 一樣，可以設定 top、right、bottom 和 left 屬性，會使其元素「相對地」調整位置，「相對定位」過的元素不會影響到原本其他元素所在的位置。
- absolute: absolute 元素的定位是在它所處上層容器的相對位置，若上層都沒有「可以被定位」的元素(非 static 的元素)的話，就會對 body 來做絕對定位。( absolute 的定位點是網上找第一個 position 不是 static 的元素)
- fixed: 固定定位，即使頁面滾動，也還是會固定在相同位置，可以設定 top、right、bottom 和 left 屬性。固定定位元素不會保留它原本在頁面應有的空間，不會跟其他元素的配置互相干擾。
