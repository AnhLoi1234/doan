import Adminlogin from './components/manage/Login'
import Manage from './components/manage/App_admin'
import app from './components/user/App'

const routers = [
    {
        path: '/',
        component:app,
        name:'app'
    },
    {
        path: '/admin',
        component:Adminlogin,
        name:'admin_login'
    },

    {
        path: '/manage',
        component:Manage,
        name:'manage'
    },
]
export default routers