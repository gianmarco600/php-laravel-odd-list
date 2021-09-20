<template>
    <div>
        <Header></Header>
        <Main></Main>
    </div>
    
</template>

<script>
import Header from '../components/Header';
import Main from '../components/Main';
export default {
    name: 'App',
    components:{
        Header,
        Main
    }
}
</script>

<style lang="scss" scoped>

</style>