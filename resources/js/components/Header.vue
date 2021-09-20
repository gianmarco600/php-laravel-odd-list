<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-success bg-dark">
            <router-link class="navbar-brand" :to="{name: 'home'}">Navbar</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li v-for="(link,i) in menu" :key='i' class="nav-item active">

                        <router-link class="nav-link" :to="{ name: link.routeName }">
                            {{ link.label }}
                        </router-link>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name:'Header',
    data(){
        return {
            menu:[
                {
                    label:'Home',
                    routeName : 'home'
                },
                {
                    label:'Chi siamo',
                    routeName : 'About'
                },
                {
                    label:'contatti',
                    routeName : 'contact'
                },
                {
                    label:'posts',
                    routeName : 'Post'
                }
            ]
        }
    }
}
</script>

<style lang="scss" scoped>

</style>