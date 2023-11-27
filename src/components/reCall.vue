<template>
  <modal_policy
      :check-toggle="check_toggle"
      @close_policy="check_toggle = false"
  />
  <div class="wrapper">
    <div class="flex items-center q-pt-lg">
      <div class="recall_input flex ">
        <q-input
            name="phone"
            type="text"
            class="q-pr-sm"
            label="Ваше имя *"
            clearable
            v-model="form_name"
        />
        <q-input
            name="phone"
            type="tel"
            mask="+7 (###) ### - ## - ##"
            label="Ваше номер *"
            clearable
            v-model="form_phone"
        />
      </div>
      <div class="sendInfo q-pl-lg">
        <q-btn label="Заказать проверку" class="bg-red-6" color="white"/>
      </div>
      <div class="flex column items-center" style="width: 50%">
        <div class=" flex">
          <q-icon name="call" class="q-pr-md" size="20px"/>
          <p>
            8(495)111-00-07
          </p>
        </div>
        <p>Бесплатная консультация</p>
      </div>
    </div>
    <div class="accept_policy flex">
      <div class="">
        <p>
          Отправляя форму, я даю свое согласие на обработку
          <span style="text-decoration: underline; cursor: pointer ; color: blue" @click="check_toggle = !check_toggle">
          персональных данных
        </span>
        </p>

      </div>
    </div>
  </div>

</template>


<script setup>
import {ref} from "vue";
import Modal_policy from "components/modal_policy.vue";

const check_toggle = ref(false);
const form_phone = ref("");
const form_name = ref(String());
</script>


<style scoped>
.recall_input {
}
</style>
