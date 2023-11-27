<template>
  <q-dialog
      :model-value="openMap"
      full-width
  >
    <q-card class="column">
      <q-card-section>
        <div style="position:relative"><a
            href="https://yandex.ru/maps/org/inzhenernaya_sluzhba/220131617799/?utm_medium=mapframe&utm_source=maps"
            style="color:#eee;font-size:12px;position:absolute;top:0px;">Инженерная служба</a><a
            href="https://yandex.ru/maps/213/moscow/category/counters_and_metering_devices/184106834/?utm_medium=mapframe&utm_source=maps"
            style="color:#eee;font-size:12px;position:absolute;top:14px;">Счетчики и приборы учета в Москве</a><a
            href="https://yandex.ru/maps/213/moscow/category/plumbing_works/184107545/?utm_medium=mapframe&utm_source=maps"
            style="color:#eee;font-size:12px;position:absolute;top:28px;">Сантехнические работы в Москве</a>
          <iframe
              src="https://yandex.ru/map-widget/v1/org/inzhenernaya_sluzhba/220131617799/?from=mapframe&l=trf&ll=37.717124%2C55.844768&source=mapframe&utm_source=mapframe&z=11"
              width="100%" height="460" frameborder="1" allowfullscreen="true" style="position:relative;">
          </iframe>
        </div>
      </q-card-section>
      <q-separator/>
      <q-card-actions >
        <q-btn
            style
            color="red"
            label="Закрыть"
            v-close-popup
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script setup>
const props = defineProps({
  openMap: {
    type: Boolean,
    required: true
  }
})

</script>

