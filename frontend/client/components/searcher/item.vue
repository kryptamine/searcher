<template>
    <div class="py-md-3 pl-md-5 bd-content">
        <div v-if="result" v-for="item in result.results">
            <h1>Сайт: {{ result.url }}</h1>
            <b-form-group :label="'Результат поиска: '+item.type">
                <b-form-textarea :rows="30" :cols="100" plaintext :value="item.results"></b-form-textarea>
            </b-form-group>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import config from '../../config/config.json';

    export default {
        data() {
            return {
                result: []
            }
        },
        created() {
            axios.get(`${config.api_url}/results/${this.$route.params.id}`).then(response => {
                this.result = response.data;
            }).catch(e => {
                this.errors.push(e)
            })
        },
        methods: {

        }
    }
</script>
