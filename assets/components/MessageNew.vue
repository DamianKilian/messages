<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add message
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="messageNewSubmit" @submit="messageNewSubmit">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">New message</label>
                                <textarea name="message[message]" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    name: "MessageNew",
    methods: {
        messageNewSubmit(e) {
            e.preventDefault();
            var that = this;
            let myForm = document.getElementById('messageNewSubmit');
            let formData = new FormData(myForm);
            axios.post('/new', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(function (response) {
                    that.$emit('newMessageAdded', response.data.messages)
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }
}
</script>