import Vue from 'vue';
import VueRouter from 'vue-router';


const LoginComponent = () => import('../components/Auth/Login');
const LogoutComponent = () => import('../components/Auth/Logout');
const MainScreen = () => import('../views/MainScreen');
const MainScreenList = () => import('../components/MainScreen/MainScreenList');
const MainScreenRefillBalance = () => import('../components/MainScreen/MainScreenRefillBalance');

Vue.use(VueRouter)

const routes = [
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/logout',
        name: 'logout',
        component: LogoutComponent
    },
    {
        path: '/',
        component: MainScreen,
        children: [
            {
                path: '',
                component: MainScreenList,
                name: 'list',

            },
            {
                path: 'refill',
                component: MainScreenRefillBalance,
                name: 'RefillBalance',
            },
        ]
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})


router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/login'];
    const authPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = !!localStorage.getItem('_jwt_token');
    // const loggedIn = store.getters['auth/IS_AUTH'];

    if (authRequired && !loggedIn) {
        return next('/login');
    }
    if(authPages.includes(to.path) && loggedIn){
        return next('/');
    }
    next();
})

export default router
