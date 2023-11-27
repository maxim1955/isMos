<template>
  <q-dialog
      :model-value="showModal"
      full-width
  >
    <q-card class="column">
      <slot name="titleModal"></slot>
      <q-card-section>
        <div class="wrapper">
          <div class="flex items-center q-pt-lg">
            <div class="recall_input flex ">
              <q-input
                  name="phone"
                  type="text"
                  class="q-pr-sm"
                  label="Ваше имя *"
                  clearable
                  v-model="form_name"
              />
              <q-input
                  name="phone"
                  type="tel"
                  mask="+7 (###) ### - ## - ##"
                  label="Ваше номер *"
                  clearable
                  v-model="form_phone"
              />
            </div>
            <div class="sendInfo q-pl-lg">
              <slot name="btn">

              </slot>
            </div>
          </div>
          <div class="accept_policy flex">
            <div class="">
              <p>
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

const props = defineProps({
  showModal: {
    type: Boolean,
    required: true
  }
})
const check_toggle = ref(false);
const form_phone = ref("");
const form_name = ref(String());
</script>


<style scoped>
.recall_input {
}
</style>
