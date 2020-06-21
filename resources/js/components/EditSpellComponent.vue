<template>
    <div class="container">
        <div class="card-content">
            <div class="content">

                <div class="field">
                    <div class="control">
                        <input class="is-hidden" type="text" v-model="form.slug" placeholder="Please put in the original name" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <input class="is-hidden" type="text" v-model="form.kind_id" placeholder="Kind">
                    </div>
                </div>

                <div class="field">
                    <label class="label">New Name for this spell:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.name" placeholder="NEW Name for the Spell">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Updating the quote:</label>
                    <div class="control">
                        <textarea class="input" type="text" v-model="form.quote" placeholder="Quote">

                        </textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Updating the description:</label>
                    <div class="control">
                        <textarea class="input" type="text" v-model="form.description" placeholder="Description of kind">

                        </textarea>
                    </div>
                </div>

                <div class="control">
                    <button type="submit" @click="editSpell" class="button is-primary">Submit</button>
                </div>
                <br/>
                <div class="control" v-if="form.error !== 2 ">
                    <button type="submit" @click="deleteSpell" class="button is-primary">Delete?</button>
                </div>

                <div v-if="form.error === 1">
                    <div class="message is-danger">
                        <div class="message-body">
                            Input already exists, please enter new input.
                        </div>
                    </div>
                </div>
                <div v-if="form.error === 2">
                    <div class="message is-success">
                        <div class="message-body">
                            Changes saved!
                        </div>
                    </div>
                </div>
                <div v-if="form.errorDelete === 1">
                    <div class="message is-danger">
                        <div class="message-body">
                            Error while deleting!
                        </div>
                    </div>
                </div>
                <div v-if="form.errorDelete === 2">
                    <div class="message is-success">
                        <div class="message-body">
                            Successfully deleted!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'slug': '',
        'kind_id': '',
        'name': '',
        'quote': '',
        'description': '',
        'error': 0,
        'errorDelete': 0
    });
    export default {

        data() {
            return {
                form: form
            }
        },
        created() {
            let urlElement  =  window.location.pathname.split('/');
            let spellElement = urlElement[2];

            axios.get('/list/spell')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {

                        if (spellElement == response.data[idx].slug){
                            form.slug = response.data[idx].slug;
                            form.kind_id = response.data[idx].kind_id;
                            form.name = response.data[idx].name;
                            form.description = response.data[idx].description;
                            form.quote = response.data[idx].quote;
                            console.log(response.data[idx].slug);
                            console.log(response.data[idx].kind_id);
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)});
        },
        methods: {
            editSpell() {
                form.put('/spell/'+ form.slug)
                    .then(response => {
                        this.form.error = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.error = 1,
                            console.log(error)
                    })
            },
            deleteSpell() {
                form.delete('/spell/'+ form.slug)
                    .then(response => {
                        this.form.errorDelete = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.errorDelete = 1,
                            console.log(error)
                    })
                window.setTimeout(window.location.href = '/spell/',5000);

            }
        }
    }
</script>
<style scoped>
    .label{
        color: #00b89c;
    }
</style>
