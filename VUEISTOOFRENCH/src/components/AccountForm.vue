<template>
  <div>
    <h2>Account Form</h2>
    <v-form>
      <v-text-field
        name="name"
        label="Account Name"
        :rules="inputRules.nameRules"
        v-model="inputData.name"
      />
      <v-text-field
        name="phone"
        label="Account Phone"
        :rules="inputRules.phoneRules"
        v-model="inputData.phone"
      />
      <v-text-field
        name="website"
        label="Account Website"
        :rules="inputRules.websiteRules"
        v-model="inputData.website"
      />
      <v-btn @click="sendData()" text="Submit"/>
    </v-form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AccountForm",

  data: () => ({
    inputData: {
      name: "",
      phone: "",
      website: ""
    },
    inputRules: {
      nameRules: [
        value => {
          if (value) return true

          return 'Account Name is required.'
        }
      ],
      phoneRules: [
        value => {
          if (value) return true

          return 'Account Phone is required.'
        },
        value => {
          if (/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/.test(value)){
            return true;
          }

          return "Account Phone should be like 555-555-5555. Why? Because I said so"
        }
      ],
      websiteRules: [
        value => {
          if (value) return true

          return 'Account Website is required.'
        },
        value => {
          if (/^[a-zA-Z0-9-.]{2,}\.[a-zA-Z0-9-]{2,63}$/.test(value)){
            return true;
          }

          return "Account Website should be a website"
        }
      ],
    }
  }),

  methods: {
    sendData() {
      const data = this.inputData;
      axios.post("http://127.0.0.1:8000/api/deals", data).then(resp => {
        console.log(resp)
        alert(resp.data.message)
      })
    }
  }
}
</script>

<style scoped>

</style>
