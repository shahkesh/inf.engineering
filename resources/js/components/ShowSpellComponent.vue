<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td  @click="follow(spell)" class="customTD">{{spell.name}}</td>
                <td @click="showKind(spell.kind)" class="customTD">{{kindname}}</td>
                <td>{{spell.description}}</td>
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
            },
            showKind(kind) {
                window.location.href = '/kind/' + kind.slug;
            }
        }
    }
</script>

<style scoped>

</style>
