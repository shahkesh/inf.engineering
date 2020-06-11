<template>
    <div class="container">
            <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="kind in results ">
                                <td>{{kind.id}}</td>
                                <td>{{kind.name}}</td>
                                <td>{{kind.description}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

</template>

<script>
    export default {
        data() {
            return {
                results: []
            }
        },

        mounted() {
            axios.get('/list/kind')
                .then(response => {
                    this.results = response.data})
                .catch(error =>
                {console.log(error.data, error.status)});
        }
    }
</script>

<style scoped>

</style>
