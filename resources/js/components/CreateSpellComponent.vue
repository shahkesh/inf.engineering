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
                        <textarea class="input" type="text" v-model="form.quote" placeholder="Quote">

                        </textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Description:</label>
                    <div class="control">
                        <textarea class="input" type="text" v-model="form.description" placeholder="Description">

                        </textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Kind Id:</label>
                    <div class="control">
                        <select v-model="selected" class="form-control select is-medium" @change="changeKind($event)">
                            <option selected disabled>Kinds</option>
                            <option v-for="kind in results" :value="kind.id">{{kind.name}}</option>
                        </select>
                    </div>
                </div>

                <div class="control">
                    <button type="submit" @click="create" class="button is-primary">Submit</button>
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
        name: "CreateSpellComponent",

        data() {
            return {
                form: form,
                results: ''
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

        methods: {
            changeKind(event) {
                form.kind_id = event.target.value;
            },
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

                    this.name = '';
                this.quote = '';
                this.description = '';
                this.kind_id = '';
                this.selected = '';
            }
        }
    }
</script>

<style scoped>
    .label {
        color: #00b89c;
    }
</style>
