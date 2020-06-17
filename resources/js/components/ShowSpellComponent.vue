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
                <td  @click="follow(spell)" style="color:#00b89c">{{spell.name}}</td>
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
        },
        methods:{
            follow(spell){
                window.location.href = '/spell/' + spell.slug +'/edit/';
            }
        }
    }
</script>

<style scoped>
    .table {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
    }
    .table thead th {
        color: #00b89c;
    }
</style>
