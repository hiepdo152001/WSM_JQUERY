const admin = [
  {
    path: "/",
    component: () => import("../layouts/homePage.vue"),
    meta: {
      requiresAuth: false,
    },
    children: [
      {
        path: "login",
        name: "login-auth",
        component: () => import("../layouts/homePage.vue"),
      },
      {
        path: "register",
        name: "register-auth",
        component: () => import("../layouts/homePage.vue"),
      },
    ],
  },
  {
    path: "/home",
    component: () => import("../layouts/homeWeb.vue"),
    children: [
      {
        path: "calendar",
        name: "lich-lam-viec",
        component: () => import("../layouts/user/calendar.vue"),
      },
      {
        path: "request",
        name: "yeu-cau-cua-toi",
        component: () => import("../layouts/user/requestUser.vue"),
      },
      {
        path: "request/:id",
        name: "view-request",
        component: () => import("../layouts/user/viewRequest.vue"),
      },

      {
        path: "request/new",
        name: "new-request",
        component: () => import("../layouts/user/createRequest.vue"),
      },
      {
        path: "change-password",
        name: "change-password-auth",
        component: () => import("../layouts/auth/passWord.vue"),
      },
      {
        path: "member/request/",
        name: "member-request",
        component: () => import("../layouts/user/memberRequest.vue"),
        children: [
          {
            path: "",
            name: "pending",
            component: () => import("../layouts/user/requestStatus1.vue"),
          },
          {
            path: "",
            name: "confirmed",
            component: () => import("../layouts/user/requestStatus2.vue"),
          },
          {
            path: "",
            name: "approved",
            component: () => import("../layouts/user/requestStatus3.vue"),
          },
          {
            path: "",
            name: "declined",
            component: () => import("../layouts/user/requestStatus4.vue"),
          },
          {
            path: "",
            name: "canceled",
            component: () => import("../layouts/user/requestStatus5.vue"),
          },
        ],
      },
      {
        path: "user",
        name: "user",
        component: () => import("../layouts/user/user.vue"),
      },
      {
        path: "edit/profile",
        name: "edit-profile",
        component: () => import("../layouts/user/editprofile.vue"),
      },
    ],
    meta: {
      requiresAuth: true,
    },
  },
];

export default admin;
