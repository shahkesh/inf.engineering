<template>
    <div class="container">
        <table v-if="entries" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="kind in results">
                <td>{{kind.id}}</td>
                <td @click="showKind(kind)" style="color:#00b89c">{{kind.name}}</td>

            </tr>
            </tbody>
        </table>
        <div v-if="!entries && !search" class="text">No entries.</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                results: [],
                search: true
            }
        },



        created() {
            axios.get('/list/kind')
                .then(response => {
                    this.results = response.data.sort(this.compare)
                })
                .catch(error => {
                    console.log(error.data, error.status)
                });
            this.search = this.entries();
        },
        computed: {
            entries() {
                return !!this.results.length;
            }
        },
        mounted(){
            this.$options.interval = setInterval(this.updateList, 1000);
        },




        methods: {
            compare(a, b) {

                const param1 = a.name.toLowerCase();
                const param2 = b.name.toLowerCase();
                let comparison = 0;
                if (param1 > param2) {
                    comparison = 1;
                } else if (param1 < param2) {
                    comparison = -1;
                }
                return comparison;
            },
            updateList(){
                axios.get('/list/kind')
                    .then(response => {
                        this.results = response.data.sort(this.compare)
                    })
                    .catch(error => {
                        console.log(error.data, error.status)
                    });
            },
            showKind(kind) {
                window.location.href = '/kind/' + kind.slug;
            }
        }
    }
</script>

<style scoped>

</style>
