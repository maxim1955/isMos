<template>
  <modal_policy
      :check-toggle="check_toggle"
      @hide="check_toggle = false"
  />
  <div class="wrapper ">
    <div class="flex items-center q-pt-lg justify-center adapt_screen">
      <div class="recall_input flex ">
        <q-input
            name="phone"
            type="text"
            class="q-pr-sm textRegular"
            label="Ваше имя *"
            v-model="form_name"
            style="color: #868686"
            :rules="[ (val,rules) => val.length >= 3 || 'Минимальное количество 3 знака!!', (val,rules) => regexpName.test(form_name) || 'Ввод только кириллица']"
        />
        <q-input
            name="phone"
            type="tel"
            mask="+7 (###) ### - ## - ##"
            label="Ваш номер *"
            v-model="form_phone"
            class="textRegular"
            style="color: #868686"
        />
      </div>
      <div class="sendInfo  q-ml-lg ">
        <q-btn :disable="!form_name.length || !form_phone.length" label="Заказать поверку" class="bg-red-6 textRegular" color="white" @click="sendToOrder"/>
      </div>
      <div class="flex column items-center textRegular justify-center recall_number" style="width: 48%">
        <div class=" flex justify center q-pt-ms recall_number">
          <q-icon name="call" class="q-pr-md" size="24px"/>
           <transition  name="bounce" enter-active-class="animate__animated animate__tada"
                       leave-active-class="animate__animated animate__bounceOutRight">
             <a href="tel: 8(495)111-00-07" style="font-size: 28px; padding: 0; margin: 0; color: black; text-decoration: none; "  >
               8(495)111-00-07
             </a>
           </transition>
        </div>
        <p style="font-size: 18px; padding: 0; margin: 0;">Бесплатная консультация</p>
      </div>
    </div>
    <div class="accept_policy flex">
      <div class="textRegular">
        <p style="color: #868686">
          Отправляя форму, я даю свое согласие на обработку
          <span style="text-decoration: underline; cursor: pointer ; color: blue"
                @click="check_toggle = !check_toggle">
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
const regexpName = /^[а-яА-ЯёЁ\s]/;
const emit = defineEmits(['sendFormToOrder'])
const check_toggle = ref(false);
let form_phone = ref("");
let form_name = ref("");
const sendToOrder= ()=>{
  emit('sendFormToOrder', {
    title: 'Заказ на поверку',
    id: 1,
    name: form_name,
    phone: form_phone,
  });
  form_phone.value = '';
  form_name.value = '';
}
</script>

