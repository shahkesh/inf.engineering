<template>
    <div class="container">
        <table  class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>
                <th>Quote</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in results" :key="result.id" @dblclick="showSpell(result)">
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

        name: "ResultListComponent",

        data() {
            return {
                results: []

            }
        },
        created() {
            axios.get('/list/spell').then(response =>{
                this.results=response.data.sort(this.compare);
            }).catch(error => {
                console.log(error);
            });
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
    .table {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
    }
    .table thead th {
        color: #00b89c;
    }
</style>
