<template>
    <div class="page">
        <b-jumbotron header="Searcher">
            <small v-if="result">
                Найдено: {{ result.count }}
            </small>
            <b-input-group>
                <b-input-group-addon>
                    Site URL
                </b-input-group-addon>
                <b-form-input v-model="query.url"></b-form-input>
                <b-input-group-button slot="right">
                    <b-dropdown :text="query.parse_type" variant="success" right>
                        <b-dropdown-item v-for="type in types" @click="setType(type)" v-bind:key="type">{{ type }}</b-dropdown-item>
                    </b-dropdown>
                    <b-btn variant="danger" @click="parse" :disabled="!isValid">Go</b-btn>
                </b-input-group-button>
            </b-input-group>
            <div v-if="query.parse_type == 'text'">
                <label>text value:</label>
                <b-form-input size="sm" type="text" placeholder="Enter some text to search here.."></b-form-input>
            </div>
            <div v-if="result">
                <b-form-group label="Результат поиска">
                    <b-form-textarea :rows="30" :cols="100" plaintext :value="result.results"></b-form-textarea>
                </b-form-group>
            </div>
        </b-jumbotron>
    </div>
</template>

<script>
    import axios from 'axios';
    import config from '../../config/config.json';

    const rules = {
        required(value) {
            return value.length;
        },
        url(value) {
            const regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;

            return regex.test(value)
        }
    }

    export default {
        data() {
            return {
                query: {
                    url: '',
                    parse_type: 'image'
                },
                types: ['image', 'link', 'text'],
                result: null
            }
        },
        methods: {
            setType(type) {
                this.query.parse_type = type;
            },
            parse() {
                axios.post(`${config.api_url}/search`, this.query).then(response => {
                    this.result = response.data;
                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },
        computed: {
            isValid() {
                return rules.required(this.query.url) && rules.url(this.query.url);
            }
        }
    }
</script>
