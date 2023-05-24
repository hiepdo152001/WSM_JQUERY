const admin = [
    {
      path: "/",
      component: () => import("../layouts/homePage.vue"),
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
          path: "lich",
          name: "lich-lam-viec",
          component: () => import("../layouts/user/calendar.vue"),
        },
        {
          path: "request",
          name: "yeu-cau-cua-toi",
          component: () => import("../layouts/user/requestUser.vue"),
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
          path: "member/request",
          name: "member-request",
          component: () => import("../layouts/user/memberRequest.vue"),
          children: [
            {
              path: "?type=pending",
              name: "pending",
              component: () => import("../layouts/user/requestStatus1.vue"),
            },
            {
              path: "?type=confirmed",
              name: "confirmed",
              component: () => import("../layouts/user/requestStatus2.vue"),
            },
            {
              path: "?type=approved",
              name: "approved",
              component: () => import("../layouts/user/requestStatus3.vue"),
            },
            {
              path: "?type=declined",
              name: "declined",
              component: () => import("../layouts/user/requestStatus4.vue"),
            },
            {
              path: "?type=canceled",
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
    },
  ];
  
  export default admin;
  