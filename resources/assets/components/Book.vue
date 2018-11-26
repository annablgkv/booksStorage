<template>
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
        <h3>Новая книга:</h3>
      </div>
      <div class="col-12">
        <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Название книги</span>
          </div>
          <input type="text" class="form-control" v-model="form3.name">
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <label class="input-group-text">Автор</label>
          </div>
          <select class="custom-select" v-model="form3.author">
            <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
          </select>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <label class="input-group-text">Жанр</label>
          </div>
          <select class="custom-select" v-model="form3.genre">
            <option v-for="genr in genre" :key="genr.id" :value="genr.id">{{ genr.name }}</option>
          </select>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Описание</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" v-model="form3.desc"></textarea>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Год выпуска</span>
          </div>
          <input type="text" class="form-control" v-model="form3.date">
        </label>
        <button type="button" class="btn btn-success" @click="push3">Добавить</button>
      </div>
      <div class="col-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">id автора</th>
              <th scope="col">id жанра</th>
              <th scope="col">Название</th>
              <th scope="col">Описание</th>
              <th scope="col">Год Выпуска</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in books" :key="book.num">
              <th scope="row">{{ book.id }}</th>
              <td>{{ book.id_author }}</td>
              <td>{{ book.id_genre }}</td>
              <td>{{ book.name }}</td>
              <td>{{ book.description }}</td>
              <td>{{ book.created_at }}</td>
              <td>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal" @click="focus(book.id)">create</i>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal2" @click="focusDel(book.id)">delete</i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Название книги</span>
          </div>
          <input type="text" class="form-control" v-model="formEdit.name">
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <label class="input-group-text">Автор</label>
          </div>
          <select class="custom-select" v-model="formEdit.id_author">
            <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
          </select>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <label class="input-group-text">Жанр</label>
          </div>
          <select class="custom-select" v-model="formEdit.id_genre">
            <option v-for="genr in genre" :key="genr.id" :value="genr.id">{{ genr.name }}</option>
          </select>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Описание</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" v-model="formEdit.description"></textarea>
        </label>
        <label class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Год выпуска</span>
          </div>
          <input type="text" class="form-control" v-model="formEdit.created_at">
        </label>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="button" class="btn btn-success" @click="pushEdit">Изменить</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Предупреждение</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <div class="modal-body">
            Вы действительно хотите удалить "<i>{{ delBook.name }}</i>"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="button" class="btn btn-danger" @click="deleteA()">Удалить</button>
          </div>
        </div>
      </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      form3: { // books
        name: '',
        author: '',
        genre: '',
        desc: '',
        date: ''
      },
      formEdit: {},
      delBook: {},
      books: [],
      authors: [],
      genre: []
    }
  },

  created() {
    this.refresh()
  },

  methods: {
    refresh() {
      axios.get('/api/authors')
      .then(response => { this.authors = response.data })
      .catch(error => { alert(error) })
      axios.get('/api/genre')
      .then(response => { this.genre = response.data })
      .catch(error => { alert(error) })
      axios.get('/api/books')
      .then(response => { this.books = response.data })
      .catch(error => { alert(error) })
    },

    push3() {
      axios.post('/api/createBook', this.form3)
      .then(response => { 
        this.refresh()
        this.form3.name = ''
        this.form3.author = ''
        this.form3.genre = ''
        this.form3.desc = ''
        this.form3.date = ''
       })
      .catch(error => { alert(error) })
    },

    focus(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneBook', form)
      .then(response => { 
        this.formEdit = response.data
       })
      .catch(error => { alert(error) })
    },

    pushEdit() {
      axios.post('/api/updateBook', this.formEdit)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    },

    focusDel(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneBook', form)
      .then(response => { 
        this.delBook = response.data
       })
      .catch(error => { alert(error) })
    },

    deleteA(){
      axios.post('/api/deleteBook', this.delBook)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    }
  }
}
</script>
