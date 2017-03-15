<template>
    <div>
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-font-bold">Event Types</h3>
        </div>
        <div class="c-content-divider c-divider-sm c-theme-bg"></div>

        <div class="row">
            <div class="col-md-6">
                <div v-if="channelsList">
                    <ul class="list-group">
                        <li class="list-group-item"
                            v-for="channel in channelsList">
                            <i class="fa fa-square" :style="{ color: '#' + channel.color }"></i>
                            {{ channel.title }}
                            <span class="btn-group pull-right">
                                <button @click="showChannel(channel.id)" type="button" class="btn btn-primary btn-xs" style="margin-right: 1vh;"> Edit</button>
                                <!--<button v-if="!list.deleted_at" @click="deleteEventType(list.id)" type="button" class="btn btn-danger btn-xs"> Disable</button>-->
                                <!--<button v-if="list.deleted_at" @click="unDeleteEventType(list.id)" type="button" class="btn btn-success btn-xs"> Enable&nbsp;</button>-->
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <form action="#" @submit.prevent="edit ? updateChannel(channel.id) : createChannel()"  class="form-inline">
                    <div class="input-group">
                        <input type="text" name="title"
                            v-model="channel.title" class="form-control"
                            placeholder="Channel Name ..."
                            style="width: 250px;">
                        <span class="input-group-btn">
                            <button v-show="!edit" type="submit" class="btn btn-primary">Add</button>
                            <button v-show="edit" type="submit" class="btn btn-success">Save</button>
                            <button v-show="edit" @click="cancelUpdateChannel()" type="button" class="btn btn-danger">Cancel</button>
                        </span>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                edit: false,
                channelsList: [],
                channel: {
                    id: '',
                    title: '',
                    color: ''
                }
            }
        },
        mounted() {
            this.fetchChannelsList();
        },
        methods: {
            fetchChannelsList: function() {
                axios.get('/api/settings/channels').then(response => this.channelsList = response.data);
            },

            createChannel: function () {
                axios.post('/api/settings/channels', {
                    title: this.channel.title
                }).then(function () {
                    this.channel.title = '';
                    this.edit = false;
                    this.fetchChannelsList();
                }.bind(this));
            },

//            updateEventType: function(id) {
//                axios.patch('/api/settings/event-types/' + id, {
//                    id: this.eventType.id,
//                    event_type: this.eventType.event_type
//                }).then(function () {
//                    this.eventType.event_type = '';
//                    this.edit = false;
//                    this.fetchEventTypesList();
//                }.bind(this));
//
//            },

//            cancelUpdateEventType: function() {
//                this.eventType.event_type = '';
//                this.edit = false;
//                this.fetchEventTypesList();
//            },

//            showEventType: function(id) {
//                this.$http.get('/api/settings/event-types/' + id).then(response => this.eventType = response.data);
//                this.edit = true;
//            },

//            deleteEventType: function (id) {
//                axios.delete('/api/settings/event-types/' + id).then(function () {
//                    this.fetchEventTypesList();
//                }.bind(this));
//            },

//            unDeleteEventType: function(id){
//                axios.patch('/api/settings/event-types/' + id + '/restore', {
//                    id: this.eventType.id,
//                    event_type: this.eventType.event_type
//                }).then(function () {
//                    this.eventType.event_type = '';
//                    this.edit = false;
//                    this.fetchEventTypesList();
//                }.bind(this));
//            }
        }
    }
</script>
