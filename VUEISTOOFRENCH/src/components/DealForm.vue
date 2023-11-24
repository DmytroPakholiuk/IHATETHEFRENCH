<template>
  <div>
    <h2>Deals Form</h2>
    <v-form>
      <v-text-field
        name="name"
        label="Deal Name"
        :rules="inputRules.nameRules"
        v-model="inputData.name"
      />
<!--      <v-text-field-->
<!--        name="stage"-->
<!--        label="Deal Stage"-->
<!--        :rules="inputRules.stageRules"-->
<!--        v-model="inputData.stage"-->
<!--      />-->

      <v-select
        name="stage"
        label="Deal Stage"
        :items="availableStageVariants"
        v-model="inputData.stage"
      />
<!--      <v-text-field-->
<!--        name="account_name"-->
<!--        label="Account Name"-->
<!--        :rules="inputRules.accountNameRules"-->
<!--        v-model="inputData.accountName"-->
<!--      />-->
      <v-autocomplete
        name="account_name"
        id="account_name"
        label="Account Name"
        :rules="inputRules.accountNameRules"
        :items="accountVariants"
        @input="fetchAccounts"
        v-model="inputData.accountName"
      />
      <v-text-field
        name="closing_date"
        label="Closing Date"
        type="date"
        :rules="inputRules.closingDateRules"
        v-model="inputData.closingDate"
      />
<!--      <v-date-picker-->
<!--        v-model="inputData.closingDate"-->
<!--      />-->
      <v-btn @click="sendData()" text="Submit"/>
    </v-form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "DealForm",
  // mounted() {
  //   axios.post("http://127.0.0.1:8000/api/deals").then(resp => {
  //     console.log(resp)
  //     alert(resp.data.message)
  //   })
  // }

  data: () => ({
    inputData: {
      name: "",
      stage: "Qualification",
      accountName: "",
      closingDate: "",
    },
    inputRules: {
      nameRules: [
        value => {
          if (value) return true

          return 'Deal Name is required.'
        },
      ],
      stageRules: [

      ],
      accountNameRules: [
        value => {
          if (value) return true

          return 'Account Name is required.'
        },
        // value => {
          // if (this.accountVariants.includes(value)) return true
          //
          // return 'Account Name should correspond to an actual account.'
        // },
      ],
      closingDateRules: [
        value => {
          if (value) return true

          return 'Closing Date is required.'
        },
      ],
    },
    availableStageVariants: [
      "Qualification",
      "Needs Analysis",
      "Value Proposition",
      "Identify Decision Makers",
      "Proposal/Price Quote",
      "Negotiation/Review",
      "Closed Won",
      "Closed Lost",
      "Closed Lost to Competition"
    ],
    accountVariants: [],
  }),

  methods: {
    sendData() {
      const data = {
        name: this.inputData.name,
        account_name: this.inputData.accountName,
        stage: this.inputData.stage,
        closing_date: this.inputData.closingDate,
      };
      axios.post("http://127.0.0.1:8000/api/deals", data).then(resp => {
        console.log(resp)
        alert(resp.data.message)
      })
    },
    fetchAccounts() {
      axios.get("http://127.0.0.1:8000/api/accounts").then(resp => {
        this.accountVariants = resp.data.data
      })
    },
  },

  mounted() {
    this.fetchAccounts()
  }
}
</script>

<style scoped>

</style>
