<template>
  <div class="container-fluid block-top">
    <div class="row">
      <div class="col-12">
        <h3>Новый автор:</h3>
        <label>
          ФИО:<br>
          <input type="text" class="form-control" v-model="form.name" placeholder="Фамилия Имя Отчество">
        </label>
        <label>
          Дата рождения:<br>
          <input type="text" class="form-control" v-model="form.birth" placeholder="yyyy-mm-dd">
        </label>
        <label>
          Дата смерти:<br>
          <input type="text" class="form-control" v-model="form.death" placeholder="yyyy-mm-dd">
        </label>
        <button type="button" class="btn btn-success" @click="push">Добавить</button>
      </div>
      <div class="col-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">ФИО</th>
              <th scope="col">Дата рождения</th>
              <th scope="col">Дата смерти</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="author in authors" :key="author.id">
              <th scope="row">{{ author.id }}</th>
              <td>{{ author.name }}</td>
              <td>{{ author.birth }}</td>
              <td>{{ author.death }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-12">
        <h3>Новый жанр:</h3>  
      </div>
      <div class="col-12">
        <label>
          Название жанра:<br>
          <input type="text" class="form-control" v-model="form2.name" placeholder="Жанр">
        </label>
        <button type="button" class="btn btn-success" @click="push2">Добавить</button>
      </div>
      <div class="col-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Жанр</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="genr in genre" :key="genr.id">
              <th scope="row">{{ genr.id }}</th>
              <td>{{ genr.name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <hr>
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
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in books" :key="book.id">
              <th scope="row">{{ book.id }}</th>
              <td>{{ book.id_author }}</td>
              <td>{{ book.id_genre }}</td>
              <td>{{ book.name }}</td>
              <td>{{ book.description }}</td>
              <td>{{ book.created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: { // author
        name: '',
        birth: '',
        death: ''
      },
      form2: { // genre
        name: ''
      },
      form3: { // books
        name: '',
        author: '',
        genre: '',
        desc: '',
        date: ''
      },
      authors: [],
      genre: [],
      books: []
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

    push() {
      axios.post('/api/createAuthor', this.form)
      .then(response => { 
        this.refresh()
        this.form.name = ''
        this.form.birth = ''
        this.form.death = ''
       })
      .catch(error => { alert(error) })
    },

    push2() {
      axios.post('/api/createGenre', this.form2)
      .then(response => { 
        this.refresh()
        this.form2.name = ''
       })
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
    }
  }
}
</script>
