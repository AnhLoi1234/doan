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
    { path: '/admin/login', component: Adminlogin, name: 'admin_login', role: 'all' },
    { path: '/admin/manage', component: Manage, name: 'manage', role: 'all' },
    { path: '/admin/users', component: User, name: 'users', role: 0 },
    { path: '/admin/doctors', component: Doctors, name: 'doctors', role: 0 },
    { path: '/admin/specicallists', component: SpecicalList, name: 'specicallists', role: 0 },
    { path: '/admin/blogs', component: Blog, name: 'blogs', role: 'all' },
    { path: '/admin/timebooks', component: TimeBook, name: 'timebooks', role: 0 },
    { path: '/admin/booklists', component: BookList, name: 'booklists', role: 1 },
    { path: '/admin/chats', component: Chat, name: 'chats', role: 1 },
]
export default (Admin_Router)