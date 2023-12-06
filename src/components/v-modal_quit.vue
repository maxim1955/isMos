<template>
  <q-dialog
    :model-value="showModal"
    persistent
    :maximized="maximizedToggle"
    transition-show="slide-up"
    transition-hide="slide-down"
    @hide="emit('hideModal',false)"
  >
    <q-card class="bg-primary text-white">
      <q-bar>
        <q-space />
        <q-btn dense flat icon="minimize" @click="maximizedToggle = false" :disable="!maximizedToggle">
          <q-tooltip v-if="maximizedToggle" class="bg-white text-primary">Minimize</q-tooltip>
        </q-btn>
        <q-btn dense flat icon="crop_square" @click="maximizedToggle = true" :disable="maximizedToggle">
          <q-tooltip v-if="!maximizedToggle" class="bg-white text-primary">Maximize</q-tooltip>
        </q-btn>
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>

      <q-card-section>
        <div class="text-h6">Alert</div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum repellendus sit voluptate voluptas eveniet porro. Rerum blanditiis perferendis totam, ea at omnis vel numquam exercitationem aut, natus minima, porro labore.
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script setup>
import {ref} from "vue";
const props = defineProps({
  showModal:{
    type: Boolean,
    required:true,
  }
})
const emit = defineEmits(['hideModal'])
/* ----------------------------------- Модальное оккно при уходе со страницы  ----------------------------------------*/
const maximizedToggle =ref(true)
const dialog = ref(false)
</script>

<style>
.exitBlock {
  display:none;
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  z-index:100000;
}
.exitBlock .fon {
  background: #F6FCFF;
  opacity:.8;
  position:fixed;
  width:100%;
  height:100%;
}
.exitBlock .modalText {
  box-sizing: border-box;
  padding:20px 40px;
  border: 2px solid #AEAEAE;
  background: #F6FCFF;
  position:fixed;
  top:80px;
  left:50%;
  margin-left:-30%;
  width:60%;
  box-shadow: 0 4px 10px 2px rgba(0,0,0,0.5);
}
.closeBlock {
  cursor:pointer;
  position: fixed;
  line-height:60px;
  font-size:82px;
  transform: rotate(45deg);
  text-align:center;
  top:20px;
  right:30px;
  color: #337AB7;
}
.closeBlock:hover {
  color: #000;
}
</style>
