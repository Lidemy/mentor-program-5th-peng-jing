/* eslint-env jquery */
import $ from 'jquery'
import { appendCommentToDOM } from './utils'
import { getCommentsAPI, addCommentAPI } from './api'
import { getformTemplate } from './template'

export default function init(options) {
  let lastId = null
  let doing = false // 防止新增留言重複送出
  const { siteKey } = options
  const { apiURL } = options
  const formClass = `${siteKey}-add_comments_form`
  const commentsClass = `${siteKey}-comments`
  const loadBtnClass = `${siteKey}-load_more`
  const formSelector = `.${formClass}`
  const commentsSelector = `.${commentsClass}`
  const loadBtnSelector = `.${loadBtnClass}`
  const containerElement = $(options.container)
  containerElement.append(getformTemplate(formClass, commentsClass, loadBtnClass))
  const commentDOM = $(commentsSelector)
  // 先載入 5 筆留言
  showComments()
  // 點擊[載入更多]按鈕後再載入 5 筆
  $(loadBtnSelector).click(() => {
      showComments()
  })
  // 新增留言並顯示
  $(formSelector).submit((e) => {
    e.preventDefault()
    const nicknameDOM = $(`${formSelector} input[name=nickname]`)
    const contentDOM = $(`${formSelector} textarea[name=content]`)
    const newComment = {
      site_key: siteKey,
      nickname: nicknameDOM.val(),
      content: contentDOM.val()
    }
    if (doing) {
      alert('留言新增中，請等待')
    } else if (
      (newComment.content === '') || (newComment.nickname === '')
    ) {
        alert('請輸入暱稱或留言')
    } else {
      doing = true
      addCommentAPI(apiURL, newComment, commentDOM, (data) => {
        if (!data.ok) {
          alert(data.message)
          return
        }
        nicknameDOM.val('')
        contentDOM.val('')
        newComment.id = data.id
        appendCommentToDOM(commentDOM, newComment, true)
        doing = false
      })
    }
  })
  // 將留言顯示在 $('.comments') 底下
  function showComments() {
    const commentDOM = $(commentsSelector)
    getCommentsAPI(apiURL, siteKey, lastId, (data) => {
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
        $(loadBtnSelector).remove()
        return
      }
      // 抓取了 6 筆，但只顯示前 5 筆
      for (let i = 0; i < commentsList.length - 1; i++) {
        appendCommentToDOM(commentDOM, commentsList[i])
      }
      lastId = commentsList[commentsList.length - 2].id // 填入倒數第 2 個 id，下次從這個 id 之後開始顯示
    })
  }
}
