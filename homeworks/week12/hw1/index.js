/* eslint-env jquery */
// 防止 xss 攻擊所做的字串跳脫處理
function escape(str) {
  return str.replace(/\&/g, '&amp;') // eslint-disable-line
      .replace(/\</g, '&lt;') // eslint-disable-line
      .replace(/\>/g, '&gt;') // eslint-disable-line
      .replace(/\"/g, '&quot;') // eslint-disable-line
      .replace(/\'/g, '&#x27') // eslint-disable-line
      .replace(/\//g, '&#x2F') // eslint-disable-line
}
// 將留言新增在 $('.comments') 底下
function appendCommentToDOM(container, comment, isPrepend) {
  const html = `
    <div class="card mt-2">
      <div class="card-body">
        ${comment.id}<h5 class="card-title">${escape(comment.nickname)}</h5>
        ${escape(comment.content)}
      </div>
    </div>
  `
  if (isPrepend) {
    container.prepend(html)
    return
  }
  container.append(html)
}
// 全域變數
const siteKey = 'janet'
let lastId = null
let doing = false // 防止新增留言重複送出
// DOM 元素下載完後執行
$(document).ready(() => {
  // 先載入 5 筆留言
  getComments()
  // 點擊[載入更多]按鈕後再載入 5 筆
  $('.load_more').click(() => {
      getComments()
  })
  // 新增留言並顯示
  $('.add_comments_form').submit((e) => {
    e.preventDefault()
    if (doing) {
      alert('留言新增中，請等待')
    } else {
      doing = true
      const newComment = {
        site_key: 'janet',
        nickname: $('input[name=nickname]').val(),
        content: $('textarea[name=content]').val()
      }
      if (
        (newComment.content === '') ||
        (newComment.nickname === '')
      ) {
        alert('Please input comment')
        return
      }
      $.ajax({
        type: 'POST',
        url: 'api_add_comment.php',
        data: newComment,
        success: (data) => {
          if (!data.ok) {
            alert(data.message)
            return
          }
          $('input[name=nickname]').val('')
          $('textarea[name=content]').val('')
          const commentDOM = $('.comments')
          newComment.id = data.id
          appendCommentToDOM(commentDOM, newComment, true)
          doing = false
        },
        err: (err) => { alert(`err${err}`) }
      })
    }
  })
})
// 透過 api_comments.php 拿留言
function getCommentsAPI(siteKey, before, cb) {
  let url = `api_comments.php?site_key=${siteKey}`
  if (before) {
    url += `&before=${before}`
  }
  $.ajax({
    method: 'GET',
    url,
    success: (data) => {
      cb(data)
    },
    error: (err) => {
      console.log(`err${err}`)
    }
  })
}
// 將留言顯示在 $('.comments') 底下
function getComments() {
  getCommentsAPI(siteKey, lastId, (data) => {
    const commentDOM = $('.comments')
    if (!data.ok) {
      alert(data.message)
      return
    }
    const commentsList = data.comments
    // 如果抓到的筆數小於 6 筆，就全部顯示並隱藏[顯示更多]按鈕，return 結束這回合
    if (commentsList.length < 6) {
      for (let i = 0; i < commentsList.length; i++) {
        appendCommentToDOM(commentDOM, commentsList[i])
      }
      $('.load_more').remove()
      return
    }
    // 抓取了 6 筆，但只顯示前 5 筆
    for (let i = 0; i < commentsList.length - 1; i++) {
      appendCommentToDOM(commentDOM, commentsList[i])
    }
    lastId = commentsList[commentsList.length - 2].id // 填入倒數第 2 個 id，下次從這個 id 之後開始顯示
  })
}
