// 防止 xss 攻擊所做的字串跳脫處理
export function escape(str) {
  return str.replace(/\&/g, '&amp;') // eslint-disable-line
      .replace(/\</g, '&lt;') // eslint-disable-line
      .replace(/\>/g, '&gt;') // eslint-disable-line
      .replace(/\"/g, '&quot;') // eslint-disable-line
      .replace(/\'/g, '&#x27') // eslint-disable-line
      .replace(/\//g, '&#x2F') // eslint-disable-line
}
// 將留言新增在 $('.comments') 底下
export function appendCommentToDOM(container, comment, isPrepend) {
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
