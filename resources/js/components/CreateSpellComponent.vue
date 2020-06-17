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
                        <button type="submit" @click="create" class="button is-primary">Submit</button>
                </div>

                <div v-if="form.error === 1" >
                    <div class="message is-danger">
                        <div class="message-body">
                            Eingegebenes schon vorhanden, Änderung nötig.
                        </div>
                    </div>
                </div>
                <div v-if="form.error === 2" >
                    <div class="message is-success">
                        <div class="message-body">
                            Wurde gespeichert!
                        </div>
                    </div>
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
        'kind_id': '',
        'error': 0,
    });
    export default {
        props: ['title'],
        name: "CreateSpellComponent",

        data() {
            return {
                form: form
            }
        },

        methods: {
            create() {
                form.post('/spell')
                    .then(response => {
                        this.form.error = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.error = 1,
                            console.log(error)
                    }),

                this.name= '';
                this.quote= '';
                this.description= '';
                this.kind_id= '';
                }
        }
    }
</script>

<style scoped>

</style>
