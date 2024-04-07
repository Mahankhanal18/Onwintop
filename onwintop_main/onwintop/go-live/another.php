<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Videosdk.live RTC</title>
</head>

<body>
    <script>
        var script = document.createElement("script");
        script.type = "text/javascript";
        //
        script.addEventListener("load", function(event) {
            // Initialize the factory function
            const meeting = new VideoSDKMeeting();

            // Set apikey, meetingId and participant name
            const apiKey = "b4ce16ea-5354-4ffa-8700-08918258e6b4"; // generated from app.videosdk.live
            const meetingId = "cl8s-c002-7v21";
            const name = "";

            const config = {
                name: name,
                apiKey: apiKey,
                meetingId: meetingId,

                region: "sg001", // region for new meeting

                containerId: null,
                redirectOnLeave: "https://www.rebootmarketing.in",

                micEnabled: true,
                webcamEnabled: true,
                participantCanToggleSelfWebcam: true,
                participantCanToggleSelfMic: true,
                participantCanLeave: true, // if false, leave button won't be visible

                chatEnabled: true,
                screenShareEnabled: true,
                pollEnabled: true,
                whiteboardEnabled: true,
                raiseHandEnabled: true,

                recording: {
                    autoStart: false, // auto start recording on participant joined
                    enabled: false,
                    webhookUrl: "https://www.rebootmarketing.in",
                    //awsDirPath: `/meeting-recordings/${meetingId}/`, // automatically save recording in this s3 path
                },

                livestream: {
                    autoStart: true,
                    enabled: true,
                    url: "rtmps://a.rtmps.youtube.com/live2",
                    streamKey: "6u54-vs5z-bb38-2fkv-4mm5",
                },

                layout: {
                    type: "SPOTLIGHT", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
                    priority: "PIN", // "SPEAKER" | "PIN",
                    // gridSize: 3,
                },

                branding: {
                    enabled: true,
                    logoURL: "https://rebootmarketing.in/img/logo_white.png",
                    name: "",
                    poweredBy: false,
                },

                permissions: {
                    pin: true,
                    askToJoin: false, // Ask joined participants for entry in meeting
                    toggleParticipantMic: true, // Can toggle other participant's mic
                    toggleParticipantWebcam: true, // Can toggle other participant's webcam
                    drawOnWhiteboard: true, // Can draw on whiteboard
                    toggleWhiteboard: true, // Can toggle whiteboard
                    toggleRecording: true, // Can toggle meeting recording
                    toggleLivestream: true, //can toggle live stream
                    removeParticipant: true, // Can remove participant
                    endMeeting: true, // Can end meeting
                    changeLayout: true, //can change layout
                },

                joinScreen: {
                    visible: true, // Show the join screen ?
                    title: "Meeting", // Meeting title
                    meetingUrl: window.location.href, // Meeting joining url
                },

                leftScreen: {
                    // visible when redirect on leave not provieded
                    actionButton: {
                        // optional action button
                        label: "Reboot Marketing Pvt Ltd", // action button label
                        href: "https://www.rebootmarketing.in", // action button href
                    },
                },
                notificationSoundEnabled: true,
                debug: true, // pop up error during invalid config or netwrok error
                maxResolution: "sd", // "hd" or "sd"
            };
            meeting.init(config);

        });

        script.src =
            "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.7/rtc-js-prebuilt.js";
        document.getElementsByTagName("head")[0].appendChild(script);
    </script>
</body>

</html>