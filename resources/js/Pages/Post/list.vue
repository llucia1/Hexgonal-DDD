<script lang="ts">
import axios from 'axios';
  export default {
    data () {
      return {
        dialog: false,
        posts: [],
        post: {}
      }
    },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      axios.get('http://localhost:8000/api/posts')
        .then(response => {
          this.posts = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    getPost(id) {
      axios.get('http://localhost:8000/api/posts/' + id)
        .then(response => {
          this.post = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    viewPost (post) {
	console.log(post)
      this.dialog = true
      this.getPost(post.id)
    }

  }
  }
</script>

<template>
  <div>
        <v-table>
        <thead>
          <tr>
            <th class="text-left">
              Title
            </th>
            <th class="text-left">
              Athor
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="post in posts"
            :key="post.id"
          >
            <td>{{ post.title }}</td>
            <td>{{ post.user.name }}</td>
            <td> <button @click="viewPost(post)" >View</button> </td>
          </tr>
        </tbody>
      </v-table>
  </div>

  <v-dialog
      v-model="dialog"
      width="auto"
    >

      <v-card
        class="mx-auto"
        width="400"
        prepend-icon="mdi-home"
      >
        <template v-slot:title>
          Author
        </template>
      
        <v-card-text>
          {{ post.user.name }} - {{ post.user.username }} - {{ post.user.email }}
        </v-card-text>
        <v-card-text>
          Phone: {{ post.user.phone }} Web: {{ post.user.website }} Company:  {{ post.user.company.name }}
        </v-card-text>
      </v-card>
      <v-card>
        <v-card-text>
          <div> <h1>{{ post.title }}</h1> </div>
          <div>{{ post.body }}</div>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" block @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>



</template>

<style lang="ts" scope>

</style>
