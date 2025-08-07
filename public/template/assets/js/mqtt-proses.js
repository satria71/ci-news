// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var messagePayloadSuhu = 0;
var messagePayloadKelembapan = 0;


// var messagePayloadKelembapan = 0;
// Called after form input is processed
function startConnect() {
    // Generate a random client ID
    clientID = "Node MCU";

    // Fetch the hostname/IP address and port number from the form
    // host = "maqiatto.com";
    host = "d16ff6fe.us-east-1.emqx.cloud";
    // port = 8883;         //port maqiatto
    // port = 9001;         //port mosquitto local
    port = 8083;

    // Initialize new Paho client connection
    client = new Paho.MQTT.Client(host, Number(port), clientID);

    // Connect the client, if successful, call onConnect function
    client.connect({
        userName: "admin",
        password: "admin",
        onSuccess: onConnect,
    });

    // Set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;
}

// Called when the client connects
function onConnect() {
    // Fetch the MQTT topic from the form
    topicSuhu = "suhu";
    topicKelembapan = "kelembapan";

    // Print output for the user in the messages div
    // document.getElementById("pesansuhu").innerHTML += '<span>Subscribing to: ' + topic + '</span><br/>';

    // Subscribe to the requested topic
    client.subscribe(topicSuhu);
    client.subscribe(topicKelembapan);
}

// Called when the client loses its connection
function onConnectionLost(responseObject) {
    console.log("onConnectionLost: Connection Lost");
    if (responseObject.errorCode !== 0) {
        console.log("onConnectionLost: " + responseObject.errorMessage);
    }
}

// Called when a message arrives
// var suhu = "";
// var kelembapan = "";
function onMessageArrived(message) {
    // console.log("onMessageArrived: " + message.payloadString);
    // suhu = messagePayloadStatusSuhu;
    // kelembapan = messagePayloadKelembapan;
    if (message.destinationName == topicSuhu) {
        // suhu = message.payloadString;
        document.getElementById("suhu").innerHTML = '<span>' + message.payloadString + '&degC</span>';
        console.log("onMessageArrivedSuhu: " + message.payloadString);
        messagePayloadSuhu = parseFloat(message.payloadString);
    }
    if (message.destinationName == topicKelembapan) {
        // kelembapan = message.payloadString;
        document.getElementById("kelembapan").innerHTML = '<span>' + message.payloadString + '%</span>';
        console.log("onMessageArrivedKel: " + message.payloadString);
        messagePayloadKelembapan = parseFloat(message.payloadString);
    }
    updateScroll(); // Scroll to bottom of window
}

// function simpanData() {
//     var suhu = messagePayloadSuhu;
//     var kel = messagePayloadKelembapan;

//     window.location.href = "./proses/proses-simpan.php?suhu=" + suhu + "&kel=" + kel + "&fuzLam=" + fuzLam + "&fuzFan=" + fuzFan;
// }

// function simpanMacAddress() {
//     macAddress = messagePayloadDevice;
//     namaDevice = messagePayloadNamaDevice;
//     window.location.href = "./proses/proses-simpan-device.php?macAddress=" + macAddress + "&namaDevice=" + namaDevice;
// }

// Called when the disconnection button is pressed
function startDisconnect() {
    client.disconnect();
    // document.getElementById("suhu").innerHTML += '<span>Disconnected</span><br/>';
    document.getElementById("suhu").innerHTML += '<span>Disconnected</span><br/>';
    document.getElementById("kelembapan").innerHTML += '<span>Disconnected</span><br/>';
    updateScroll(); // Scroll to bottom of window
}

// Updates #messages div to auto-scroll
function updateScroll() {
    var element = document.getElementById("suhu");
    var element1 = document.getElementById("kelembapan");
    element.scrollTop = element.scrollHeight;
    // element1.scrollTop = element1.scrollHeight;
}

startConnect();

// Run fungsi simpandata
// var start = Date.now();
// setInterval(function () {
//     var delta = Date.now() - start; // milliseconds elapsed since start
//     simpanData();
//     output(Math.floor(delta / 1000)); // in seconds
//     // alternatively just show wall clock time:
//     output(new Date().toUTCString()); s
// }, 5000); // update about every second


// Area Chart Example
var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

// function randomScalingFactor() {
//     return (messagePayloadSuhu);
// }

//chart jadi satu
// function onRefresh(chart) {
//     chart.data.datasets[0].data.push({
//         x: Date.now(),
//         y: messagePayloadSuhu
//     })
//     chart.data.datasets[1].data.push({
//         x: Date.now(),
//         y: messagePayloadKelembapan
//     })
// }

//chart terpisah
function onRefreshSuhu(chart) {
    chart.config.data.datasets.forEach(function (dataset) {
        dataset.data.push({
            x: Date.now(),
            y: messagePayloadSuhu
        });
    });
}

function onRefreshKelembapan(chart) {
    chart.config.data.datasets.forEach(function (dataset) {
        dataset.data.push({
            x: Date.now(),
            y: messagePayloadKelembapan
        });
    });
}

var color = Chart.helpers.color;
var configSuhu = {
    type: 'line',
    data: {
        datasets: [{
            label: 'Suhu',
            backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            borderColor: chartColors.red,
            fill: false,
            lineTension: 0,
            borderDash: [8, 4],
            data: []
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Grafik Suhu'
        },
        scales: {
            xAxes: [{
                type: 'realtime',
                realtime: {
                    duration: 20000,
                    refresh: 2000,
                    delay: 3000,
                    onRefresh: onRefreshSuhu
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Nilai'
                }
            }]
        },
        tooltips: {
            mode: 'nearest',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: false
        }
    }
};

var configKelembapan = {
    type: 'line',
    data: {
        datasets: [{
            label: 'Kelembapan',
            backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
            borderColor: chartColors.blue,
            fill: false,
            lineTension: 0,
            borderDash: [8, 4],
            // cubicInterpolationMode: 'monotone',
            data: []
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Grafik Kelembapan'
        },
        scales: {
            xAxes: [{
                type: 'realtime',
                realtime: {
                    duration: 20000,
                    refresh: 2000,
                    delay: 3000,
                    onRefresh: onRefreshKelembapan
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Nilai'
                }
            }]
        },
        tooltips: {
            mode: 'nearest',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: false
        }
    }
};

window.onload = function () {
    var ctx1 = document.getElementById('ChartSuhu').getContext('2d');
    var ctx2 = document.getElementById('ChartKelembapan').getContext('2d');
    window.ChartSuhu = new Chart(ctx1, configSuhu);
    window.ChartKelembapan = new Chart(ctx2, configKelembapan);
};
