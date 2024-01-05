declare namespace App {
    export type currentRoute = keyof import('momentum-trail/dist/types/router').RouterGlobal['routes'] | keyof import('momentum-trail/dist/types/router').RouterGlobal['wildcards'];
    export type routeMethod = typeof import('@inertiajs/core').Method;

    export type Quote = {
        id: number;
        quote: string;
        created_at: string;
    };

    export type SharedData = {
        token: string | null;
    };
}
