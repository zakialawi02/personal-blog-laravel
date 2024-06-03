import React from "react";
import LayoutSatu from "../Layouts/LayoutSatu";
import AppHeadSite from "@/Components/AppHeadSite";

export default function About() {
    return (
        <LayoutSatu>
            <AppHeadSite title="About"></AppHeadSite>

            <div className="container">
                <h1>About</h1>
            </div>
        </LayoutSatu>
    );
}
