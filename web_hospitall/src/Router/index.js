import Admin_Router from './Router_admin'
import User_Router from './Router_user'

const routers =
    Admin_Router.concat(User_Router)
export default routers