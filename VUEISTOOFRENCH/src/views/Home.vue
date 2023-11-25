<template>
  <v-row>
    <v-col>
      <account-form />
    </v-col>
    <v-col>
      <deal-form />
    </v-col>
  </v-row>
</template>

<script lang="ts" setup>
  import HelloWorld from '@/components/HelloWorld.vue'
  import AccountForm from "@/components/AccountForm.vue";
  import DealForm from "@/components/DealForm.vue";
</script>
