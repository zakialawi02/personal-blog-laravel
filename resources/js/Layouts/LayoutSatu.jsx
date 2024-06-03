import React from "react";
import { usePage } from "@inertiajs/react";
import Header from "@/Components/Header";

export default function LayoutSatu({ children }) {
    const { url, component } = usePage();

    console.log(url);

    return (
        <>
            <Header></Header>

            <main>{children}</main>
        </>
    );
}
