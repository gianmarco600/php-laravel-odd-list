<template>
    <div class="container">
        <h4>pagina: {{ currentPage }} su : {{ lastPage }}</h4>
        <div class="row">
            <div class="col-sm-6" v-for=" post in posts" :key="post.id">
                <div class="card bg-dark text-white mt-5" >
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ cut(post.description, 80) }} </h6>
                        <p class="card-text">{{ prepareDate(post.created_at) }}</p>
                        
                        <router-link class="btn btn-info" :to="{name: 'details', params: { slug: post.slug } }">dettagli</router-link>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination">
                <li :class="{ 'disabled' : currentPage == 1 }" class="page-item">
                    <button @click="getPosts(currentPage - 1)" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                    </button>
                </li>
                <li v-for="index in lastPage" :class="{'active' : currentPage == index}" :key="index" class="page-item">
                    <button  class="page-link" @click="getPosts(index)">{{ index }}</button>
                </li>
                
                <li :class="{ 'disabled' : currentPage == lastPage }" class="page-item">
                    <button @click="getPosts(currentPage + 1)" class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name:'Post',
    data(){
        return{
            // qui si trova il controller delle api
            apiCall:'http://127.0.0.1:8000/api/posts',
            posts:[],
            currentPage: 1,
            lastPage: null
        
        }
    },
    created(){
        
        this.getPosts(1);
        // console.log(this.posts);
    },
    methods:{
        getPosts(page){
            axios.get(this.apiCall, {
                    params:{
                        page: page
                    }
                })
                 .then(response =>{
                    this.posts = response.data.results.data ;
                    this.currentPage = response.data.results.current_page;
                    this.lastPage = response.data.results.last_page;
                    })
                 .catch()
            },
        cut(text , mLength){
            if(text.length > mLength){
                return text.substr(0 , mLength) + '...';
            }
            return text;
        },    
        prepareDate(data){
            const Cdate = new Date(data);

            let day = Cdate.getDate()
            let month = Cdate.getMonth();
            if(day < 10){
                day = '0' + day;
            }
            if(month < 10){
                month = '0' + month;
            }
            return day + '/' + month + '/' +Cdate.getFullYear();
        }
    }

}
</script>

<style lang="scss" scoped>

</style>