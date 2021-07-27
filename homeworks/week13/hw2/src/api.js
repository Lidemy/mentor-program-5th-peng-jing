import $ from 'jquery'
// 透過 api_comments.php 拿留言
export function getCommentsAPI(apiURL, siteKey, before, cb) {
  let url = `${apiURL}api_comments.php?site_key=${siteKey}`
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
// 透過 api_add_comment.php 新增留言
export function addCommentAPI(urlAPI, newComment, commentDOM, cb) {
  $.ajax({
    type: 'POST',
    url: `${urlAPI}api_add_comment.php`,
    data: newComment,
    success: (data) => {
      cb(data)
    },
    err: (err) => { alert(`err${err}`) }
  })
}
