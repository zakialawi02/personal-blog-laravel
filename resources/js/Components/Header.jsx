import React from "react";
import { Link } from "@inertiajs/react";

export default function Header() {
    return (
        <div className="flex flex-row items-center justify-between p-4 bg-green-400">
            <div className="text-xl font-bold">Title Here</div>
            <div className="gap-4 space-x-4 ">
                <Link
                    rel="stylesheet"
                    className="text-slate-100 hover:text-primary"
                    href="/inertia"
                >
                    Home
                </Link>
                <Link
                    rel="stylesheet"
                    className="text-slate-100 hover:text-primary"
                    href="/inertia/about"
                >
                    About
                </Link>
                <Link
                    rel="stylesheet"
                    className="text-slate-100 hover:text-primary"
                    href="/inertia/services"
                >
                    Services
                </Link>
            </div>
        </div>
    );
}
