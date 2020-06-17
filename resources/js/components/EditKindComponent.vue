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

                <div class="control">
                    <button type="submit" @click="editKind" class="button is-primary">Submit</button>
                </div>

                <div v-if="form.error === 1">
                    <div class="message is-danger">
                        <div class="message-body">
                            Eingegebenes schon vorhanden, Änderung nötig.
                        </div>
                    </div>
                </div>
                <div v-if="form.error === 2">
                    <div class="message is-success">
                        <div class="message-body">
                            Wurde geändert!
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
        'error': 0,
    });
    export default {

        data() {
            return {
                form: form
            }
        },
        created() {
            let urlElement  =  window.location.pathname.split('/');
            let kindElement = urlElement[2];

            axios.get('/list/kind')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {

                        if (kindElement == response.data[idx].slug){
                            form.slug = response.data[idx].slug;
                            console.log(response.data[idx]);
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)});
        },
        methods: {
            editKind() {
                form.put('/kind/'+ form.slug)
                    .then(response => {
                        this.form.error = 2,
                            console.log(response)
                    })
                    .catch(error => {
                        this.form.error = 1,
                            console.log(error)
                    })
                window.setTimeout(window.location.href = '/kind/',5000);

            }
        }
    }
</script>
<style scoped>
    .label{
        color: #00b89c;
    }
</style>
