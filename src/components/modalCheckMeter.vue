<template>
  <q-dialog
      :model-value="showModal"
      @hide="emit('changeModal',false)"
      full-width
  >
    <q-card class="column">
      <q-card-section>
        <h3>Проверка счетчиков ИПУ онлайн</h3>
        <p>Узнайте, когда проводилась поверка ваших счетчиков и когда заканчивается межповерочный интервал,
          указав заводской номер в поле поиска</p>
        <div class="flex">
          <div class="">
            <q-input
                filled
                label="Введите заводской номер"
                v-model="meterInfo"
            >
              <template v-slot:append>
                <q-icon name="search"/>
              </template>
            </q-input>
          </div>
          <div class="sendResult">
            <q-btn
                color="primary"
                label="Поиск"
                @click="updateMeterInfo(meterInfo)"
                class="q-mt-md"
            />
          </div>
        </div>

        <div class="result">
          <p class="textBold text q-pt-md" style="font-size: 16px;">Проведенные поверки:</p>
          <q-list separator>
            <q-item v-for="(item, index) of resultMeter" :key="index">
              <div class="info_meter textRegular" style="font-size: 16px;">
                <p class="number_meter text-grey-5" style="font-size: 13px;">Счетчик: {{ item['mi.number'] }}</p>
                <p>{{ (item.verification_date).slice(0, -10) }} - {{ item.org_title }} - Поверка №
                  <a target="_blank" :href="`https://fgis.gost.ru/fundmetrology/cm/results/${item.vri_id}`"
                     class="text-bold text-blue">{{ item.vri_id }}
                    <i class="fa-solid fa-arrow-up-right-from-square q-pl-sm"></i></a>
                </p>
                <p>Следующая поверка
                  <span class="text-bold">{{
                      (item.valid_date) ? (item.valid_date).slice(0, -10) : (item.verification_date).slice(0, -10)
                    }}</span>
                </p>
              </div>
            </q-item>
          </q-list>
        </div>
      </q-card-section>
      <q-separator/>
    </q-card>
  </q-dialog>
</template>

<script setup>
import {ref} from "vue";
import axios from "axios";
import {useQuasar, QSpinnerFacebook, QSpinnerGears} from "quasar";
import {onBeforeUnmount} from 'vue'

const $q = useQuasar()
const props = defineProps({
  showModal: {
    type: Boolean,
  },
})
const meterInfo = ref('')


const updateMeterInfo = async (e) => {
  try {
    $q.loading.show({
      message: 'Запрос по вашему счетчику в процессе <br/><span class="text-amber text-italic">Пожалуйста подождите....</span>',
      html: true
    })
    let res = await axios.get(`https://fgis.gost.ru/fundmetrology/cm/xcdb/vri/select?fq=verification_year:2022&fq=mi.number:*${e}*&q=*&fl=vri_id,org_title,mi.mitnumber,mi.mititle,mi.mitype,mi.modification,mi.number,verification_date,valid_date,applicability,result_docnum,sticker_num&sort=verification_date+desc,org_title+asc&rows=10&start=0`, {})
    resultMeter.value = res.data.response.docs
    if (res.status === 200) {
      $q.loading.hide()
    } else {
      $q.loading.hide()
    }
  } catch (e) {
    console.log(e)
  }

}
const resultMeter = ref([])
const emit = defineEmits(['changeModal'])
</script>

