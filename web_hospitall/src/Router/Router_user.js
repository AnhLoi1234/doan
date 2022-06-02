import app from '../components/user/App'
import Home from '../components/user/components/Content/_home/App_home'
import Login from '../components/user/Login'
import Register from '../components/user/Register'
import Doctors from '../components/user/Doctors';
import DoctorDetail from '../components/user/DoctorDetail';
import DoctorForm from '../components/user/DoctorForm';

const User_Router = [
    {
        path: '/', component: app,
        children: [
            { path: '/', component: Home, name: 'User_Home' },
            { path: '/login', component: Login, name: 'Login' },
            { path: '/register', component: Register, name: 'Register' },
            { path: '/doctors', component: Doctors, name: 'Doctors' },
            { path: '/doctor-detail', component: DoctorDetail, name: 'DoctorDetail' },
            { path: '/doctor-form', component: DoctorForm, name: 'DoctorForm' },
        ]
    }
]
export default User_Router