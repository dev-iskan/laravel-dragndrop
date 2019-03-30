<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editing <em>{{title}}</em></div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" v-if="message" role="alert">
                            {{message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" @submit.prevent="submit">
                            <div class="form-group">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" id="title" class="form-control" :class="{'is-invalid': errors.title}" v-model="title">
                                <div class="invalid-feedback" v-if="errors.title">
                                    {{errors.title[0]}}
                                </div>
                            </div>

                            <draggable :list="parts" :options="{'handle': '.card-header'}" @start="drag=true" @end="drag=false" @change="update">
                                <div class="card mb-3" v-for="(part, index) in parts">
                                    <div class="card-header">Part {{index + 1}} ({{part.sort_order}})</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label :for="'part-title-'+index" class="control-label">Part title</label>
                                            <input type="text" class="form-control" :id="'part-title-'+index" :class="{'is-invalid': errors['parts.'+index+'.title']}" v-model="parts[index].title">
                                            <div class="invalid-feedback" v-if="errors['parts.'+index+'.title']">
                                                {{errors['parts.'+index+'.title'][0]}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </draggable>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: {
            data: {
                required: true
            }
        },

        data () {
            return {
                title: '',
                parts: [],
                errors: [],
                message: null
            }
        },

        created() {
            this.title = this.data.title;
            this.parts = this.data.parts
        },

        methods: {
            update (e) {
                this.parts.map((part, index) => {
                    part.sort_order = index +1
                })
            },
            submit () {
                axios.patch(`/series/${this.data.id}`, {
                    title: this.title,
                    parts: this.parts,
                }).then(response => {
                    this.message = 'Series saved!'
                }).catch(err => {
                    this.message = null
                    this.errors = err.response.data.errors
                })
            }
        }
    }
</script>
