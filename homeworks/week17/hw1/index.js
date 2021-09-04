const express = require('express')
const app = express()
const session = require('express-session')
const flash = require('connect-flash');
const port = process.env.PORT || 5001

const articleController = require('./controllers/article')
const userController = require('./controllers/user')

app.set('view engine', 'ejs')
app.use(flash());
app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  cookie: { secure: false } // 在 http 環境也能記錄
}))
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use("/style", express.static(__dirname + "/views/style"));
app.use((req, res, next) => {
  res.locals.username = req.session.username
  res.locals.errorMessage = req.flash('errorMessage')
  next()
})

function redirtctBack(req, res, next) {
  res.redirect('back')
  next()
}
app.get('/', articleController.getlimit5, redirtctBack)
app.get('/article/:id', articleController.get, redirtctBack)
app.get('/all', articleController.getAll, redirtctBack)
app.get('/manage', articleController.manage, redirtctBack)
app.get('/create', articleController.create, redirtctBack)
app.post('/create', articleController.handleCreate, redirtctBack)
app.get('/update/:id', articleController.update, redirtctBack)
app.post('/update/:id', articleController.handleUpdate, redirtctBack)
app.get('/delete/:id', articleController.handleDelete, redirtctBack)

app.get('/login', userController.login)
app.post('/login', userController.handleLogin, redirtctBack)
app.get('/logout', userController.handleLogout, redirtctBack)


app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})