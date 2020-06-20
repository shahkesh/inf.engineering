<template>
    <div class="container">
        <form @submit.prevent="submit">
            <div class="text">I am looking for:</div>
            <div class="field has-addons">

                <div class="control">
                    <input id="title"
                           v-model="form.spellname"
                           class="input"
                           type="text" autofocus>
                </div>
                <div class="control">
                    <button type="submit" class="button" v-text=" 'Search'"/>
                </div>
            </div>
            <p class="help">Search for spellname, kind, quote or description.</p>
        </form>

        <div v-if="entries" class="content" style="color: #00b89c; font-size: 20px;"><b>Results:</b></div>
        <table v-if="entries" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Kind</th>
                <th>Quote</th>
                <th>Description</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="result in results" :key="result.id">
                <td  class="customTD" @click="showSpell(result)" >{{result.name}}</td>
                <td class="customTD" @click="showKind(result)" >{{result.kind.name}}</td>
                <td>{{result.quote}}</td>
                <td>{{result.description}}</td>

            </tr>
            </tbody>
        </table>
               <div v-if="!entries && !search" class="text" ><b>No results found</b></div>
        </div>
   </template>


<script>

    let form = new Form({
        'spellname': '',
    });

    export default {

        name: "SearchComponent",

        data() {
            return {
                form: form,
                results: [],
                search: true

            }
        },
        computed:{
            entries(){
               return !!this.results.length;
            }
                   },

        methods: {
            submit() {
                axios.post('/search/spell', {q: this.form.spellname}).then(response => {
                    this.results = response.data;
                    this.res = 'Results:'
                }).catch(error => {
                    console.log(error);
                });
                this.search = this.entries();
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
