<template>
    <div class="container">
        <p class="help" style="margin-bottom: 1rem">Click a kind for details.</p>
        <table v-if="entries" class="table">
            <thead>
            <tr>

                <th>Name</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="kind in results">

                <td @click="showKind(kind)" class="customTD">{{kind.name}}</td>

            </tr>
            </tbody>
        </table>
        <div v-if="!entries" class="text">No entries.</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                results: [],

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
