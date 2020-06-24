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
                    <label class="label">New Name for this kind:</label>
                    <div class="control">
                        <input class="input" type="text" v-model="form.name" placeholder="NEW Name of kind">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Updating the description:</label>
                    <div class="control">
                        <textarea class="input" type="text" v-model="form.description" placeholder="Description of kind">

                        </textarea>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <input class="is-hidden" type="text" v-model="form.kind_id">
                    </div>
                </div>

                <div class="control">
                    <button type="submit" @click="editKind" class="button is-primary">Submit</button>
                </div>
                <br/>
                <div class="control"  v-if="form.error !== 2 ">
                    <button type="is-hidden" @click="first" class="button is-primary">Delete?</button>
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
        'name': '',
        'description': '',
        'kind_id':'',
        'quote':'',
        'error': 0,
        'errorDelete': 0
    });
    export default {

        data() {
            return {
                form: form,
                formSpell:form,
                id_param:''
            }
        },
        created() {
            let urlElement = window.location.pathname.split('/');
            let kindElement = urlElement[2];

            axios.get('/list/kind')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {

                        if (kindElement == response.data[idx].slug) {
                            form.kind_id = response. data[idx].id;
                            form.slug = response.data[idx].slug;
                            form.name = response.data[idx].name;
                            form.description = response.data[idx].description;
                            form.kind_id = response.data[idx].id;
                            this.id_param = form.kind_id;
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)
                });

        },
        methods: {
            editKind() {
                form.put('/kind/' + form.slug)
                    .then(response => {
                        this.form.error = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.error = 1,
                            console.log(error)
                    })

            },
            deleteKind() {

                form.delete('/kind/' + form.slug)
                    .then(response => {
                        this.form.errorDelete = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.errorDelete = 1,
                            console.log(error)
                    });

                axios.get('/list/spell')
                    .then(response => {
                        for (let idx = 0; idx < response.data.length; idx++) {

                            if (this.id_param == response.data[idx].kind_id){

                                form.delete('/spell/' + response.data[idx].slug)
                                    .then(response => {
                                        this.form.errorDelete = 2,
                                            console.log(response)
                                    })
                                    .catch(error => {
                                        this.form.errorDelete = 1,
                                        console.log(error)
                                    })
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error, error.status)
                    });
                window.setTimeout(window.location.href = '/kind/',5000);
            },
            first() {
                if (confirm("Are you sure?")) {
                    this.deleteKind();
                }
            }
        }
    }
</script>
<style scoped>
    .label{
        color: #00b89c;
    }
</style>
