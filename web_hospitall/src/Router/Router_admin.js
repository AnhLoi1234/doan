import Adminlogin from '../components/manage/Login'
import Manage from '../components/manage/App_admin'

const Admin_Router = [
    {path:'/admin',component:Adminlogin,name:'admin_login'},
    {path:'/manage',component:Manage,name:'manage'}
]
export default Admin_Router