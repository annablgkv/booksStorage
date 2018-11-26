<template>
  <div class="container-fluid">
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
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="genr in genre" :key="genr.id">
              <th scope="row">{{ genr.id }}</th>
              <td>{{ genr.name }}</td>
              <td>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal" @click="focus(genr.id)">create</i>
                <i class="material-icons" data-toggle="modal" data-target="#exampleModal2" @click="focusDel(genr.id)">delete</i>
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
              Название жанра:<br>
              <input type="text" class="form-control" v-model="formEdit.name" placeholder="Жанр">
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
            Вы действительно хотите удалить "<i>{{ delGenre.name }}</i>"?
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
      form2: { // genre
        name: ''
      },
      formEdit: {},
      delGenre: {},
      genre: [],
    }
  },

  created() {
    this.refresh()
  },

  methods: {
    refresh() {
      axios.get('/api/genre')
      .then(response => {
        const temp = response.data
        this.genre = temp.sort(function (a, b) {
          if (a.id > b.id) {
            return 1
          }
          if (a.id < b.id) {
            return -1
          }
          // a должно быть равным b
          return 0
        })
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

     focus(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneGenre', form)
      .then(response => { 
        this.formEdit = response.data
       })
      .catch(error => { alert(error) })
    },

    pushEdit() {
      axios.post('/api/updateGenre', this.formEdit)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    },

    focusDel(id) {
      var form = {}
      form.id = id
      axios.post('/api/getOneGenre', form)
      .then(response => { 
        this.delGenre = response.data
       })
      .catch(error => { alert(error) })
    },

    deleteA(){
      axios.post('/api/deleteGenre', this.delGenre)
      .then(response => { 
        this.refresh()
       })
      .catch(error => { alert(error) })
    }

  }
}
</script>