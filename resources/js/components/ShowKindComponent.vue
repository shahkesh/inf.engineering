<template>
    <div class="container">
        <p class="help" style="margin-bottom: 1rem">Click on the name to edit this kind.</p>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="customTD" @click="follow(kind)">{{kind.name}}</td>
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
                kind:[]
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
