/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
 // handle GCM notifications for Android
var regId;
function onNotification(e) {
    regId = e.regid;
    switch (e.event) {
        case 'registered':
             if (e.regid.length > 0) {
                 // Your GCM push server needs to know the regID before it can push to this device
                 // here is where you might want to send it the regID for later use.
                 regid = e.regid;
                 $.ajax({
                     'url': 'http://mobile.unpar.ac.id/apps/frontend/index.php/v3/gadgets',
                     'method': 'POST',
                     'data': {code: regid, type: 'android'}
                 });
             }
            break;
         case 'message':
             // if this flag is set, this notification happened while we were in the foreground.
             // you might want to play a sound to get the user's attention, throw up a dialog, etc.
             console.log(e);
             window.location.href = e.payload.url;
             break;
         case 'error':
             console.log('Error: ' + e.msg);
             break;
         default:
             console.log('An unknown event was received');
             break;
    }
}

function onNotificationAPN(e){
    if(e.alert){
        //alert('push-notification: ' + e.alert );
        // showing an alert also requires the org.apache.cordova.dialogs plugin
        navigator.notification.alert(e.alert);
    }
    if(e.badge){
        pushNotification.setApplicationIconBadgeNumber(successHandler, e.badge);
    }
    if(e.sound){
        // playing a sound also requires the org.apache.cordova.media plugin
        var snd = new Media(e.sound);
        snd.play();
    }
    window.location.href = e.payload.url;
}

function tokenHandler(result) {
     //alert('token = ' + result);
     //console.log(result);
     // Your iOS push server needs to know the token before it can push to this device
     // here is where you might want to send it the token for later use.
     $.ajax({
         'url' :
         'http://wilianto.com/Unpar-Apps-Backend/frontend/web/index.php/v3/gadgets',
         'method' : 'POST',
         'data' : {code: result, type:'ios' }
     });
}

function successHandler(result) {
    console.log('Success: '+ result);
}

function errorHandler(error) {
    console.log('Error: '+ result);
}

var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');

        // JavaScript Document
        var pushNotification;

        function onDeviceReady() {

            pushNotification = window.plugins.pushNotification;
            //GCM
            if(device.platform == 'android' || device.platform == 'Android' || device.platform == 'amazon-fireos'){
                pushNotification.register(successHandler, errorHandler, {
                    "senderID" : "728106436407",
                    "ecb":"onNotification"
                }); //required!
            }
            //IOS
            else {
                //hide student portal in iOS
                document.getElementById('student-portal').style.display = 'none';
                pushNotification.register(tokenHandler, errorHandler, {
                    "badge":"true",
                    "sound":"true",
                    "alert":"true",
                    "ecb":"onNotificationAPN"
                }); //required!
            }
        }

        document.addEventListener('deviceready', onDeviceReady, true);
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        console.log('Received Event: ' + id);
    },
    takePhoto: function(){
        navigator.camera.getPicture(function(imgData){
            var arr = imgData.split(",");
            imgPath = arr[1];
            $("#img_base64").val(imgData);
        },function(err){
            alert(err);
        },{
            quality: 50,
            destinationType: Camera.DestinationType.DATA_URL,
            correctOrientation:true
        });
    }
};

function successOpen() {
  console.log('Success');
}

function errorOpen(code) {
  if (code === 1) {
    console.log('No file handler found');
  } else {
    console.log('Undefined error');
  }
}


app.initialize();
