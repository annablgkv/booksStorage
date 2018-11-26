<template>
  <div class="container-fluid">
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
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="author in authors" :key="author.id">
              <th scope="row">{{ author.id }}</th>
              <td>{{ author.name }}</td>
              <td>{{ author.birth }}</td>
              <td>{{ author.death }}</td>
              <td>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal" @click="focus(author.id)">create</i>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal2" @click="focusDel(author.id)">delete</i>
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
            <label>
              ФИО:<br>
              <input type="text" class="form-control" v-model="formEdit.name" placeholder="Фамилия Имя Отчество">
            </label>
            <label>
              Дата рождения:<br>
              <input type="text" class="form-control" v-model="formEdit.birth" placeholder="yyyy-mm-dd">
            </label>
            <label>
              Дата смерти:<br>
              <input type="text" class="form-control" v-model="formEdit.death" placeholder="yyyy-mm-dd">
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
            Вы действительно хотите удалить "<i>{{ delAuthor.name }} ({{ delAuthor.birth }} / {{ delAuthor.death }})</i>"?
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
      form: { // author
        name: '',
        birth: '',
        death: ''
      },
      formEdit: {},
      delAuthor: {},
      authors: [],
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

    focus(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneAuthor', form)
      .then(response => { 
        this.formEdit = response.data
       })
      .catch(error => { alert(error) })
    },

    pushEdit() {
      axios.post('/api/updateAuthor', this.formEdit)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    },

    focusDel(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneAuthor', form)
      .then(response => { 
        this.delAuthor = response.data
       })
      .catch(error => { alert(error) })
    },

    deleteA(){
      axios.post('/api/deleteAuthor', this.delAuthor)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    }
  }
}
</script>