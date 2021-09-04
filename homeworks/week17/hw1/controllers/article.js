const db = require('../models')
const Article = db.article

const articleController = {
  getlimit5: (req, res, next) => {
    Article.findAll({
      limit: 5,
      order: [
        ['id', 'DESC']
      ]
    }).then(articles => {
      res.render('index', {
        articles
      })
      
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  get: (req, res, next) => {
    const {id} = req.params
    if (!id) return next()
    Article.findOne({
      where: {
        id
      }
    }).then(article => {
      if (!article) {
        req.flash('errorMessage', '文章找不到或已被刪除')
        return next()
      }
      res.render('article', {
        article,
        url: req.headers.referer
      })
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  getAll: (req, res, next) => {
    Article.findAll({
      order: [
        ['id', 'DESC']
      ]
    }).then(articles => {
      res.render('all',{
        articles
      })
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  manage: (req, res, next) => {
    const {username} = req.session
    if (!username) {
      req.flash('errorMessage', '你沒有權限')
      return next()
    }
    Article.findAll({
      order: [
        ['id', 'DESC']
      ]
    }).then(articles => {
      res.render('manage', {
        articles
      })
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  create: (req, res, next) => {
    const {username} = req.session
    if (!username) {
      req.flash('errorMessage', '你沒有權限')
      return next()
    }
    res.render('create')
  },
  handleCreate: (req, res, next) => {
    const {title, content} = req.body
    if (!title || !content) {
      req.flash('errorMessage', '資料填寫不完整')
      return next()
    }
    Article.create({
      title,
      content 
    }).then(() => {
      res.redirect('/manage')
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  update: (req, res,  next) => {
    const {username} = req.session
    if (!username) {
      req.flash('errorMessage', '你沒有權限')
      return next()
    }
    const id = req.params.id
    if (!id) {
      return next()
    }
    Article.findOne({
      where: {
        id
      }
    }).then(article => {
      res.render('update', {
        article
      })
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  handleUpdate: (req, res, next) => {
    const {id} = req.params
    const {title, content} = req.body
    if (!title || !content || !id) {
      req.flash('errorMessage', '資料填寫不完整')
      return next()
    }
    Article.update({
      title,
      content
    },{
      where: {
        id
      }
    }).then(() => {
      res.redirect('/manage')
    }).catch(err => {
      req.flash('errorMessage', err.toString())
      return next()
    })
  },
  handleDelete: (req, res, next) => {
    const {username} = req.session
    if (!username) {
      req.flash('errorMessage', '你沒有權限')
      return next()
    }
    const {id} = req.params
    if (!id) {
      return next()
    }
    Article.update({
      is_delete: 1
    },{
      where: {
        id
      }
    }).then(() => {
      res.redirect('/manage')
    }).catch(err => {
      res.flash('errorMessage', err.toString())
      return next()
    })
  }
}
module.exports = articleController

