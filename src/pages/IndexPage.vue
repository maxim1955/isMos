<template>
  <q-page>
    <ModalCheckMeter :show-modal="showSearchResultModal" @change-modal="showSearchResultModal = false"></ModalCheckMeter>
    <div class=" bg-primary q-pt-lg">
      <section class="q-pt-lg  flex justify-between wrapper">
        <q-img src="~src/assets/icon/logo.svg" style="max-height: 50px; max-width: 190px;"/>
        <div class="">
          <a href="https://yandex.ru/maps/org/inzhenernaya_sluzhba/220131617799/?ll=37.704566%2C55.809019&z=16"/>
          <q-img src="~src/assets/icon/yarating48.png"
                 style="max-height: 50px; max-width: 150px; width: 50vw;  border-radius: 4px "/>
        </div>
      </section>
      <section class="is_info">
        <div class="wrapper">
          <div class="bg-meter flex column">
            <div class="text-white" style="max-width: 650px">
              <h1 style=" font-size: 48px;">Официальная поверка водосчётчиков в Москве и МО</h1>
            </div>
            <div class="">
              <ul>
                <li style="font-size: 14pt" class="text-white">Госаккредитация № RA.RU.314330</li>
                <li style="font-size: 14pt" class="text-white">Методика поверки «МИ 1592-2015»</li>
                <li style="font-size: 14pt" class="text-white">Внесение результатов в ФГИС «Аршин» при Вас</li>
              </ul>
            </div>
            <p style="font-size: 30px; max-width: 400px" class="text-white">
              При заказе через сайт
              цена - <span class="" style="color: #ffff00">500 рублей</span> за 1 прибор
            </p>
          </div>
        </div>
      </section>
      <section class="is_recall bg-white">
        <re-call/>
      </section>
      <section class="q-pt-lg">
        <div class="plus_company bg-primary wrapper flex justify-between">
          <div class="official_item flex">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title">Официально</p>
              <p>ГОС Аккредитация, показания передаются во ФГИС "АРШИН"</p>
            </div>
          </div>
          <div class="item_fast flex q-pl-lg">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title">Быстро</p>
              <p>Выезд в течение 24 часов. Оперативная работа инженера-метролога </p>
            </div>
          </div>
          <div class="item_Available flex q-pl-lg">
            <q-img src="src/assets/icon/official.webp" width="70px" height="70px" class="q-px-lg"/>
            <div class="item_text flex column q-pl-lg">
              <p class="item_title">Доступно</p>
              <p>Социально ориентированная компания, льготные цены</p>
            </div>
          </div>
        </div>
      </section>
      <section class="q-pt-lg bg-white">
        <div class="wrapper">
          <h2 class="text-center">Осуществляем поверку счетчиков воды во всех округах Москвы</h2>
          <div class="flex justify-center items-center content-center  wrap">
            <div class="q-pb-lg flex justify-center wrap"
                 v-for="dist of districtMoscow"
                 style=" width: 16.6%">
              <q-btn class="dist_btn" style="width: 100%; max-width: 150px">{{ dist.name }}</q-btn>
            </div>
          </div>
          <h4>Так же работаем в городах Московской области: Балашиха, Люберцы, Красногорск, Мытищи, Реутов, Королев,
            Одинцово, Химки
          </h4>
        </div>
        <div class="modalBtn flex justify-center q-pb-lg">
          <modal_contact-map :open-map="showMap"/>
          <modal-recall :show-modal="showRecallModal">
            <template #titleModal>
              <h2>
                Заказать со скидкой
              </h2>
            </template>
            <template #btn>
              <q-btn label="Заказать поверку" class="bg-red-6" color="white"/>
            </template>
          </modal-recall>
          <button @click="showMap = !showMap" class="q-mr-md"
                  style="background: white; color: black ; font-size: 15px; padding: 10px 25px; border-radius: 5px">
            Контактные данные
          </button>
          <button @click="showRecallModal = !showRecallModal"
                  style="background: #C10015; color: white ; font-size: 15px; padding: 10px 25px; border-radius: 5px"
          >Заказать со скидкой
          </button>
        </div>
      </section>
      <section>
        <div class="test_result flex justify-center column items-center">
          <h2 class="text-center">Уже сделали поверку?</h2>
          <button class="btn_search_result" @click="showSearchResultModal = !showSearchResultModal">
            Проверить результат
            <i class="fas fa-search uk-margin-small-left"></i>
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
  background: blue;
  border-radius: 12px;

}

.btn_search_result {
  padding: 10px 30px;
  max-width: 250px;
  border-radius: 12px;
  background: #1976D2;
  border: 1px solid white;
  font-size: 15px;
  font-weight: bold;
  color: white;
}

.btn_search_result:hover {
  background: white;
  color: black;
}

.test_result {
  padding: 70px 0;
}

@media (max-width: 1240px) {
  .bg-meter {
    background: none;
    align-items: center;
    text-align: center;
  }
}
</style>
