<template>
  <v-modal_quit
      :showModal="openExitModal"
      v-if="openExitModal"
      @hideModal="openExitModal = false"
      v-model="quitModal"
      :position="'top'"/>
  <modal-recall
      :quit_modal="false"
      :order="false"
      :recall="true"
      :show-modal="showReCallModal"
      @reCallback="sendFormToCall"
      @hide="showReCallModal = false">
    <template #titleModal>
      <h2 class="modalReCall_title text-center">Обратный звонок</h2>
    </template>
    <template #btn>
      <span class="bg-red-6">Заказать звонок</span>
    </template>
  </modal-recall>
  <modal_policy :check-toggle="openPolicy" @close_policy="openPolicy=false"/>
  <review_modal :open-modal="openReviews" @hide="openReviews=false"/>
  <q-layout view="hHh lpR fff" @mousemove="checkCoordinates($event)">
    <q-header elevated class=" bg-white" height-hint="100">
      <div class="wrapper text q-py-sm q-px-md flex justify-between items-center header_wrap column-xs">
        <div class="phone_group text-black">
          <div class="item_tel flex items-start column">
            <div class="flex q-pt-md">
              <q-icon name="call" class="q-pr-md  " size="20px"/>
              <a href="tel: 8(495)111-00-07" style="font-size: 16px; color: black" class="textRegular">
                8(495)111-00-07
              </a>
            </div>
            <p class="textRegular" style="font-size: 12px;">c 9:00 до 21:00</p>
          </div>
          <div class="item_time"></div>
        </div>
        <div class="">
          <q-btn label="Обратный звонок" class="btn_recall textRegular" @click="showReCallModal = !showReCallModal"
                 style="font-size: 14px;"
          />
        </div>
      </div>
    </q-header>
    <q-page-container class="page-container" style="padding-top: 0;" >
      <router-view/>
    </q-page-container>
    <q-footer elevated class="text-white footer_bg textRegular footer q-py-lg ">
      <div class="">
        <div class="modal_reviews" :class="[openReviews ? 'openModal' : 'closeReviews']">
          <review_modal/>
          <div class="flex items-center btn_reviews_group">
            <q-btn class="reviews_btn" @click="openReviews = !openReviews" v-if="openReviews">
              <svg width="25" height="25" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(90deg)" >
                <path d="M175 419L338 256L175 93" stroke="black" stroke-width="24" stroke-linecap="round"   />
              </svg>
            </q-btn>
            <q-btn class="reviews_btn reviews_btn_open"  label="Отзывы" @click="openReviews = !openReviews" v-if="!openReviews"/>
          </div>
        </div>
      </div>
      <div class="footer flex justify-around">
        <div class="footer_copy">
          <p>ИНН 7718948309</p>
          <p>ООО "Инженерная Служба" © 2013-2023</p>
          <a href="#" class="text-white" @click="openPolicy = true">Политика конфиденциальности</a>
        </div>
        <div class="footer_social textRegular ">
          <p>
            Госаккредитация №<span class="text-white">RA.RU.314330</span> <a
              href="https://poverka.fsa.gov.ru/?arrFilter_ff%5BNAME%5D=%D0%B8%D0%BD%D0%B6%D0%B5%D0%BD%D0%B5%D1%80%D0%BD%D0%B0%D1%8F+%D1%81%D0%BB%D1%83%D0%B6%D0%B1%D0%B0&arrFilter_pf%5BREGISTRY_NUMBER_TEXT%5D=&arrFilter_pf%5BINN%5D=&arrFilter_pf%5BADDRESS%5D=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C&set_filter=Y"
              class="text-white">проверить</a>
          </p>
          <p>«Федеральная Служба по Аккредитации»</p>
          <p>Служба контроля качества <span class="text-white">director@is-mos.ru</span></p>
          <p class="text-white textBold">Мы в социальных сетях</p>
          <div class="footer_links">
            <a href="https://dzen.ru/ismos" class="">
              <q-img src="~src/assets/icon/dzen.webp" width="40px" height="40px" class="q-pr-md" loading="lazy"/>
            </a>
            <a href="https://ok.ru/inzhenernayaslujba" class="q-pl-md">
              <q-img src="~src/assets/icon/ok.webp" width="40px" height="40px" class="q-pr-md" loading="lazy"/>
            </a>
            <a href="https://vk.com/is_mos" class="q-pl-md">
              <q-img src="~src/assets/icon/vk.webp" width="40px" height="40px"  loading="lazy"/>
            </a>
          </div>
        </div>
      </div>
    </q-footer>
  </q-layout>
</template>

<script setup>
import {defineComponent, ref} from 'vue'
import ModalRecall from "components/modalRecall.vue";
import Modal_policy from "components/modal_policy.vue";
import axios from "axios";
import {useQuasar} from "quasar";
import VModal_quit from "components/v-modal_quit.vue";
import Review_modal from "components/review_modal.vue";

const $q = useQuasar()

/* Модальные окна */
const openPolicy = ref(false)
const showReCallModal = ref(false)
let quitModal = ref(false)
let openExitModal = ref(false)
let openReviews = ref(false)
/*-----------------Функция получения последнего ID  -----------------------------*/

let lastId
let count
const getLastId = async () => {
  let next_id = await axios.get('https://sale.ismos.isp.sprint.1t.ru/assets/getInfo.php')
  let id = await next_id.data
  lastId = await id.split('}')
  count = lastId.length - 1
}

/* ---------------- Отправка формы на обратный звонок ----------------------------*/
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
      document.cookie = "Call=true ; path=/index.html ; max-age=86400"
      let seconds = 3
      $q.loading.hide()
      showReCallModal.value = false
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


/* -------------------------------------- Функция отслеживания  ухода пользователя ----------------------------------*/
const checkCoordinates = (event) => {
  if (event.clientY <= 15) {
    quitWindow()
  } else {
    return
  }
}

const quitWindow = (val) => {
  //Проверяем наличие куки....
  const getCookie = document.cookie
  let cookie = getCookie.split('=')
  if (!cookie.includes('Call')) {
    console.log('ДОЛЖНА ОТКРЫТЬСЯ МОДАЛКА')
    quitModal.value = true
    openExitModal.value = true
    document.cookie = "Call=true ; path=/index.html  ; max-age=86400"
  } else
    console.log('КУКИ ЕСТЬ!!!!')
  closeQuitModal()
}
let closeQuitModal = () => {
  openExitModal.value
}
</script>
<style>

@font-face {
  font-display: swap;
  font-family: RubikRegular;
  src: url("assets/fonts/Rubik-Regular.ttf")
}

@font-face {
  font-display: swap;
  font-family: RubikBold;
  src: url("assets/fonts/Rubik-Bold.ttf")
}

.wrapper {
  margin: 0 auto;
  max-width: 1280px;
  padding: 0 16px
}

.textRegular {
  font-family: RubikRegular;
}

.textBold {
  font-family: RubikBold;
}

.btn_recall {
  background: red;
  color: white;
  width: 100%;
  height: 40px;
}
.btn_reviews_group{
  margin-left: -3$;
}
.blue_bg {
  background: #294c92;
}

.footer_bg {
  background: rgb(53, 89, 162)
}

.footer {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.7)
}

.fixed {
  position: fixed;
  bottom: 4%;
  transition: transform 2s;
}

.openModal {
  transform: translateX(69%);
  transition: transform 2s;
}

.reviews_btn {
  color: black;
  z-index: 1;
  transform: rotate(90deg);
  box-shadow: none!important;

}
.q-btn:before {
  box-shadow: none!important;
}
.closeReviews {
  transform: translateX(-26%);
  transition: transform 2s;
}

.closeReviews:after {
  transition-property: left;
  transition-duration: 3s;
}

.svg_yandex {
  display: flex;
  height: 46%;
  align-items: center;
  border-radius: 10px;
  justify-content: flex-end;
  max-width: 32%;
}

.modal_reviews {
  display: flex;
  align-items: center;
  margin: 1px;
  height: 167px;
  position: fixed;
  bottom: 1%;
  left: calc(0vw - 1rem);
}
.reviews_btn_open{
  background: white;
  border-radius: 10px;
}
</style>
