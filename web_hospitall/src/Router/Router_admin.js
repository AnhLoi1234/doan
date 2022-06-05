import Adminlogin from '../components/manage/Login'
import Manage from '../components/manage/App_admin'
import Doctors from '../components/manage/pages/Doctors';
import User from '../components/manage/pages/User';
import SpecicalList from '../components/manage/pages/SpecicalList';
import TimeBook from '../components/manage/pages/TimeBook';
import Blog from '../components/manage/pages/Blog';
import BookList from '../components/manage/pages/BookList';
import Chat from '../components/manage/pages/Chat';

const Admin_Router = [
    { path: '/admin/login', component: Adminlogin, name: 'admin_login' },
    { path: '/admin/manage', component: Manage, name: 'manage' },
    { path: '/admin/users', component: User, name: 'users' },
    { path: '/admin/doctors', component: Doctors, name: 'doctors' },
    { path: '/admin/specicallists', component: SpecicalList, name: 'specicallists' },
    { path: '/admin/blogs', component: Blog, name: 'blogs' },
    { path: '/admin/timebooks', component: TimeBook, name: 'timebooks' },
    { path: '/admin/booklists', component: BookList, name: 'booklists' },
    { path: '/admin/chats', component: Chat, name: 'chats' },
]
export default (Admin_Router)