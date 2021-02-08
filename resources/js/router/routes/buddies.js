import BuddyOverview from '@/views/Buddies/BuddyOverview';
import Detail from '@/views/Buddies/Detail';
import Buddies from '@/views/Buddies';
import Confirmed from '@/views/Buddies/Confirmed';
import Settings from '../../views/Settings/index';

export const buddyRoutes = [
    {
        path: '/buddies',
        component: Buddies,
        name: 'Buddies',
        children: [
            {
                path: '/',
                name: 'Buddies',
                component: BuddyOverview
            },
            {
                path: '/buddies/detail/:id/:name',
                name: 'Buddy Detail',
                component: Detail
            },
            {
                path: '/buddies/:id/confirmed',
                name: 'Buddy Confirmed',
                component: Confirmed,
            },
        ],
        meta: {
            icon: 'mdi-account-multiple',
            inFooter: true,
            notify: true,
            auth: true,
        },
    },
    {
        path: '/settings',
        component: Settings,
        name: 'Settings',
        meta: {
            icon: 'mdi-cogs',
            inFooter: true,
            auth: true,
        },
    },
];
export default buddyRoutes;
