<template>
    <div  class="container">
        <table v-if="entries" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>

            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in results" :key="result.id">
                <td  @click="showSpell(result)" style="color:#00b89c">{{result.name}}</td>
                <td>{{result.kind.name}}</td>

            </tr>
            </tbody>
        </table>
        <div v-if="entries && !search" class="text">No entries.</div>

    </div>
</template>

<script>

    export default {

        name: "ResultListComponent",

        data() {
            return {
                results: [],
                search: true

            }
        },


        created() {
            axios.get('/list/spell').then(response =>{
                this.results=response.data.sort(this.compare);
            }).catch(error => {
                console.log(error);
            });
            this.search = this.entries();

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
            }

        }
    }

</script>

<style scoped>

</style>
