<template>
  <q-page>
    <ModalCheckMeter :show-modal="showSearchResultModal"
                     @hide="showSearchResultModal = false"></ModalCheckMeter>
    <modal_contact-map :open-map="showMap" @hide="showMap = false"/>

    <modal-recall  :show-modal="showRecallModal" @reCallback="sendFormToOrder" @hide="showRecallModal=false" class="text-center" style="margin: 0 auto;">
      <template #titleModal>
        <h2 class="modalReCall_title text-center">
          Заказать со скидкой
        </h2>
      </template>
      <template #btn>
              <span class="sendInfo">
                Заказать поверку
              </span>
      </template>
    </modal-recall>

    <div class="blue_bg q-pt-lg">
      <section class="q-pt-lg  flex justify-between wrapper">
        <q-img src="~src/assets/icon/logo.svg" style="max-height: 50px; max-width: 190px;" loading="lazy"
               class="logo_is"/>
        <div style="cursor: pointer">
          <a href="https://yandex.ru/maps/org/inzhenernaya_sluzhba/220131617799/?ll=37.704566%2C55.809019&z=16"
             target="_blank"
          >
            <q-img src="~src/assets/icon/yarating48.png"
                   style="max-height: 50px; max-width: 150px; width: 50vw;  border-radius: 4px "
                   loading="lazy"
                   class="yandex-rating"
            />
          </a>
        </div>
      </section>
      <section class="is_info">
        <div class="wrapper">
          <div class="bg-meter flex column">
            <div class="text-white textBold" style="max-width: 650px">
              <h1 style=" font-size: 48px; line-height: 52.8px">Официальная поверка водосчётчиков в Москве и МО</h1>
            </div>
            <div class="textRegular">
              <ul>
                <li style="font-size: 18px" class="text-white textRegular q-pb-sm">Госаккредитация <span> <a
                    target="_blank"
                    class="text-white"
                    href="https://poverka.fsa.gov.ru/?arrFilter_ff%5BNAME%5D=%D0%B8%D0%BD%D0%B6%D0%B5%D0%BD%D0%B5%D1%80%D0%BD%D0%B0%D1%8F+%D1%81%D0%BB%D1%83%D0%B6%D0%B1%D0%B0&arrFilter_pf%5BREGISTRY_NUMBER_TEXT%5D=&arrFilter_pf%5BINN%5D=&arrFilter_pf%5BADDRESS%5D=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C&set_filter=Y">№ RA.RU.314330</a> </span>
                </li>
                <li style="font-size: 18px" class="text-white textRegular q-pb-sm">Методика поверки «МИ 1592-2015»</li>
                <li style="font-size: 18px" class="text-white textRegular">Внесение результатов в ФГИС «Аршин» при Вас
                </li>
              </ul>
            </div>
            <p style="font-size: 30px; max-width: 420px" class="text-white">
              При заказе через сайт <br>
              цена - <span class="" style="color: #ffff00">500 рублей</span> за 1 прибор
            </p>
          </div>
        </div>
      </section>
      <section class="is_recall bg-white q-py-lg">
        <re-call @sendFormToOrder="sendFormToOrder"/>
      </section>
      <section class="q-pt-lg">
        <div class="plus_company bg_blue wrapper flex justify-between">
          <div class="official_item flex">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg" loading="lazy"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title textBold" style="font-size: 24px;">Официально</p>
              <p class="textRegular">ГОС Аккредитация, показания передаются во ФГИС "АРШИН"</p>
            </div>
          </div>
          <div class="item_fast flex q-pl-lg">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg" loading="lazy"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title textBold" style="font-size: 24px;">Быстро</p>
              <p class="textRegular">Выезд в течение 24 часов. Оперативная работа инженера-метролога </p>
            </div>
          </div>
          <div class="item_Available flex q-pl-lg">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg" loading="lazy"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title textBold" style="font-size: 24px;">Доступно</p>
              <p class="textRegular" style="font-size: 16px;">Социально ориентированная компания, льготные цены</p>
            </div>
          </div>
        </div>
      </section>
      <section class="q-pt-lg bg-white">
        <div class="wrapper">
          <h2 class=" textBold pages_title" style="font-size: 30px;">Осуществляем поверку счетчиков воды во всех округах
            Москвы</h2>
          <div class="flex justify-center items-center content-center  wrap pages_wrap">
            <div class="q-pb-lg flex justify-center wrap pages_item"
                 v-for="dist of districtMoscow"
                 style=" width: 16.6%">
              <q-btn class="dist_btn" style="width: 100%; max-width: 150px">{{ dist.name }}</q-btn>
            </div>
          </div>
          <h4 class="textBold" style="font-size: 20px;">Так же работаем в городах Московской области: Балашиха, Люберцы,
            Красногорск, Мытищи, Реутов, Королев,
            Одинцово, Химки
          </h4>
        </div>
        <div class="modalBtn flex justify-center q-pb-lg  ">
          <button @click="showMap = !showMap"
                  class=" textBold btn-hover">
            Контактные данные
          </button>
          <button @click=" showRecallModal=!showRecallModal"
                  class="textBold"
                  style="background: rgb(242, 61, 48); color: white ; font-size: 15px; padding: 10px 25px; border-radius: 5px; border: none"
          >Заказать со скидкой
          </button>
        </div>
      </section>
      <section>
        <div class="test_result flex justify-center column items-center">
          <h2 class="text-center textBold text-white" style="font-size: 30px;">Уже сделали поверку?</h2>
          <button class="btn_search_result" @click="showSearchResultModal = !showSearchResultModal">
            Проверить результат
            <i class="fa-solid fa-magnifying-glass q-pl-sm"></i>
          </button>
        </div>
      </section>
    </div>
  </q-page>
</template>

<script setup>
import ReCall from "components/reCall.vue";
import Modal_contactMap from "components/modal_contactMap.vue";
import {ref} from "vue";
import ModalRecall from "components/modalRecall.vue";
import ModalCheckMeter from "components/modalCheckMeter.vue";
import Modal_policy from "components/modal_policy.vue";
import instance from "app/server/instance";
import axios from "axios";
import {useQuasar} from "quasar";
const $q = useQuasar()


const showMap = ref(false);
const showRecallModal = ref(false);
const showSearchResultModal = ref(false);
const districtMoscow = [
  {name: "ВАО", code: "moscow"},
  {name: "ЗАО", code: "moscow"},
  {name: "ТАО", code: "moscow"},
  {name: "ЗелАО", code: "moscow"},
  {name: "НАО", code: "moscow"},
  {name: "САО", code: "moscow"},
  {name: "СВАО", code: "moscow"},
  {name: "СЗАО", code: "moscow"},
  {name: "ЦАО", code: "moscow"},
  {name: "ЮАО", code: "moscow"},
  {name: "ЮВАО", code: "moscow"},
  {name: "ЮЗАО", code: "moscow"},
]
const openPolicy = ref(false);
const sendFormToOrder = async (data) => {

  try {
    $q.loading.show({
      message: 'Ваша заявка <b>process</b> в процессе <br/><span class="text-amber text-italic">Пожалуйста подождите....</span>',
      html: true
    })
      let result = JSON.stringify({
        title: 'Заявка на поверку!',
        id: 1,
        name: data.name.value,
        phone: data.phone.value,
      })
      let res = await axios.post("http://stm/telegramRequest.php", result)
    if(res.status === 200){
      console.log('OK')
      $q.loading.hide()
    }else {
      console.log('Error')
      alert('ERROR')
    }
    showRecallModal.value = false
  } catch (e) {
    console.log(e)
  }
}
</script>
<style>
button {
  cursor: pointer;
}

.bg-meter {
  background: url("src/assets/icon/water-meter.webp") no-repeat 60%;
}

.item_text {
  max-width: 250px;
  color: white;
}

.item_title {
  color: #ffad4f;
  font-size: 24px;
}

.dist_btn {
  padding: 0 40px;
  font-size: 15px;
  color: white;
  background: #294c92;
  border-radius: 12px;

}

.btn_search_result {
  padding: 10px 30px;
  max-width: 250px;
  border-radius: 12px;
  background: #294c92;
  border: 1px solid white;
  font-size: 15px;
  font-weight: bold;
  color: white;
}

.btn_search_result:hover {
  background: white;
  color: black !important;
}


.btn-hover {
  background: white;
  color: black;
  font-size: 15px;
  padding: 10px 25px;
  border-radius: 5px
}

.btn-hover:hover {
  background: #294c92;
  color: white;
}

.test_result {
  padding: 70px 0;
}


</style>
