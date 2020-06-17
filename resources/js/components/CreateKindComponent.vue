<template>
    <div class="container">
        <div class="card-content">
            <div class="content">

                <div class="field">
                    <label class="label">Kind Name:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.name" placeholder="Name for Kind">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Description:</label>
                    <div class="control">
                        <textarea class="input" type="text" v-model="form.description" placeholder="Description of Kind">

                        </textarea>
                    </div>
                </div>

                <div class="control">
                    <button type="submit" @click="createKind" class="button is-primary">Submit</button>
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
        'description': '',
        'error': 0,
    });
    export default {
        name: "CreateKindComponent",

        data() {
            return {
                form: form
            }
        },

        methods: {
            createKind() {
                form.post('/kind')
                    .then(response => {
                        this.form.error = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.error = 1,
                            console.log(error)
                    }),

                    this.name= '';
                this.description= '';
            }
        }
    }
</script>

<style scoped>
    .label{
        color: #00b89c;
    }
</style>
