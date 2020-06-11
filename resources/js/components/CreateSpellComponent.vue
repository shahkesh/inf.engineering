<template>
    <div class="container">
        <div class="card-content">
            <div class="content">

                <div class="field">
                    <label class="label">Name:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.name" placeholder="Name for Spell">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Quote:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.quote" placeholder="Quote">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Description:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.description" placeholder="Description">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Kind Id:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.kind_id" placeholder="Kind">
                    </div>
                </div>

                <div class="control">
                        <button type="submit" @click="submit" class="button is-primary">Submit</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'name': '',
        'quote': '',
        'description': '',
        'kind_id': 0
    });
    export default {
        props: ['title'],
        name: "CreateSpellComponent",

        data() {
            return {
                form: form,
            }
        },

        methods: {
            submit() {
                let name = this.name;
                let quote = this.quote;
                let description = this.description;
                let kind_id = this.kind_id;
                axios.post('/spell', {
                    name,
                    quote,
                    description,
                    kind_id
                })
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error);
                    });

                this.name= '';
                this.quote= '';
                this.description= '';
                this.kind_id= 0;
                },
        }
    }
</script>

<style scoped>

</style>
