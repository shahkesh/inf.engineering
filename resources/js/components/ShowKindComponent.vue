<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Slug</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{kind.id}}</td>
                <td  @click="follow(kind)"><strong>{{kind.name}}</strong></td>
                <td>{{kind.description}}</td>
                <td>{{kind.slug}}</td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                kind: null
            }
        },

        created() {
            let urlElement  =  window.location.pathname.split('/');
            let kindElement = urlElement[2];

            axios.get('/list/kind')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {
                        if (kindElement == response.data[idx].slug){
                            this.kind = response.data[idx];
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)});
        },
        methods:{
            follow(kind){
                window.location.href = '/kind/' + kind.slug +'/edit/';
            }
        }
    }
</script>

<style scoped>

</style>
