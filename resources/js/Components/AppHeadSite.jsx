import React from "react";
import { Head } from "@inertiajs/react";

export default function AppHeadSite({ title, metaHead, children }) {
    return (
        <Head>
            <title>{title ? `${title}` : "Personal Web"}</title>
            <meta
                name="description"
                content={metaHead?.meta_description ?? ""}
            />
            <meta name="keywords" content={metaHead?.meta_keywords ?? ""} />
            <link rel="icon" href="/assets/img/favicon.png" type="image/png" />
            <meta
                name="author"
                content={metaHead?.meta_author ?? "zakialawi"}
            />
            <meta
                name="robots"
                content={metaHead?.meta_robots ?? "index, follow"}
            />
            {children}
        </Head>
    );
}
