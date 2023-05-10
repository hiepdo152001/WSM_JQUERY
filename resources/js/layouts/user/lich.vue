<template>
    <div>
      <FullCalendar :options="options" @dateClick="addEvent"/>
      
    </div>
  </template>
  
  <script>
  import { ref } from 'vue'
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import listGridPlugin from '@fullcalendar/list'
  import interactionGridPlugin from '@fullcalendar/interaction'
  
  export default {
    components: {
      FullCalendar
    },
    setup() {
      const id = ref(10)
  
      const options = {
        plugins: [dayGridPlugin, timeGridPlugin, listGridPlugin, interactionGridPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'title',
          center: '',
          right: ' dayGridMonth,listDay'
        },
        editable: true,
        selectable: true,
        weekends: true,
        select: (arg) => {
          id.value = id.value + 1
          const cal = arg.view.calendar
          cal.unselect()
          cal.addEvent({
            id: `${id.value}`,
            title: `New Event ${id.value}`,
            start: arg.start,
            end: arg.end,
            allDay: true
          })
        },
      };
        const calendarRef = ref(null)
        const events = ref([
            {
            title: 'Event 1',
            start: '2022-05-15',
            end: '2022-05-16',
            },
        ])

        const addEvent = (info) => {
            const date = info.date
            const dayOfWeek = date.getDay()

            // Kiểm tra ngày là thứ 7 hoặc chủ nhật
            if (dayOfWeek === 6 || dayOfWeek === 0) {
            const calendarApi = calendarRef.value.getApi()

            // Thêm sự kiện vào calendar
            calendarApi.addEvent({
                title: 'New Event',
                start: date,
                end: date,
            })
            }
        }
      return {
        options,
        calendarRef,
        events,
        addEvent,
      }
    }
  }
  </script>
  