// const Home = () => import('../layouts/Home.vue' /* webpackChunkName: "resource/js/components/welcome" */)
//  const userList = () => import('../layouts/user/user.vue' /* webpackChunkName: "resource/js/components/category/list" */)
// const CategoryCreate = () => import('../layouts/user/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
// const CategoryEdit = () => import('../layouts/user/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)

 const admin = [
    {
                path: "/",
                component: () => import("../layouts/Home.vue"),
                children: [
                    
                    {
                        path: "login",
                        name: "login-auth",
                        component: () => import ("../layouts/auth/login.vue")
                    },
                    {
                        path: "register",
                        name: "register-auth",
                        component: () => import ("../layouts/auth/register.vue")
                    },
                    {
                        path: "change-password",
                        name: "change-password-auth",
                        component: () => import ("../layouts/auth/passWord.vue")
                    }
                    ,{
                    path: "home",
                    component: () => import("../layouts/homeWeb.vue"),
                    children: [
                        {
                            path: "lich",
                            name: "lich-lam-viec",
                            component: () => import ("../layouts/user/lich.vue")
                        },
                        {
                            path: "admin",
                            name: "bang-dieu-khien",
                            component: () => import ("../layouts/admin/admin.vue")
                        },
                        {
                            path: "request",
                            name: "yeu-cau-cua-toi",
                            component: () => import ("../layouts/user/requestUser.vue")
                        },
            
                        {
                            path: "member/request",
                            name: "member-request",
                            component: () => import ("../layouts/user/memberRequest.vue")
                        }
                    ]
                    }
                ]

             },
        
        ]
        export default admin;
