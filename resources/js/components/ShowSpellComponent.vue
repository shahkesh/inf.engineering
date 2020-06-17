<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Kind</th>
                <th>Description</th>
                <th>Slug</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{spell.id}}</td>
                <td>{{spell.name}}</td>
                <td>{{spell.kind.name}}</td>
                <td>{{spell.description}}</td>
                <td>{{spell.slug}}</td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                spell: null
            }
        },

        created() {
            let urlElement  =  window.location.pathname.split('/');
            let spellElement = urlElement[2];

            axios.get('/list/spell')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {
                        if (spellElement == response.data[idx].slug){
                            this.spell = response.data[idx];
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)});
        }
    }
</script>

<style scoped>

</style>
