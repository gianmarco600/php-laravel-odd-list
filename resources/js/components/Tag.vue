<template>
    <div>
        <span  class="m-1 badge badge-success" v-for="(tag, index) in tags" :key="index">{{ tag.name }}</span>
    </div>
</template>

<script>
export default {
    name:'Tag',
    props: ['tags'] ,
    data(){
        return {
           
        }
    }
}
</script>