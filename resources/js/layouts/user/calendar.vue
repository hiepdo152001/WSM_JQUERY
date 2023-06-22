<template>
  <div class="panel">
    <div class="p-5">
      <div class="check-in-out" :class="{ 'd-none': off }">
        <button
          class="btn btn-danger btn-sm"
          v-if="showCheckOutButton"
          @click="options.customButtons.customButton.click"
        >
          <i class="bi bi-box-arrow-in-right"></i>
          {{ options.customButtons.customButton.text }}
        </button>
        <button
          class="btn btn-danger btn-sm"
          v-else
          @click="options.customButtons.customButton2.click"
        >
          <i class="bi bi-box-arrow-right"></i>
          {{ options.customButtons.customButton2.text }}
        </button>
      </div>
      <FullCalendar :options="options" ref="calendarRef" />
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listGridPlugin from "@fullcalendar/list";
import interactionGridPlugin from "@fullcalendar/interaction";
import ApiService from "../common/apiService";
import {
  API_CREATE_TIME_KEEP,
  API_UPDATE_TIME_KEEP,
  API_GET_TIME_KEEP,
  HOME_CALENDAR,
  API_GET_TIME_KEEP_BY_DAY,
  API_GET_NOT_WORK,
} from "../store/url";

export default {
  components: {
    FullCalendar,
  },

  setup() {
    const calendarRef = ref(null);
    const checks = ref([]);
    const color = ref([]);
    const headers = ApiService.setHeader();
    const showCheckOutButton = ref(true);
    const off = ref(false);
    const checkClick = ref([]);
    onMounted(async () => {
      const calendarApi = calendarRef.value.getApi();
      const currentDate = calendarApi.getDate();
      const timeKeep = await ApiService.get(API_GET_TIME_KEEP, { headers });
      const timeKeepToDay = await ApiService.get(API_GET_TIME_KEEP_BY_DAY, {
        headers,
      });
      const month = (currentDate.getMonth() + 1).toString().padStart(2, "0");

      const year = currentDate.getFullYear();

      checkClick.value.push(month);

      const notwork = await ApiService.getNotWork(
        API_GET_NOT_WORK,
        year,
        month,
        { headers }
      );

      const holiday = ApiService.holiday();
      Object.entries(holiday).forEach(([key, value]) => {
        const defaultEvent = {
          title: value,
          start: key,
          end: key,
          color: "#107066",
          allDay: true,
        };

        calendarApi.addEvent(defaultEvent);
        options.events = [defaultEvent];
      });

      notwork.data.forEach((event) => {
        if (!Object.keys(holiday).includes(event)) {
          const defaultEvent = {
            title: "K",
            start: event,
            end: event,
            color: "#fd3995",
            allDay: true,
          };

          calendarApi.addEvent(defaultEvent);
          options.events = [defaultEvent];
        }
      });

      timeKeep.data.forEach((event) => {
        ApiService.getTimeCheck(event, checks, color);
        if (event.time_in !== null) {
          const defaultEvent = {
            title: checks.check_in,
            start: event.created_at,
            end: event.updated_at,
            color: color.check_in,
            allDay: true,
          };

          calendarApi.addEvent(defaultEvent);
          options.events = [defaultEvent];
        }
        if (event.time_out !== null) {
          const defaultEventCheckOut = {
            title: checks.check_out,
            start: event.created_at,
            end: event.updated_at,
            color: color.check_out,
            allDay: true,
          };

          calendarApi.addEvent(defaultEventCheckOut);
          options.events = [defaultEventCheckOut];
        }

        checks.check_in = "";
        checks.check_out = "";
      });

      const dataKeys = Object.keys(timeKeepToDay.data);
      //set status button check-in check-out
      ApiService.checkButton(
        timeKeep,
        showCheckOutButton,
        off,
        holiday,
        dataKeys
      );
    });

    const options = {
      plugins: [
        dayGridPlugin,
        timeGridPlugin,
        listGridPlugin,
        interactionGridPlugin,
      ],

      initialView: "dayGridMonth",
      headerToolbar: {
        left: "title",
        center: "",
        right: "today prev,next",
      },

      weekends: true,
      firstDay: 1,

      events: [],

      customButtons: {
        customButton: {
          text: "Check-in",
          click: async function () {
            try {
              const res = await ApiService.postAuth(API_CREATE_TIME_KEEP, "", {
                headers,
              });
              if (res.data.time_in !== null) {
                const calendarApi = calendarRef.value.getApi();
                ApiService.getTimeCheck(res.data, checks, color);
                const defaultEvent = {
                  title: checks.check_in,
                  start: res.data.created_at,
                  end: res.data.updated_at,
                  color: color.check_in,
                  allDay: true,
                };

                calendarApi.addEvent(defaultEvent);
                options.events = [defaultEvent];
                showCheckOutButton.value = false;
              }
            } catch (error) {}
          },
        },

        customButton2: {
          text: "Check-out",
          click: async function () {
            try {
              if (confirm("Bạn muốn check-out ngay bây giờ ?")) {
                const res = await ApiService.checkOut(
                  API_UPDATE_TIME_KEEP,
                  "",
                  {
                    headers,
                  }
                );
                if (res.data.time_in !== null) {
                  const calendarApi = calendarRef.value.getApi();
                  ApiService.getTimeCheck(res.data, checks, color);
                  const defaultEvent = {
                    title: checks.check_out,
                    start: res.data.created_at,
                    end: res.data.updated_at,
                    color: color.check_in,
                    allDay: true,
                  };

                  calendarApi.addEvent(defaultEvent);
                  options.events = [defaultEvent];
                  off.value = true;
                }
              }
            } catch (error) {}
          },
        },

        prev: {
          click: async function () {
            const calendarApi = calendarRef.value.getApi();
            calendarApi.prev();
            const currentDate = calendarApi.getDate();

            const month = (currentDate.getMonth() + 1)
              .toString()
              .padStart(2, "0");

            const year = currentDate.getFullYear();

            const notwork = await ApiService.getNotWork(
              API_GET_NOT_WORK,
              year,
              month,
              { headers }
            );
            const holiday = ApiService.holiday();
            notwork.data.forEach((event) => {
              // month khong co trong checkClick
              if (
                !checkClick.value.includes(month) &&
                !Object.keys(holiday).includes(event)
              ) {
                const defaultEvent = {
                  title: "K",
                  start: event,
                  end: event,
                  color: "#fd3995",
                  allDay: true,
                };
                calendarApi.addEvent(defaultEvent);
                options.events = [defaultEvent];
              }
            });
            checkClick.value.push(month);
          },
        },
      },
    };
    return {
      options,
      calendarRef,
      showCheckOutButton,
      off,
      checkClick,
    };
  },
};
</script>

<style>
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.fc-event-title {
  font-weight: 600;
}
.fc .fc-scrollgrid-liquid {
  height: 85% !important;
}

.check-in-out {
  position: absolute;
  right: 25%;
}
.btn {
  padding: 7px 10px;
}
.fc-daygrid-day-events {
  display: flex;
  justify-content: center;
}
.fc-event-title {
  padding: 0px 8px !important;
}
.fc-day-sat {
  background-color: #ccbfdf;
}
.fc-day-sun {
  background-color: #ccbfdf;
}
.fc-daygrid-day-number {
  color: #7777;
  font-size: 18px;
  font-weight: 600;
}
.fc-col-header-cell {
  background-color: #886ab5;
  padding: 10px !important;
}
.fc-col-header-cell-cushion {
  color: white;
  font-weight: 500px;
  font-size: 20px;
}

.fc-prev-button,
.fc-next-button,
.fc-today-button {
  background-color: #886ab5 !important ;
}
.fc-icon {
  font-size: 16px !important;
}
.fc-theme-standard td,
.fc-theme-standard th {
  border: 1px solid #886ab5 !important;
}
</style>
