<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card text-white bg-primary mb-3" >
                    <div class="card-header"><h1>{{ post.title }}</h1></div>
                    <div class="card-body">
                        
                        <div v-if="post.category">
                            <h2>{{ post.category.name }}</h2>
                        </div>
                        <div v-if="post.tags">
                            <Tag :tags="post.tags"/>
                        </div>
                        <!-- <div v-if="post.tags" >
                            <span  class="m-1 badge badge-success" v-for="(tag, index) in post.tags" :key="index">{{ tag.name }}</span>
                        </div> -->
                        
                        <!-- <h5 class="card-title">{{ post.category }}</h5> -->
                        <p class="card-text">{{ post.description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <router-link :to="{name: 'Post'}" class="btn btn-secondary">indietro</router-link>
    </div>
</template>

<script>
import Tag from '../components/Tag'

export default {
    name:'Details',
    components:{
        Tag
    },
    data(){
        return {
            apiCall : '/api/post/',
            post:[]
        }
    },
    mounted(){
        this.getPost();
    },
    methods: {
        getPost(){
            axios.get(this.apiCall + this.$route.params.slug)
                .then( response => {
                    this.post = response.data.results;
                    console.log(response.data.results)
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>