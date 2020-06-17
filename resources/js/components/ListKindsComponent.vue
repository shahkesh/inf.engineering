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
                            <tr v-for="kind in results" >
                                <td>{{kind.id}}</td>
                                <td @click="showKind(kind)" style="color:#00b89c">{{kind.name}}</td>
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
                    this.results = response.data.sort(this.compare)})
                .catch(error =>
                {console.log(error.data, error.status)});
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
            showKind(kind){
                window.location.href = '/kind/' + kind.slug;
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
