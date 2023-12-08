<template>
  <q-dialog
      :model-value="showModal"
  >
  <q-card class="column q-px-md modal_wrap">
      <slot name="titleModal" class="modalReCall_title q-mx-xl"></slot>
      <q-card-section>
        <div class="wrapper">
          <div class="flex items-center q-pt-lg modalCall_wrap justify-center">
            <div class="recall_input flex">
              <form @submit="sendFormToCall" class="recall_input flex  "  >
                <q-input
                  type="text"
                  class="q-pr-sm"
                  label="Ваше имя *"
                  v-model="form_name"
                  @input="form_name"
                  name="name"
                  :rules="[ (val,rules) => val.length >= 3 || 'Минимальное количество 3 знака!!', (val,rules) => regexpName.test(form_name) || 'Ввод только кириллица']"
                />
                <q-input
                  type="tel"
                  mask="+7 (###)###-##-##"
                  label="Ваше номер *"
                  v-model="form_phone"
                  @input="form_phone"
                  name="phone"
                />
              </form>
            </div>
            <div class="q-py-lg q-px-xl-xl q-px-sm-none">
              <q-btn class="bg-red-6 " color="white" @click="emit('reCallback',info)" :disable="!form_name.length || !form_phone.length">
                <slot name="btn" class="sendInfo"></slot>
              </q-btn>
            </div>
          </div>
          <div class="accept_policy flex justify-center">
            <div class="">
              <p class="policyModal-text text-center q-pt-sm">
                Отправляя форму, я даю свое согласие на обработку
                <span style="text-decoration: underline; cursor: pointer ; color: blue"
                      @click="check_toggle = !check_toggle">
          персональных данных
        </span>
              </p>
              <modal_policy
                  :check-toggle="check_toggle"
              />
            </div>
          </div>
        </div>
      </q-card-section>
      <q-separator/>
    </q-card>
  </q-dialog>
</template>


<script setup>
import {ref} from "vue";
import Modal_policy from "components/modal_policy.vue";
import axios from "axios";
import {useQuasar} from "quasar";
const $q = useQuasar()


const props = defineProps({
  showModal: {
    type: Boolean,
    required: true
  }
})
let check_toggle = ref(false);
const form_phone = ref('');
const form_name = ref('');
const info = {
  name: form_name,
  phone: form_phone,
};

const regexpName = /^[?!,.а-яА-ЯёЁ\s]/;

const emit = defineEmits(['reCallback'])
const sendFormToCall =  async (data) => {
  try {
      $q.loading.show({
        message: 'Ваша заявка <b>process</b> в процессе <br/><span class="text-amber text-italic">Пожалуйста подождите....</span>',
        html: true
      })
      let res = await axios.post("http://stm/telegramRequest.php", {
          title: 'Обртный звонок',
          id: 1,
          name: data.name.value,
          phone: data.phone.value
        })
      if(res.status === 200){
        console.log('OK')
        $q.loading.hide()
        form_name.value = ''
        form_phone.value = ''
      }else {
        console.log('Error')
        alert('ERROR')
      }

      emit('reCallback',false)
  } catch (e) {
    console.log(e)
  }
}
</script>

