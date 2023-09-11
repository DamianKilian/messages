<template>
    <div>
        <input type="checkbox" @change="sortByDate" /> sort by date
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Message</th>
                    <th scope="col">CreatedAt</th>
                    <th scope="col">UpdatedAt</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(message, index) in messages">
                    <td>{{ message.id }}</td>
                    <td>{{ message.message }}</td>
                    <td>{{ message.createdAt.date.split(' ')[0] }}</td>
                    <td>{{ message.updatedAt.date.split(' ')[0] }}</td>
                    <td><button type="button" class="btn btn-primary see" :data-id="message.id"
                            @click="seeMsg">Zobacz</button></td>
                </tr>
            </tbody>
        </table>
        <div class="modal" tabindex="-1" id="seeMsgModal">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">CreatedAt</th>
                                    <th scope="col">UpdatedAt</th>
                                </tr>
                            </thead>
                            <tbody v-if="message">
                                <tr>
                                    <td>{{ message.id }}</td>
                                    <td>{{ message.message }}</td>
                                    <td>{{ message.createdAt }}</td>
                                    <td>{{ message.updatedAt }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <MessageNew @newMessageAdded="newMessageAdded"/>
    </div>
</template>
  
<script>
import MessageNew from './MessageNew.vue'

export default {
    name: "MessageIndex",
    components: {
        MessageNew
    },
    props: ['messagesProp'],
    data() {
        return {
            error: '',
            messages: this.messagesProp,
            seeMsgModal: null,
            message: null,
        };
    },
    methods: {
        sortByDate(e) {
            e.preventDefault();
            var that = this;
            axios.post('/sortByDate', { sortByDate: e.target.checked })
                .then(function (response) {
                    if (response.data.success) {
                        that.messages = response.data.messages;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        seeMsg(e) {
            var that = this;
            axios.post('/' + e.target.dataset.id)
                .then(function (response) {
                    that.message = response.data;
                    that.seeMsgModal.show();
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        newMessageAdded(messages) {
            this.messages = messages;
        },
    },
    mounted() {
        this.seeMsgModal = new bootstrap.Modal('#seeMsgModal', {
            keyboard: false
        })
    },
}
</script>