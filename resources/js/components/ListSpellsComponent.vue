<template>
    <div  class="container">
        <p class="help" style="margin-bottom: 1rem">Click a spell or kind for details.</p>
        <table v-if="entries" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>

            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in results" :key="result.id">
                <td class = "customTD" @click="showSpell(result)">{{result.name}}</td>
                <td  class = "customTD" @click="showKind(result)">{{result.kind.name}}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="!entries" class="text">No entries.</div>
     </div>
</template>

<script>

    export default {

        name: "ResultListComponent",

        data() {
            return {
                results: [],

            }
        },


        created() {
            axios.get('/list/spell').then(response =>{
                this.results=response.data.sort(this.compare);
            }).catch(error => {
                console.log(error);
            });

        },
        computed:{
            entries(){

                return !!this.results.length;
            },

        },
        mounted(){
            this.$options.interval = setInterval(this.updateList, 1000);
        },

        methods:{

            compare(a,b){

                const param1 = a.name.toLowerCase();
                const param2 = b.name.toLowerCase();
                let comparison = 0;
                if(param1 > param2){
                    comparison = 1;
                } else if(param1<param2){
                    comparison = -1;
                }
                return comparison;
            },

            updateList(){
                axios.get('/list/spell').then(response =>{
                    this.results=response.data.sort(this.compare);
                }).catch(error => {
                    console.log(error);
                });
            },
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            },
            showKind(kind) {
                window.location.href = '/kind/' + kind.kind.slug;
            }

        }
    }

</script>

<style scoped>

</style>
