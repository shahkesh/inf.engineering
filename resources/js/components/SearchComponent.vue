<template>
    <div class="container">
        <div class="block">
            <form @submit.prevent="submit">
                <nav class="level">
                    <div class="level-left">
                        <div class="level-item" style="color: #00b89c; font-size: 20px;"><b>Search for spell:</b></div>
                        <div class="level-item">
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
                        </div>
                    </div>
                </nav>
            </form>
        </div>
        <div class="block">
            <div class="content"  style="color: #00b89c; font-size: 20px;"><b>Results:</b></div>
            <div v-for="result in results" class="columns" id="resultlist">
                <div class="column">
                    <p class="content" v-text="result.name"></p>
                </div>
                <div class="column">
                    <p class="content" v-text="result.kind.name"></p>
                </div>
                <div class="column">
                    <p class="content" v-text="result.quote"></p>
                </div>
                <div class="column">
                    <p class="content" v-text="result.description"></p>
                </div>
            </div>
        </div>
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

            }
        },

        methods: {
            submit() {
        axios.post('/search/spell',{q:this.form.spellname}).then(response =>{
            this.results=response.data;
            this.res='Results:'
        }).catch(error => {
            console.log(error);
        });
            }
        }
    }
</script>

<style scoped>
    #resultlist {
        background-color: rgba(0, 0, 0, 0.5);
        color:white;
    }
</style>
