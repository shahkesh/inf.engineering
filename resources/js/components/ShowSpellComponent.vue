<template>
    <div class="container">
        <p class="help" style="margin-bottom: 1rem">Click on the name to edit this spell, or on the kind for details.</p>
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
                <td class="customTD" @click="showKind(spell)">{{kindname}}</td>
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
                window.location.href = '/kind/' + kind.kind.slug;
            }

        }
    }
</script>

<style scoped>

</style>
