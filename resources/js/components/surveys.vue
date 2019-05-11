<template>
    <div class="my-4">
        <h2 class="text-grey-darkest">Surveys</h2>
        <p class="text-grey-dark mt-2">The following are some surveys</p>
        <div v-for="survey in surveys" v-bind:key="survey.id">
            {{survey.id}}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                surveys:{}
            }
        },
        mounted() {
            axios.get('/api/survey/').then((response)=>{
                this.surveys = response.data.surveys;
                console.log(this.surveys);
            });
        }
    }
</script>
