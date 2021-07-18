/* eslint-env jquery */
function escape(str) {
  return str.replace(/\&/g, '&amp;') // eslint-disable-line
    .replace(/\</g, '&lt;') // eslint-disable-line
    .replace(/\>/g, '&gt;') // eslint-disable-line
    .replace(/\"/g, '&quot;') // eslint-disable-line
    .replace(/\'/g, '&#x27') // eslint-disable-line
    .replace(/\//g, '&#x2F') // eslint-disable-line
}

$(document).ready(() => {
  let id = 1
  const card = `<div class="card flex-row align-items-center px-4">
      <input class="form-check-input" type="checkbox" name="card_check" id="todo-{id}">
      <label class="card-body" for="todo-{id}">{content}</label>
      <div class="card_edit">
        <i class="p-2 far fa-edit btn_edit" role="button"></i>
        <i class="p-2 fas fa-trash-alt btn_delete" role="button"></i>
      </div>
    </div>`
  hasCard()
  // 新增待辦事項
  $('.add_todo_form').submit((e) => {
    e.preventDefault()
    const value = $('.add_todo_form input').val()
    if (!value) {
      alert('請輸入待辦事項')
      return
    }
    $('.cards').append(
      card
        .replace('{content}', escape(value))
        .replaceAll('{id}', id)
    )
    id++
    $('.add_todo_form input').val('')
    hasCard()
    unchecked()
  })
  // cards 事件代理
  $('.cards').on('click', (e) => {
    // 編輯功能
    if ($(e.target).hasClass('btn_edit')) {
      const cardEdit = $(e.target).parent($('.card_edit'))
      const cardBody = $(e.target).parent().siblings('.card-body')
      cardEdit.children().hide()
      cardEdit.append('<button type="button" class="btn btn-secondary edit_store">儲存</button>')
      cardBody.html(`<input type='text' value='${cardBody.text()}' name='edit_input' class='w-100'></input>`)
      // 按下儲存鈕後
      $('.edit_store').click(() => {
        const editInput = $('input[name="edit_input"]').val()
        // 如果沒填寫代辦事項
        if (!$('input[name="edit_input"]').val()) {
          alert('請輸入代辦事項')
          return
        }
        $('.edit_store').remove()
        cardBody.text(editInput)
        cardEdit.children().show()
      })
    }
    // 刪除功能
    if ($(e.target).hasClass('btn_delete')) {
      $(e.target).parent().parent().remove()
      hasCard()
      unchecked()
    }
    // 狀態已完成 checked
    if ($(e.target).prop('checked')) {
      $(e.target).siblings('.card-body').addClass('text-decoration-line-through fw-light fst-italic')
      unchecked()
    } else if (!$(e.target).prop('checked')) {
      $(e.target).siblings('.card-body').removeClass('text-decoration-line-through fw-light fst-italic')
      unchecked()
    }
  })
  // 全選 all checked
  $('#checkall').click(() => {
   if ($('#checkall').prop('checked')) {
    $('input[name="card_check"]').each(function() {
      $(this).prop('checked', true)
      $('.cards .card-body').addClass('text-decoration-line-through fw-light fst-italic')
    })
    unchecked()
   } else {
    $("input[name='card_check']").each(function() {
      $(this).prop('checked', false)
      $('.cards .card-body').removeClass('text-decoration-line-through fw-light fst-italic')
    })
    unchecked()
   }
  })
  // 篩選勾選狀態
  $('.form-select').change(() => {
    const selectVal = $('.form-select').val()
    switch (selectVal) {
      case 'all' :
        $('.cards .card').slideDown()
        break
      case 'checked' :
        $('.cards .card').each(function() {
          if ($(this).children('input[name="card_check"]').prop('checked')) {
            $(this).slideDown()
          } else {
            $(this).slideUp()
          }
        })
        break
      case 'unchecked' :
        $('.cards .card').each(function() {
          if (!$(this).children('input[name="card_check"]').prop('checked')) {
            $(this).slideDown()
          } else {
            $(this).slideUp()
          }
        })
        break
    }
  })
  $('.clear_btn').click(() => {
    $('.cards .card').each(function() {
      if ($(this).children('input[name="card_check"]').prop('checked')) {
        $(this).remove()
      }
    })
    hasCard()
  })
})
// 確認是否有代辦事項
function hasCard() {
  if ($('.cards').children().length > 0) {
    $('.cards_info').show().addClass('d-flex')
  } else {
    $('.cards_info').hide().removeClass('d-flex')
  }
}
// 確認未完成數量
function unchecked() {
  let unchecked = 0
  $('.cards .card').each(function() {
    if (!$(this).children('input[name="card_check"]').prop('checked')) {
      unchecked++
    }
    $('.unchecked_num').text(unchecked)
  })
}
