<template>
    <div>
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-font-bold">Event Types</h3>
        </div>
        <div class="c-content-divider c-divider-sm c-theme-bg"></div>

        <div class="row">

            <div class="col-md-6">
                <div v-if="eventTypesList">
                    <ul class="list-group">
                        <li class="list-group-item c-bg-grey-1"
                            v-for="list in eventTypesList">
                            {{ list.event_type }}
                            <span class="btn-group pull-right">
                                <button @click="showEventType(list.id)" type="button" class="btn btn-primary btn-xs" style="margin-right: 1vh;"> Edit</button>
                                <!--<button v-if="!list.deleted_at" @click="deleteEventType(list.id)" type="button" class="btn btn-danger btn-xs"> Disable</button>-->
                                <!--<button v-if="list.deleted_at" @click="unDeleteEventType(list.id)" type="button" class="btn btn-success btn-xs"> Enable&nbsp;</button>-->
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <form action="#" @submit.prevent="edit ? updateEventType(eventType.id) : createEventType()"  class="form-inline">
                    <div class="input-group">
                        <input type="text"
                               name="event_type"
                               v-model="eventType.event_type"
                               class="form-control"
                               placeholder="Event Type ..."
                               style="width: 250px;">
                        <span class="input-group-btn">
                            <button v-show="!edit" type="submit" class="btn btn-primary">Add</button>
                            <button v-show="edit" type="submit" class="btn btn-success">Save</button>
                            <button v-show="edit" @click="cancelUpdateEventType()" type="button" class="btn btn-danger">Cancel</button>
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
                eventTypesList: [],
                eventType: {
                    id: '',
                    event_type: ''
                }
            }
        },
        mounted() {
            this.fetchEventTypesList();
        },

        methods: {
            fetchEventTypesList: function() {
                axios.get('/api/settings/event-types').then(response => this.eventTypesList = response.data);
            },

            createEventType: function () {
                axios.post('/api/settings/event-types', {
                    event_type: this.eventType.event_type
                }).then(function () {
                    this.eventType.event_type = '';
                    this.edit = false;
                    this.fetchEventTypesList();
                }.bind(this));
            },

            updateEventType: function(id) {
                axios.patch('/api/settings/event-types/' + id, {
                    id: this.eventType.id,
                    event_type: this.eventType.event_type
                }).then(function () {
                    this.eventType.event_type = '';
                    this.edit = false;
                    this.fetchEventTypesList();
                }.bind(this));

            },

            cancelUpdateEventType: function() {
                this.eventType.event_type = '';
                this.edit = false;
                this.fetchEventTypesList();
            },

            showEventType: function(id) {
                this.$http.get('/api/settings/event-types/' + id).then(response => this.eventType = response.data);
                this.edit = true;
            },

            deleteEventType: function (id) {
                axios.delete('/api/settings/event-types/' + id).then(function () {
                    this.fetchEventTypesList();
                }.bind(this));
            },

            unDeleteEventType: function(id){
                axios.patch('/api/settings/event-types/' + id + '/restore', {
                    id: this.eventType.id,
                    event_type: this.eventType.event_type
                }).then(function () {
                    this.eventType.event_type = '';
                    this.edit = false;
                    this.fetchEventTypesList();
                }.bind(this));
            }
        }
    }
</script>