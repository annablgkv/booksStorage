<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h3>Определим количество книг каждого автора:</h3>
          <div class="col-12">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Число книг</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="res in res1" :key="res.id">
                <td>{{ res.name }}</td>
                <td>{{ res.count }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
      <hr>
      <div class="col-12">
        <h3>Все книги, написанные Чеховым, отсортированные по годам написания:</h3>
        <div class="col-12">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Книга</th>
                <th scope="col">Год написания</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="res in res2" :key="res.id">
                <td>{{ res.name }}</td>
                <td>{{ res.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="col-12">
        <h3>Вывод книг с указанием их авторов и жанров, в которых они написаны:</h3>
        <div class="col-12">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Книга</th>
                <th scope="col">Автор</th>
                <th scope="col">Жанр</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="res in res3" :key="res.id">
                <td>{{ res.book }}</td>
                <td>{{ res.author }}</td>
                <td>{{ res.genre }}</td>
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
      res1: [],
      res2: [],
      res3: []
    }
  },

  created() {
    axios.get('/api/quest1')
      .then(response => { this.res1 = response.data })
      .catch(error => { alert(error) })
    axios.get('/api/quest2')
      .then(response => { this.res2 = response.data })
      .catch(error => { alert(error) })
    axios.get('/api/quest3')
      .then(response => { this.res3 = response.data })
      .catch(error => { alert(error) })
  }
}
</script>