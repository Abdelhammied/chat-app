<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="messages-box">
          <ul class="list-group">
            <li
              class="list-group-item"
              v-for="message in messages"
              :key="message.id"
              :class="[message.sender_id == authUserId ? 'sender-class' : '']"
            >{{ message.message }}</li>
          </ul>
          <div class="form-group my-3">
            <input
              type="text"
              class="form-control"
              placeholder="Enter Message"
              v-model="new_message"
            />
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-success" @click="sendNewMessage">Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [],
      new_message: ""
    };
  },
  props: ["chatroomId", "authUserId"],
  created() {
    this.fetchRoomMessage();
  },
  methods: {
    fetchRoomMessage() {
      axios
        .get("/chatroom_" + this.chatroomId)
        .then(({ data }) => {
          this.messages = data.data.chat_room_messages;
        })
        .catch(err => {
          console.log(err);
        });
    },
    sendNewMessage() {
      if (this.new_message != "" && this.new_message != null) {
        axios
          .post("/send_message/" + this.chatroomId, {
            message: this.new_message
          })
          .then(response => {
            this.new_message = "";
          })
          .catch(err => {
            console.log(err);
          });
      }
    }
  },
  mounted() {
    Echo.private("new-message-for-room-" + this.chatroomId).listen(
      "NewMessageWasSent",
      e => {
        this.messages.push({
          message: e.new_message,
          sender_id: this.authUserId
        });
      }
    );
  }
};
</script>

<style>
#messages-box {
  background: goldenrod;
  padding: 25px;
  border-radius: 3px;
}

.sender-class {
  background: #ccc;
  text-align: right;
}
</style>
