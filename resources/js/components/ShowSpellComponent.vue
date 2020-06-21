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
                <td  @click="follow(spell)" class="customTD">{{spell.name}}</td>
                <td>{{kindname}}</td>
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
                spell:[],
                kindname:''
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
                            this.kindname= response.data[idx].kind.name;
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

</style>
