<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <router-link class="navbar-brand" to="/">MyBook</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <router-link class="nav-link" to="/author">Авторы</router-link> 
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/genre">Жанры</router-link> 
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/book">Книги</router-link> 
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/quest">Запросы</router-link> 
      </li>
    </ul>
  </div>
</nav>
</template>
