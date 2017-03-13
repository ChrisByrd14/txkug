<template>
    <div>
        <ul v-for="channel in channels">
            <li>
                <i class="fa fa-square c-font-red"></i>
                {{ channel.title }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                channels: []
            }
        },
        mounted() {
            axios.get('/api/settings/channels').then(response => this.channels = response.data);
        }
    }
</script>
