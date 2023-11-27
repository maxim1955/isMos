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
        <div class="">
          <q-input
              filled
              label="Введите заводской номер"
          >
            <template v-slot:append>
              <q-icon name="search"/>
            </template>
          </q-input>
        </div>
        <div class="result">
          <p>Проведенные поверки:</p>
        </div>
      </q-card-section>
      <q-separator/>
    </q-card>
  </q-dialog>
</template>

<script setup>
const props = defineProps({
  showModal: {
    type: Boolean,
  },
})
const emit = defineEmits(['changeModal'])


</script>


<style scoped>

</style>
