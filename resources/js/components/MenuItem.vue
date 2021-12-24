<template>
    <li class="nav-item">
        <router-link :to="{name: route.name}" class="nav-link">
            <i class="nav-icon fas" v-bind:class="this.route.meta.icon"></i>
            {{ title }}
        </router-link>
    </li>
</template>

<script>
export default {
    name: "menu-item",
    props: {
        route: {
            type: Object
        }
    },
    computed: {
        title() {
            return this.route.meta.title
                .toLowerCase()
                .split("-")
                .map(s => s.charAt(0).toUpperCase() + s.slice(1))
                .join(" ");
        },
        isVisible() {
            if (this.route.meta && (this.route.meta.visible === undefined || this.route.meta.visible)) {
                return true;
            }
            return false;
        },
    }
}
</script>

<style scoped>

</style>
