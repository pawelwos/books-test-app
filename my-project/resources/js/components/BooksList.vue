<template lang="">
    <div>
        <BookForm @saved="load(currentUrl)" :book='selected' />

        <p v-if="loading">Loading data...</p>
        <div v-else class="overflow-x-auto">
            <div class="text-sm text-center py-2">Total Books: {{ total }}</div>
            <table class="table w-full text-center">
                <!-- head -->
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Genre</th>
                    <th>Publication year</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- rows -->
                <tr v-for="book in books">
                    <td>{{ book.title }}</td>
                    <td>{{ book.author }}</td>
                    <td>{{book.genre}}</td>
                    <td>{{new Date(book.publication_year).getFullYear()}}</td>
                    <td class="space-x-2"><button @click="edit(book)" class="btn">Edit</button> <button class="btn btn-warning" @click="del(book.id)">Delete</button></td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center space-x-4 my-8">
                <div v-if="links">
                    <ul class="flex space-x-2 justify-center">
                        <li v-for="link in links">
                            <button @click="load(link.url)" class="btn " :class="{ 'btn-primary': link.active, 'btn-ghost': !link.active }" v-html="link.label"></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import BookForm from './BookForm.vue'
export default {
  components: {
    BookForm
  },
  data() {
    return {
      currentUrl: '/api/books',
      books: null,
      loading: true,
      current: 0,
      total: 0,
      links: null,
      selected: null
    }
  },
  async mounted() {
    this.load(this.currentUrl)
  },
  methods: {
    async load(link) {
        this.currentUrl = link;
        const response = await fetch(this.currentUrl);
        const books = await response.json();
        this.books = books.data;
        this.total = books.meta.total;
        this.links = books.meta.links;
        this.loading = false;
    },
    async del(id) {
        if(confirm("Do you really want to delete?")){
        fetch('/api/books/'+id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id: id})
            })
            .then(res => {
                if(res.ok) {
                    this.load(this.currentUrl)
                }
            })
            .catch(error => {
                console.error('Error: :', error);
            })
        }
    },
    edit(book) {
        this.selected = book
    }
  },
}
</script>
