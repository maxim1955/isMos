<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class=" bg-white text q-py-sm q-px-md flex justify-around items-center " height-hint="100">
      <div class="phone_group text-black">
        <div class="item_tel flex items-start column">
          <div class="flex">
            <q-icon name="call" class="q-pr-md" size="20px"/>
            <p>
              8(495)111-00-07
            </p>
          </div>
          <p class="">c 9:00 до 21:00</p>
        </div>
        <div class="item_time"></div>
      </div>
      <div class="">
        <q-btn label="Обратный звонок" class="btn_recall"/>
      </div>


    </q-header>

    <q-page-container>
      <router-view/>
    </q-page-container>

    <q-footer elevated class="text-white bg-primary ">
      <div class="footer flex justify-around">
        <div class="footer_copy">
          <p>ИНН 7718948309</p>
          <p>ООО "Инженерная Служба" © 2013-2023</p>
          <a href="">Политика конфиденциальности</a>
        </div>

        <div class="footer_social">
          <p>Госаккредитация № RA.RU.314330 <a href="#">проверить</a></p>
          <p>«Федеральная Служба по Аккредитации»</p>
          <p>Служба контроля качества director@is-mos.ru</p>
          <div class="footer_links">
            <a href="#">
              <q-img src="~src/assets/icon/dzen.webp" width="40px" height="40px"/>
              <q-img src="~src/assets/icon/ok.webp" width="40px" height="40px"/>
              <q-img src="~src/assets/icon/vk.webp" width="40px" height="40px"/>
            </a>
          </div>
        </div>
      </div>
    </q-footer>

  </q-layout>
</template>

<script>
import {defineComponent, ref} from 'vue'

const leftDrawerOpen = ref(false)
const toggleLeftDrawer = () => {
  leftDrawerOpen.value = !leftDrawerOpen.value
}


</script>
<style scoped>
.btn_recall {
  background: red;
  color: white;
  width: 100%;
  height: 40px;
}
</style>
