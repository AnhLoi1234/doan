import app from '../components/user/App'
import Home from '../components/user/components/Content/_home/App_home'
import Login from '../components/user/Login'
import Register from '../components/user/Register'
import Doctors from '../components/user/Doctors';
import DoctorDetail from '../components/user/DoctorDetail';
import DoctorForm from '../components/user/DoctorForm';
import DoctorList from '../components/user/DoctorList';
import NotFound from '../components/NotFound';
import Blog from '../components/user/Blog';
import BlogDetail from '../components/user/BlogDetail';
import Profile from '../components/user/Profile';
const User_Router = [
    {
        path: '/', component: app,
        children: [
            { path: '/', component: Home, name: 'User_Home', exact: false },
            { path: '/login', component: Login, name: 'Login' },
            { path: '/register', component: Register, name: 'Register' },
            { path: '/doctors/:slug?', component: Doctors, name: 'Doctors' },
            { path: '/blogs', component: Doctors, name: 'Blogs' },
            { path: '/doctor-list/:slug?', component: DoctorList, name: 'DoctorList' },
            { path: '/doctor-detail/:slug?/:id?', component: DoctorDetail, name: 'DoctorDetail' },
            { path: '/doctor-form/:slug?', component: DoctorForm, name: 'DoctorForm' },
            { path: '/blogs/', component: Blog, name: 'Blogs' },
            { path: '/blogs/:slug?', component: BlogDetail, name: 'BlogDetail' },
            { path: '/profile/:id?', component: Profile, name: 'Profile' },
            { path: '/:pathMatch(.*)*', component: NotFound }
        ]
    }
]
export default User_Router