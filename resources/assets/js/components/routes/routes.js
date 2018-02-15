import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Defining all components for routings
import AppHome from '../AppHome';
import AppQuestions from '../forum/Questions';
import AppLogin from '../login/Login';
import AppSignUp from '../login/SignUp';
import Ask from '../forum/Create';
import Read from '../forum/Read';

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.

const routes = [
  { path: '/forum', component: AppQuestions, name: 'forum', },
  { path: '/login', component: AppLogin },
  { path: '/signUp', component: AppSignUp },
  { path: '/ask', component: Ask },
  { path: '/read/:category/:slug', component: Read }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history',
  hashbang: false,
})
router.mode = 'html5'

export default router;

// // 4. Create and mount the root instance.
// // Make sure to inject the router with the router option to make the
// // whole app router-aware.
// const app = new Vue({
//   router
// }).$mount('#app')
