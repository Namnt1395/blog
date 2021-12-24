<template>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <menu-item v-for="(r,i) in routes" :key="i" :route="r"></menu-item>
    </ul>
</template>

<script>
import MenuItem from "./MenuItem";

export default {
    name: "side-menu",
    components: { MenuItem },
    computed: {
        routes() {
            return this.$router.options.routes;
        }
    }
}
</script>

<style scoped>

</style>
