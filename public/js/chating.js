

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.chatBody').hide();

    var userInfo = document.getElementById('user-info');
    var userName = userInfo.getAttribute('data-name');
    var userProfile = userInfo.getAttribute('data-profile');

    var usersUrl = window.usersUrl;
    var fetchedUrl = window.fetchedUrl;
    var submitUrl = window.submitUrl;

    console.log('Custom Js URL"s', usersUrl, fetchedUrl, submitUrl);
    var receiverId;
    $(document).on('click', '#userClck', function (e) {
        e.preventDefault();
        var userId = $(this).data('id');
        console.log('Clicked user id', userId);
        $('.chatBody').show();
        $('.userClck').removeClass('active');
        $(this).addClass('active');
        receiverId = userId;
        $('#recieverid').val(userId);
        $.ajax({
            url: usersUrl,
            method: "POST",
            data: {
                user_id: userId
            },
            dataType: "json",
            success: function (data) {
                $('#user-profile-image').attr('src', data.profile_image);
                $('#user-profile-name').text(data.name);
                $('#user-status').text(data.status);
            }
        });
        fetchMessages(userId);
    });

    // fetch messages
    function fetchMessages(userId) {
        $.ajax({
            url: fetchedUrl,
            method: "POST",
            data: {
                user_id: userId
            },
            dataType: "json",
            success: function (messages) {
                var messageContainer = $('.msg_card_body');
                messageContainer.empty();

                messages.messages.forEach(function (message) {
                    var isCurrentUser = message.sender_id === authId;
                    var userProfile = message.sender_id == messages.users[0].id ? messages.users[0].profile_url : messages.users[1].profile_url;
                    var userName = message.sender_id == messages.users[0].id ? messages.users[0].name : messages.users[1].name;
                    console.log('User chats', message);
                    var messageHtml = '';
                    if (isCurrentUser) {
                        // Current user's message
                        messageHtml = '<div class="d-flex justify-content-end sndrMsg mb-4">' +
                            '<div class="msg_cotainer_send">' + message.message +
                            '<span class="msg_time_send">' + formatMessageTime(message.created_at) + '</span>' +
                            '</div>' +
                            '<div class="img_cont_msg sndrMsg-img">' +
                            '<img src="' + userProfile + '" class="rounded-circle user_img_msg">' +
                            '</div>' +
                            '</div>';
                    } else {
                        // Other user's message
                        messageHtml = '<div class="d-flex justify-content-start rcvMsg mb-4">' +
                            '<div class="img_cont_msg rcvMsg-img">' +
                            '<img src="' + userProfile + '" class="rounded-circle user_img_msg">' +
                            '</div>' +
                            '<div class="msg_cotainer">' + message.message +
                            '<span class="msg_time">' + formatMessageTime(message.created_at) + '</span>' +
                            '</div>' +
                            '</div>';
                    }
                    messageContainer.append(messageHtml);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching messages: " + error);
            }
        });
    }

    $(document).on('click', '#sendMessageButton', function (e) {
        e.preventDefault();
        var message = $('#messageInput').val();
        console.log(message);
        sendMessage(message);
        if (message == '') {
            alert('Please enter message')
            return false;
        }
        function sendMessage(message) {
            $.ajax({
                url: submitUrl,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    sender_id: authId,
                    receiver_id: receiverId,
                    message: message
                },
                success: function (response) {
                    if (response.success) {
                        console.log(response.data);
                        $('#messageInput').val('');
                        // var sentMessageHtml = `<div class="message-user-right">`;
                        // sentMessageHtml += `<div class="message-user-right-img">`;
                        // sentMessageHtml += `<p class="mt-0 mb-0"><strong>${userName}</strong></p>`;
                        // sentMessageHtml += `<img src="${userProfile}" alt="">`;
                        // sentMessageHtml += `</div>`;
                        // sentMessageHtml += `<div class="message-user-right-text">`;
                        // sentMessageHtml += `<strong>${message}</strong>`;
                        // sentMessageHtml += `</div>`;
                        // sentMessageHtml += `</div>`;
                        // $('.body-chat-message-user').append(sentMessageHtml);
                        // var container = $('.body-chat-message-user');
                        // container.scrollTop(container.prop("scrollHeight"));
                    } else {
                        console.log(response.error);
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
    // send audio file
    var recordButton = document.getElementById('recordButton');
    var fileInput = document.getElementById('fileInput');
    let isRecording = false;
    let audioChunks = [];
    let mediaRecorder;
    // Event listener for the record button
    recordButton.addEventListener('click', () => {
        if (!isRecording) {
            console.log('Recording start');
            startRecording();
            recordButton.innerHTML = '<i class="fa-solid fa-stop"></i>';
        } else {
            console.log('Recording stop');
            stopRecording();
            recordButton.innerHTML = '<i class="fa-solid fa-microphone"></i>';
        }
    });
    // Function to format timestamp to "8:55 AM, Today" format
    function formatMessageTime(timestamp) {
        const date = new Date(timestamp);
        // Get hours and minutes
        let hours = date.getHours();
        let minutes = date.getMinutes();
        // Convert hours to 12-hour format
        const amOrPm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert 0 to 12
        // Add leading zero to minutes if needed
        minutes = minutes < 10 ? '0' + minutes : minutes;
        // Check if the date is today
        const today = new Date();
        const isToday = date.getDate() === today.getDate() &&
            date.getMonth() === today.getMonth() &&
            date.getFullYear() === today.getFullYear();
        // Construct the time string
        const timeString = `${hours}:${minutes} ${amOrPm}`;
        const dateString = isToday ? 'Today' : date.toLocaleDateString('en-US', { weekday: 'long' });

        return `${timeString}, ${dateString}`;
    }

    // Usage example
    const timestamp = '2024-05-04T08:55:00'; // Example timestamp
    const formattedTime = formatMessageTime(timestamp);
    console.log('Formated time form msg', formattedTime); // Output example: "8:55 AM, Today"
    // Event listener for file input
    fileInput.addEventListener('change', function (event) {
        const selectedFiles = event.target.files;
        if (selectedFiles.length > 0) {
            saveToLaravel(selectedFiles, authId, receiverId);
        }
    });
    // Function to start recording or upload files
    function startRecording() {
        // Check if there are files selected
        const selectedFiles = fileInput.files;
        if (selectedFiles.length > 0) {
            // Files from the file input
            saveToLaravel(selectedFiles, authId, receiverId);
        } else {
            // No files selected, proceed with audio recording
            isRecording = true;
            audioChunks = [];
            navigator.mediaDevices.getUserMedia({
                audio: true
            })
                .then((stream) => {
                    mediaRecorder = new MediaRecorder(stream);
                    // Event listener for data available
                    mediaRecorder.ondataavailable = (event) => {
                        if (event.data.size > 0) {
                            audioChunks.push(event.data);
                        }
                    };
                    // Event listener for stopping recording
                    mediaRecorder.onstop = () => {
                        isRecording = false;
                        const audioBlob = new Blob(audioChunks, {
                            type: 'audio/wav'
                        });
                        // Send the audio data to Laravel backend
                        saveToLaravel(audioBlob, authId, receiverId);
                    };
                    // Start recording
                    mediaRecorder.start();
                })
                .catch((error) => console.error('Error accessing microphone:', error));
        }
    }
    // Function to stop recording
    function stopRecording() {
        if (mediaRecorder) {
            mediaRecorder.stop();
        }
    }
    // Function to send audio data or files to Laravel backend
    function saveToLaravel(data, authId, receiverId) {
        const formData = new FormData();
        if (data instanceof Blob) {
            // Audio data
            formData.append('audio', data);
            formData.append('sender_id', authId);
            formData.append('receiver_id', receiverId);
            axios.post('/send-message', formData)
                .then((response) => console.log('Audio saved successfully:', response.data))
                .catch((error) => console.error('Error saving audio:', error));
        } else if (data instanceof FileList && data.length > 0) {
            // Files from the file input
            for (let i = 0; i < data.length; i++) {
                const file = data[i];
                formData.append('sender_id', authId);
                formData.append('receiver_id', receiverId);
                formData.append('files[]', file);
            }
            axios.post('/send-message', formData)
                .then((response) => console.log('Files saved successfully:', response.data))
                .catch((error) => console.error('Error saving files:', error));
        }
    }

});

window.Echo.channel('PersonalChat').listen('.chating', (data) => {
    console.log('Data received from channel:', data);
    const messageData = data.message || {};
    const users = data.users || [];

});