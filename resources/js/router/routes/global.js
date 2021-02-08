import Dashboard from '@/views/Dashboard';
import ProjectRooms from '@/views/ProjectRooms/index';
import ProjectRoomView from '@/views/ProjectRooms/ProjectRoomView';
import Optimization from '@/views/Booking/Optimization';
import Callback from '@/views/Callback';
import Mood from '@/views/Mood';
import Feedback from '@/views/Feedback';
import Login from '@/views/Auth/Login';
import Register from '@/views/Auth/Register';
import Graphs from '@/views/Mood/Graphs';

export const globalRoutes = [
    {
        path: '/',
        redirect: '/book',
        meta: {
            hidden: true,
        }
    },
    {
        path: '/optimize',
        component: Optimization,
        name: 'Optimization',
        meta: {
            inFooter: false,
            hidden: true,
            auth: true,
        },
    },
    {
        path: '/callback/:state',
        component: Callback,
        name: 'Hue reset',
        meta: {
            inFooter: false,
            hidden: true,
            auth: true,
        },
    },
    {
        path: '/book',
        component: ProjectRooms,
        name: 'Connect to a room',
        meta: {
            icon: 'mdi-domain',
            inFooter: true,
            auth: true,
        },
    },
    {
        path: '/projectrooms/:id',
        component: ProjectRoomView,
        name: 'ProjectRoomView',
        meta: {
            auth: true,
            inFooter: false,

        },
    },
    {
        path: '/mood/:id',
        component: Mood,
        name: 'Mood',
        meta: {
            icon: 'mdi-home',
            inFooter: false,
            auth: true,
        },
    },
    {
        path: '/login',
        component: Login,
        name: 'Login',
        meta: {
            auth: false,
            inFooter: true,
            icon: 'mdi-chart-bar',
        },
    },
    {
        path: '/register',
        component: Register,
        name: 'Register',
        meta: {
            auth: false,
            inFooter: true,
            icon: 'mdi-chart-bar',
        },
    },
    {
        path: '/graphs',
        component: Graphs,
        name: 'Mood graphs',
        meta: {
            icon: 'mdi-chart-bar',
            inFooter: false,
            auth: true,
        },
    },
];
