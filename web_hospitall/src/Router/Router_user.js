import app from '../components/user/App'
import Home from '../components/user/components/Content/_home/App_home'
import Login from '../components/user/Login'
import Register from '../components/user/Register'

const User_Router = [
    {
        path:'/',component:app,
        children:[
            {path:'/',component:Home,name:'User_Home'},
            {path:'/login',component:Login,name:'Login'},
            {path:'/register',component:Register,name:'Register'}
        ]
    }
]
export default User_Router