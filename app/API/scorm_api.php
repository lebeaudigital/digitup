<?php
header("Content-Type: application/javascript");
?>

var SCORM_API = {
    version: "1.2",
    
    LMSInitialize: function () {
        console.log("SCORM 1.2: LMSInitialize called");
        return "true";
    },
    Initialize: function () {
        console.log("SCORM 2004: Initialize called");
        return this.LMSInitialize();
    },

    LMSFinish: function () {
        console.log("SCORM 1.2: LMSFinish called");
        return "true";
    },
    Terminate: function () {
        console.log("SCORM 2004: Terminate called");
        return this.LMSFinish();
    },

    LMSGetValue: function (key) {
        console.log("SCORM 1.2: LMSGetValue called for " + key);
        return localStorage.getItem(key) || "";
    },
    GetValue: function (key) {
        console.log("SCORM 2004: GetValue called for " + key);
        return this.LMSGetValue(key);
    },

    LMSSetValue: function (key, value) {
        console.log("SCORM 1.2: LMSSetValue called for " + key + " with value: " + value);
        localStorage.setItem(key, value);
        return "true";
    },
    SetValue: function (key, value) {
        console.log("SCORM 2004: SetValue called for " + key + " with value: " + value);
        return this.LMSSetValue(key, value);
    },

    LMSCommit: function () {
        console.log("SCORM 1.2: LMSCommit called");
        return "true";
    },
    Commit: function () {
        console.log("SCORM 2004: Commit called");
        return this.LMSCommit();
    },

    LMSGetLastError: function () {
        return "0";
    },
    GetLastError: function () {
        return this.LMSGetLastError();
    },

    LMSGetErrorString: function (errorCode) {
        return "No error";
    },
    GetErrorString: function (errorCode) {
        return this.LMSGetErrorString(errorCode);
    },

    LMSGetDiagnostic: function (errorCode) {
        return "No diagnostic available";
    },
    GetDiagnostic: function (errorCode) {
        return this.LMSGetDiagnostic(errorCode);
    }
};

// Injecter l'API SCORM compatible 1.2 et 2004
window.API = SCORM_API; // SCORM 1.2
window.API_1484_11 = SCORM_API; // SCORM 2004
console.log("✅ SCORM API (1.2 & 2004) Injected");