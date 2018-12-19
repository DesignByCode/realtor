<template>
    <main class="main">
        <div class="sidebar__menu">
            <div class="sidebar__mini"></div>
            <sidebar-menu></sidebar-menu>
        </div>
        <top-nav></top-nav>
        <div class="main__container">
            <div class="wrapper--fluid">
                <div class="row">
                    <div class="md-col-12">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "AppAdmin"
    }
</script>

<style scoped>

</style>
