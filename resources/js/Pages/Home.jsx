import React from "react";
import LayoutSatu from "../Layouts/LayoutSatu";
import AppHeadSite from "@/Components/AppHeadSite";

const metaHead = {
    meta_description: "Description",
    meta_keywords: "Keywords",
};

export default function Home({ auth, user, flash }) {
    console.log(auth);
    console.log(flash);
    return (
        <LayoutSatu>
            <AppHeadSite title="Home" metaHead={metaHead}></AppHeadSite>

            <div className="container bg-red-600 min-h-40">
                <h1>Home</h1>
                <h3>Hallo {user ?? "Anonym"}</h3>
            </div>
        </LayoutSatu>
    );
}
