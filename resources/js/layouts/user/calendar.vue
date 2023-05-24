<template>
  <div>
    <div class="check-in-out" :class="{ 'd-none': off }">
      <button class="btn btn-danger btn-sm" v-if="showCheckOutButton" @click="options.customButtons.customButton.click">
       <i class="bi bi-box-arrow-right"></i> {{ options.customButtons.customButton.text }}
      </button>
      <button class="btn btn-danger btn-sm" v-else @click="options.customButtons.customButton2.click">
      <i class="bi bi-box-arrow-right"></i>  {{ options.customButtons.customButton2.text }}
      </button>
    </div>
    <FullCalendar :options="options" ref="calendarRef" />
    
  </div>
</template>
<style>
.fc-toolbar-chunk{
  position: relative;
}
.check-in-out{
  position: absolute;
    margin-left: 74%;
    top: 8%;
}
</style>
<script>
import { ref,onMounted} from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listGridPlugin from '@fullcalendar/list';
import interactionGridPlugin from '@fullcalendar/interaction';
import ApiService from '../common/apiService';
import {
  APICREATETIMEKEEP, 
  APIUPDATETIMEKEEP,
  APIGETTIMEKEEP,
  HOMECALENDAR,
  APIGETTIMEKEEPBYDAY 
} from '../store/url';

export default {
  components: {
    FullCalendar,
  },
  //customButton,customButton2,dayGridMonth,listDay
  setup() {
    const calendarRef = ref(null);
    const checks = ref([]);
    const checkout = ref([]);
    const checkin = ref([]);
    const headers = ApiService.setHeader();
    const showCheckOutButton =ref(true);
    const off = ref(false)
    onMounted(async () => {
      const timeKeep= await ApiService.get(APIGETTIMEKEEP,{headers});
      const timeKeepToDay= await ApiService.get(APIGETTIMEKEEPBYDAY, {headers} )
      const dataKeys = Object.keys(timeKeepToDay.data);
      
      const calendarApi = calendarRef.value.getApi();

      timeKeep.data.forEach((event) => {
          ApiService.getTimeCheck(event, checks);
          checkin.value = checks.check_in;
          checkout.value=checks.check_out;
         
          const defaultEvent = {
          title:checkin.value + " " + checks.check_out ,
          start: event.created_at,
          end: event.updated_at,
          allDay: true,
        };
        calendarApi.addEvent(defaultEvent); 
        options.events = [defaultEvent];
        });

        if(timeKeep.data[timeKeep.data.length -1].time_in !==null){
          showCheckOutButton.value=false
        }

        if(timeKeep.data[timeKeep.data.length -1].time_in !==null && timeKeep.data[timeKeep.data.length -1].time_out !==null){
          off.value=true;
        }

        if (dataKeys.length === 0) {
          off.value=false;
          showCheckOutButton.value=true
        }
        
    });

    const options = {
      plugins: [dayGridPlugin, timeGridPlugin, listGridPlugin, interactionGridPlugin],
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'title',
        center: '',
      },
      editable: true,
      selectable: true,
      weekends: true,
      events: [],
      customButtons: {
        customButton: {
          text: 'Check-in',
          click: async function () {
            try {
              const res = await ApiService.get(APICREATETIMEKEEP, { headers });
              if(res.data.time_in !== null){
                window.location.href=HOMECALENDAR
              }
            } catch (error) {
            }
          },
        },
        customButton2: {
          text: 'Check-out',
          click: async function () {
            try {
              const res = await ApiService.get(APIUPDATETIMEKEEP, { headers });

              window.location.href=HOMECALENDAR
            } catch (error) {
            }
          },
        },
      },
    };
    return {
      options,
      calendarRef,
      showCheckOutButton,
      off
    };
  },
};
</script>
