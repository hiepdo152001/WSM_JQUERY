import axios from "axios";
import JwtService from "./jwtService";
import { API_URL } from "./config";
import { ref, onMounted } from "vue";

export const axiosClient = axios.create({
  baseURL: API_URL,
});

const AppService = {
  setHeader() {
    return (Headers = {
      Authorization: `Bearer ${JSON.parse(JwtService.getToken())}`,
    });
  },
  getTypeParameter() {
    const url = window.location.href;

    const params = new URLSearchParams(window.location.search);
    const type = params.get("type");
    return type;
  },
  get(resource, params) {
    return axiosClient.get(`${resource}`, params);
  },
  getParameter(resource, slug, params) {
    return axiosClient.get(`${resource}/${slug}`, params);
  },
  getNotWork(resource, year, month, header) {
    return axiosClient.get(`${resource}/${year}/${month}`, header);
  },
  post(resource, data) {
    return axiosClient.post(`${resource}`, data);
  },
  postAuth(resource, data, header) {
    return axiosClient.post(`${resource}`, data, header);
  },
  putAvatar(resource, data, header) {
    return axiosClient.put(`${resource}`, data, header);
  },
  put(resource, slug, params) {
    return axiosClient.put(`${resource}/${slug}`, params);
  },

  setDealine(contacts, assignee) {
    const timestamp = ref("");
    const deadline = ref("");
    const now = Date.now();

    contacts.value.forEach((element) => {
      timestamp.value = element.created_at;

      const oneDay = 24 * 60 * 60 * 1000;
      const threeDays = 3 * oneDay;

      const date = new Date(timestamp.value);
      const expiredAt = date.getTime() + threeDays;

      //so sanh time  with now
      if (expiredAt < now) {
        element.deadline = "het han";
        element.assignee = assignee;
      } else {
        const newDate = new Date(expiredAt);
        const year = newDate.getFullYear();
        const month = newDate.getMonth() + 1; // Vì tháng được đếm từ 0 đến 11, ta cộng thêm 1
        const day = newDate.getDate();
        const hours = newDate.getHours();
        deadline.value = hours + "h " + day + "-" + month + "-" + year;
        //set contacts
        element.assignee = assignee;
        element.deadline = deadline.value;
      }
    });
  },

  getTimeCheck(res, checks, color) {
    // TODO: checkIn

    // TODO: checkout
    color.check_in = "#1dc9b7";
    color.check_out = "#1dc9b7";

    // FIXME: loi nay
    const time_in = res.time_in;
    const date = new Date(time_in);

    const checkIn =
      String(date.getHours()).padStart(2, "0") +
      ":" +
      String(date.getMinutes()).padStart(2, "0");
    if (
      (date.getHours() >= 9 && date.getMinutes() >= 1) ||
      date.getHours() > 9
    ) {
      color.check_in = "#fd3995";
    }

    checks.check_in = checkIn;
    if (res.time_out !== null) {
      const time_out = res.time_out;
      const date_out = new Date(time_out);

      if (
        date_out.getHours() < 17 ||
        (date_out.getHours() <= 17 && date_out.getMinutes() <= 30)
      ) {
        color.check_out = "#fd3995";
      }

      const checkout =
        String(date_out.getHours()).padStart(2, "0") +
        ":" +
        String(date_out.getMinutes()).padStart(2, "0");
      checks.check_out = checkout;
    }
  },

  holiday() {
    const holiday = {
      "2023-01-01": "Tết Dương Lịch",
      "2023-01-02": "Nghỉ Tết Dương Lịch",
      "2023-01-21": "Tết Nguyên Đán",
      "2023-01-22": "Tết Nguyên Đán",
      "2023-01-23": "Tết Nguyên Đán",
      "2023-01-24": "Tết Nguyên Đán",
      "2023-01-25": "Tết Nguyên Đán",
      "2023-01-26": "Tết Nguyên Đán",
      "2023-01-27": "Tết Nguyên Đán",
      "2023-04-29": "Giỗ Tổ Hùng Vương",
      "2023-04-30": "Ngày Thống nhất đất nước",
      "2023-05-01": "Ngày Quốc tế Lao động",
      "2023-05-02": "Nghỉ Giỗ Tổ Hùng Vương",
      "2023-05-03": "Nghỉ Ngày Thống nhất",
      "2023-09-02": "Ngày Quốc khánh",
      "2023-09-04": "Nghỉ Ngày Quốc khánh",
    };
    return holiday;
  },

  now() {
    const currentDate = new Date();

    const month = (currentDate.getMonth() + 1).toString().padStart(2, "0");

    const year = currentDate.getFullYear();

    const day = currentDate.getDate().toString().padStart(2, "0");

    return year + "-" + month + "-" + day;
  },

  checkButton(timeKeep, showCheckOutButton, off, holiday, dataKeys) {
    if (timeKeep.data[timeKeep.data.length - 1].time_in !== null) {
      showCheckOutButton.value = false;
    }

    if (
      timeKeep.data[timeKeep.data.length - 1].time_in !== null &&
      timeKeep.data[timeKeep.data.length - 1].time_out !== null
    ) {
      off.value = true;
    }

    if (dataKeys.length === 0) {
      off.value = false;
      showCheckOutButton.value = true;
    }

    const today = new Date().getDay();
    const now = AppService.now();

    if (today === 6 || today === 7 || Object.keys(holiday).includes(now)) {
      off.value = true;
    }
  },
};

export default AppService;
