<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>
                <th>Quote</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="result in results">
                <td>{{result.name}}</td>
                <td>{{result.kind.name}}</td>
                <td>{{result.quote}}</td>
                <td>{{result.description}}</td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ListSpellsComponent",

        data() {
            return {
                results: [],
            }
        },

           mounted(){
                axios.get('/list/spell').then(response =>{
                    this.results=response.data;
                }).catch(error => {
                    console.log(error);
                });
            }

    }
</script>

<style scoped>

</style>
