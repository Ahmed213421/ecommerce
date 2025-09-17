"use strict";var base={defaultFontFamily:"Overpass, sans-serif",primaryColor:"#1b68ff",secondaryColor:"#4f4f4f",successColor:"#3ad29f",warningColor:"#ffc107",infoColor:"#17a2b8",dangerColor:"#dc3545",darkColor:"#343a40",lightColor:"#f2f3f6"},extend={primaryColorLight:tinycolor(base.primaryColor).lighten(10).toString(),primaryColorLighter:tinycolor(base.primaryColor).lighten(30).toString(),primaryColorDark:tinycolor(base.primaryColor).darken(10).toString(),primaryColorDarker:tinycolor(base.primaryColor).darken(30).toString()},chartColors=[base.primaryColor,base.successColor,"#6f42c1",extend.primaryColorLighter],colors={bodyColor:"#6c757d",headingColor:"#495057",borderColor:"#e9ecef",backgroundColor:"#f8f9fa",mutedColor:"#adb5bd",chartTheme:"light"},darkColor={bodyColor:"#adb5bd",headingColor:"#e9ecef",borderColor:"#212529",backgroundColor:"#495057",mutedColor:"#adb5bd",chartTheme:"dark"},curentTheme=localStorage.getItem("mode"),dark=document.querySelector("#darkTheme"),light=document.querySelector("#lightTheme"),switcher=document.querySelector("#modeSwitcher");

function modeSwitch(){
    console.log("Theme switching...");
    var currentMode = localStorage.getItem("mode");

    // Immediately apply visual changes
    if (currentMode && currentMode == "dark") {
        // Switch to light mode
        localStorage.setItem("mode", "light");
        document.documentElement.classList.remove('dark');
        document.body.classList.remove('dark');
        if (dark) dark.disabled = true;
        if (light) light.disabled = false;
        colors = {bodyColor:"#6c757d",headingColor:"#495057",borderColor:"#e9ecef",backgroundColor:"#f8f9fa",mutedColor:"#adb5bd",chartTheme:"light"};
        if (switcher) switcher.dataset.mode = "light";
    } else {
        // Switch to dark mode
        localStorage.setItem("mode", "dark");
        document.documentElement.classList.add('dark');
        document.body.classList.add('dark');
        if (dark) dark.disabled = false;
        if (light) light.disabled = true;
        colors = darkColor;
        if (switcher) switcher.dataset.mode = "dark";
    }

    // Ensure content is visible after theme switch
    document.body.classList.add('theme-loaded');
}

console.log("Current theme:", curentTheme);

// Initialize theme on page load
if (curentTheme) {
    if (curentTheme == "dark") {
        if (dark) dark.disabled = false;
        if (light) light.disabled = true;
        colors = darkColor;
        document.documentElement.classList.add('dark');
        document.body.classList.add('dark');
    } else if (curentTheme == "light") {
        if (dark) dark.disabled = true;
        if (light) light.disabled = false;
        document.documentElement.classList.remove('dark');
        document.body.classList.remove('dark');
    }
    if (switcher) switcher.dataset.mode = curentTheme;
} else {
    // Default to light theme
    localStorage.setItem("mode", "light");
    document.documentElement.classList.remove('dark');
    document.body.classList.remove('dark');
}

// Ensure content is visible after theme initialization
document.body.classList.add('theme-loaded');
