<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, usePage } from '@inertiajs/inertia-vue3'

import { reactive, ref, computed, inject } from 'vue'
import axios from 'axios';


      const dialog:any = ref(false)
      const loading:any = ref(true)
      const posts:any = ref([])
      const post:any = ref({})
      const pagination = ref({
                              page: 1, // Página actual
                              itemsPerPage: 10, // Elementos por página
                              totalItems: 0 // Total de elementos
                            });

      function  getPosts() {
          axios.get('http://localhost:8000/api/posts')
            .then((response: any) => {
              posts.value = response.data;
              pagination.value.totalItems = posts.value.length;
              loading.value = false
            })
            .catch((error: any) => {
              console.error(error);
            });
        }
    getPosts()
    
  function getPost(id: number) {
    
      axios.get('http://localhost:8000/api/posts/' + id)
        .then((response: any) => {
          post.value = response.data;
        })
        .catch((error: any) => {
          console.error(error);
        });
    }

  function viewPost (p: any) {
	    console.log(post)
      post.value = {}
      getPost(p.id)
      dialog.value = true
    }
    
</script>

<template>
  <div>
    <v-progress-circular v-if="loading" indeterminate color="primary"></v-progress-circular>
    <div v-else>
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
            v-for="(post) in posts.slice(
              (pagination.page - 1) * pagination.itemsPerPage,
              pagination.page * pagination.itemsPerPage
            )"
            :key="post.id"
          >
            <td>{{ post.title }}</td>
            <td>{{ post.user.name }}</td>
            <td> <button @click="viewPost(post)" >View</button> </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>
              <v-pagination v-model="pagination.page" :length="Math.ceil(posts.length / pagination.itemsPerPage)" :total-visible="6"></v-pagination>
            </td>
          </tr>
        </tfoot>
      </v-table>
    </div>
  </div>
  



  <v-dialog
      v-model="dialog"
      width="auto"
    >
      <v-card>
        <v-card-text>
          <v-container class="bg-surface-variant">
            <v-row no-gutters>
              <v-col>
                <v-sheet class="pa-2 ma-2">
                  <h2>Author</h2>
                  <p>{{ post.user?.name }} - {{ post.user?.username }} - {{ post.user?.email }}</p>
                  <p>Phone: {{ post.user?.phone }} Web: {{ post.user?.website }} Company:  {{ post.user?.company.name }}</p>
                </v-sheet>
              </v-col>

              <v-responsive width="100%"></v-responsive>

              <v-col>
                <v-sheet class="pa-2 ma-2">
                  <p> 
                    <div> <h1>{{ post.title }}</h1> </div>
                    <div>{{ post.body }}</div>
                  </p>
                </v-sheet>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" block @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>



</template>

<style lang="scss" scope>

</style>