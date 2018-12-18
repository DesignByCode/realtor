<template>
    <nav class="nav">
        <div class="nav__wrapper--fluid">
            <div class="nav__no__brand"></div>
            <div class="nav__navicon"></div>
            <div class="nav__links__wrapper nav__links--left">

                <ul class="nav__links">
                    <li class="nav__links__item search__wrapper">
                        <input class="form__item search__input" type="search">
                    </li>
                </ul>
            </div>
            <div class="nav__links__wrapper nav__links--right">
                <ul class="nav__links">
                    <li class="nav__links__item nav__links__item--dropdown">
                        <a class="nav__avatar" href="#">
                            <img src="/img/admin/avatar-mini.jpg" class="nav__avatar__img">Claude Myburgh</a>
                        <ul class="nav__links">
                            <router-link class="nav__links__item" tag="li" to="profile"><a>Profile</a></router-link>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="nav__shadow"></div>
    </nav>

</template>

<script>
    export default {
        name: "TopNav"
    }
</script>

<style scoped>

</style>
