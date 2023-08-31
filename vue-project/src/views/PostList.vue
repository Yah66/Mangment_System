<template>
    <div class="post">
        <div class="mb-3">
            <button class="btn btn-primary" @click="addPost">Add Post</button>
            <input class="form-control" type="text" v-model="searchTerm" @input="filterPosts" placeholder="Search" />
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Body</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in filteredPosts" :key="post.id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.body }}</td>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item" v-for="page in pageCount" :key="page">
                    <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                </li>
            </ul>
        </nav>
    </div>


    <li v-for="message in messages">
        {{ message }}
    </li>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            posts: [],
            searchTerm: '',
            currentPage: 1,
            itemsPerPage: 5,
        };
    },
    computed: {
        filteredPosts() {
            return this.posts.filter(post =>
                post.title.toLowerCase().includes(this.searchTerm.toLowerCase())
            );
        },
        pageCount() {
            return Math.ceil(this.filteredPosts.length / this.itemsPerPage);
        },
        displayedPosts() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredPosts.slice(startIndex, startIndex + this.itemsPerPage);
        },
    },
    methods: {
        addPost() {
            const newId = this.posts.length + 1;
            const newPost = { id: newId, title: `Post ${newId}`, body: 'New body.' };
            this.posts.push(newPost);
        },
        filterPosts() {
            this.currentPage = 1;
        },
        changePage(page) {
            this.currentPage = page;
        },
    },
    created() {
        axios.get('http://localhost:8000/api/posts')
            .then(response => {
                this.posts = response.data;
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
            });
    },
};
</script>

<style scoped>
.post {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.table {
    width: 80%;
    border-collapse: collapse;
    margin: 0 auto;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    padding: 10px 15px;
    border-bottom: 1px solid #e2e2e2;
    text-align: left;
}

.table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>
