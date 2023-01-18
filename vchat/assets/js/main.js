'use strict'

// Buttuns
let callBtn = $('#callBtn');

let pc;
let sendTo = callBtn.data('user');
let localStream;

// Video Elements
const localVideo = document.querySelector("#localVideo");
const remoteVideo = document.querySelector("#remoteVideo");

// Media Informatin
const mediaConst = {

    video: true,
    audio: false
}

// Negotiation - What to receive from other client

const options = {
    offerToReceiveVideo: 1,
    offerToReceiveAudio: 0
}

function getConn() {

    if (!pc) {

        pc = new RTCPeerConnection();

    }
    
}


// Request Media Input
async function getCam() {

    let mediaStream;

    try {

        if (!pc) {

            await getConn();

        }

        mediaStream = await navigator.mediaDevices.getUserMedia(mediaConst);

        localVideo.srcObject = mediaStream;
        localStream = mediaStream;
        localStream.getTracks().forEach(track => pc.addTrack(track, localStream));
        
    } catch (error) {

        console.log(error);

    }

}

$('#callBtn').on('click', () => {
    getCam();
})

conn.onopen = function(e) {
    
    console.log("Connected to Websocket!");

};

conn.onmessage = function(e) {
    
    // console.log(e.data);

};

function send(type, data, sendTo) {
    
    conn.send(JSON.stringify({
        sendTo: sendTo,
        type: type,
        data: data
    }));

}

// send("is-client-ready?", null, sendTo);