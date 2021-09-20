<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{ post.title }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ post.category }}</h5>
                        <p class="card-text">{{ post.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name:'Details',
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
                .catch()
        }
    }
}
</script>

<style lang="scss" scoped>

</style>