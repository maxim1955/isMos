<template>
  <div class="modal_wrap">
    <modal-recall
        :persistent="true"
        :quit_modal="true"
        :order="false"
        :recall="false"
        :position="position"
        :show-modal="showModal"
        @reCallback="sendFormToCall"
        @hide="emit('hideModal',false)">
      <template #titleModal>
        <p class="text-center modal_title">Здравствуйте! Хотите мы перезвоним Вам за 25 секунд и ответим на интересующие
          вопросы?</p>
      </template>
      <template #btn>
        <span class="bg-red-6">Заказать звонок</span>
      </template>
      <template #closeBTN>
        <q-card-actions align="right" class="bg-white text-red">
          <q-btn flat label="X" v-close-popup/>
        </q-card-actions>
      </template>
    </modal-recall>
  </div>
</template>

<script setup>
import {ref} from "vue";
import Modal_policy from "components/modal_policy.vue";
import ModalRecall from "components/modalRecall.vue";
import axios from "axios";
import {useQuasar} from "quasar";
const props = defineProps({
  showModal: {
    type: Boolean,
    required: true,
  },
  position: {
    type: String,
    required: false
  }
})
const checkBox = ref(false)
const emit = defineEmits(['hideModal'])
const $q = useQuasar()
let check_toggle = ref(false);
const openPolicy = ref(false)
const showReCallModal = ref(false)

/* ----------------------------------- Модальное окно при уходе со страницы  ----------------------------------------*/
const maximizedToggle = ref(true)
const dialog = ref(false)
const regexpName = /^[?!,.а-яА-ЯёЁ\s]/;
let lastId;
let count

/* ---------------- Отправка формы c окна выхода ----------------------------*/
const getLastId = async () => {
  let next_id = await axios.get('https://sale.ismos.isp.sprint.1t.ru/assets/getInfo.php')
  let id = await next_id.data
  lastId = await id.split('}')
  count = lastId.length - 1
}
const sendFormToCall = async (data) => {
  try {
    $q.loading.show({
      message: 'Ваша заявка <b>process</b> в процессе <br/><span class="text-amber text-italic">Пожалуйста подождите....</span>',
      html: true
    })

    await getLastId()
    let result = JSON.stringify({
      title: 'Обратный звонок',
      id: count,
      name: data.name.value,
      phone: data.phone.value,
    })

    let res = await axios.post("https://sale.ismos.isp.sprint.1t.ru/assets/telegramRequest.php", result)
    if (res.status === 200) {
      emit('hideModal', false)
      document.cookie = "Call=true ; path=/index.html ; max-age=86400"
      let seconds = 3
      $q.loading.hide()
      const dialog = $q.dialog({
        title: 'Alert',
        message: `Ваша заявка принята, ожидайте звонка! `,
        position: 'bottom'
      })
      const timer = setInterval(() => {
        seconds--
        if (seconds > 0) {
        } else {
          clearInterval(timer)
          dialog.hide()
        }
      }, 1000)
    } else {
      console.log('Error')
    }
  } catch (e) {
    console.log(e)
  }
}
</script>

<style scoped>
.exitBlock {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: 100000;
}

.exitBlock .fon {
  background: #F6FCFF;
  opacity: .8;
  position: fixed;
  width: 100%;
  height: 100%;
}

.exitBlock .modalText {
  box-sizing: border-box;
  padding: 20px 40px;
  border: 2px solid #AEAEAE;
  background: #F6FCFF;
  position: fixed;
  top: 80px;
  left: 50%;
  margin-left: -30%;
  width: 60%;
  box-shadow: 0 4px 10px 2px rgba(0, 0, 0, 0.5);
}

.closeBlock {
  cursor: pointer;
  position: fixed;
  line-height: 60px;
  font-size: 82px;
  transform: rotate(45deg);
  text-align: center;
  top: 20px;
  right: 30px;
  color: #337AB7;
}

.closeBlock:hover {
  color: #000;
}

.bg_modal {
  background: url("src/assets/icon/bg_modal.jpg") !important;
  background-size: contain !important;
}

.modal_wrap {
  width: 100px !important;
  padding: 0 10px;
}

.modal_title {
  font-size: 20px;
  max-width: 55%;
  margin: 0 auto;
}
</style>

