<template>
    <div class="py-md-3 pl-md-5 bd-content">
        <h1>Checked elements list</h1>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Site Url</th>
                    <th>By types</th>
                    <th>Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in result">
                    <td>{{ item.id }}</td>
                    <td> <router-link :to="{ path: 'item/'+item.id }">{{ item.url }}</router-link></td>
                    <td>
                        <span v-for="item in item.results">
                            {{ item.type }}: <b-badge>{{ item.count }}</b-badge>
                        </span>
                    </td>
                    <td>
                        {{ calculateTotals(item.results) }}
                    </td>
                </tr>
            </tbody>
        </table>
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
            axios.get(`${config.api_url}/results`).then(response => {
                this.result = response.data;
            }).catch(e => {
                this.errors.push(e)
            })
        },
        methods: {
            calculateTotals(results) {
                return results.reduce((p, r) => {
                    return p + r.count;
                }, 0);
            }
        }
    }
</script>
