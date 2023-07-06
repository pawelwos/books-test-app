<template>
    <div class="card mb-20 shadow-xl p-4">
        <h2 class="pb-4 text-lg md:text-xl" v-text="edit ? 'Edit Book' : 'Create Book'"></h2>
        <form class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 " @submit.prevent="handleSubmit">
          <p><label>
            Book Title:<br />
            <input class="input input-bordered w-full max-w-xs" type="text" v-model="formData.title" required />
          </label></p>
          <p><label>
            Author Name:<br />
            <input class="input input-bordered w-full max-w-xs" type="text" v-model="formData.author" required />
          </label></p>
          <p><label>
            Genre:<br />
            <input class="input input-bordered w-full max-w-xs" type="text" v-model="formData.genre" required />
          </label></p>
          <p><label>
            Publish Year:<br />
            <input class="input input-bordered w-full max-w-xs" type="number" min="1900" max="2099" step="1" v-model="formData.publication_year"  />
          </label></p>
          <p>
            <button type="submit" class="btn" v-text="edit ? 'Edit' : 'Create'"></button>
            <button @click.prevent="cancel()" class="btn btn-ghost" v-if="edit">Cancel</button>
          </p>
          <p v-if="msg">{{ msg }}</p>
        </form>
    </div>
  </template>
<script>
export default {
    props: ['book'],
    data() {
        return {
            msg: null,
            edit: false,
            formData: {
                id: '',
                title: '',
                author: '',
                genre: '',
                publication_year: ''
            }
        }
    },

    methods: {
        handleSubmit() {
            this.add()
        },
        async add() {
            fetch('/api/books/'+(this.edit ? this.book.id : ''), {
                method: this.edit ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.formData)
            })
            .then(res => {
                if(res.ok) {
                    this.msg = this.edit ? 'Book edited' : 'Book added';
                    setTimeout(function(){
                        this.msg = ''
                    }, 3000)
                    this.$emit('saved');
                    this.formData = {
                        id: '',
                        title: '',
                        author: '',
                        genre: '',
                        publication_year: ''
                    };
                }
                else
                this.msg = "Error";
            })
            .catch(error => {
                console.error('Error: :', error);
            })
        },
        cancel() {
            this.edit = false;
            this.formData = {
                id: '',
                title: '',
                author: '',
                genre: '',
                publication_year: ''
            }
        }
    },
    watch: { 
        book: function(newVal) {
            this.edit = true;
            this.formData = {
                id: newVal.id,
                title: newVal.title,
                author: newVal.author,
                genre: newVal.genre,
                publication_year: new Date(newVal.publication_year).getFullYear()
            }
        }
      }
}
</script>

<style lang="postcss">
    p {
        margin: theme('space.4') 0
    }
    input {
        margin: theme('space.4') 0
    }
</style>