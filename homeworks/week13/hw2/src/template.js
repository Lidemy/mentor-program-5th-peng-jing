export function getformTemplate(formClass, commentsClass, loadBtnClass) {
  return `
    <form class="${formClass}">
      <div class="mb-3">
        <label for="nickname" class="form-label">暱稱</label>
        <input type="text" class="form-control" id="nickname" name="nickname">
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">留言內容</label>
        <textarea name="content" class="form-control" id="comment" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="${commentsClass} mt-4 mb-2">
    </div>
    <button class="btn btn-primary ${loadBtnClass} mt-4 mb-4" type="submit">載入更多</button>
  `
}
