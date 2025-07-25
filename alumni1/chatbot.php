<link rel="stylesheet" href="./chatbot-style.css">

<div class="container">
    <div class="chatbox">
        <div class="chatbox__support">
            <div class="chatbox__header">
                <div class="chatbox__image--header">
                    <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-5--v1.png" alt="image">
                </div>
                <div class="chatbox__content--header">
                    <h4 class="chatbox__heading--header">Alumni chat support</h4>
                    <p class="chatbox__description--header">Hi. My name is AlmaBot. How can I help you?</p>
                </div>
            </div>
            <div class="chatbox__messages" id="chatbox-messages"></div>
            <div class="chatbox__footer">
                <input type="text" id="user-input" placeholder="Write a message...">
                <button class="chatbox__send--footer send__button" onclick="sendMessage()">Send</button>
            </div>
        </div>
        <div class="chatbox__button">
            <button><img src="./standalone-frontend/images/chatbox-icon.svg" /></button>
        </div>
    </div>
</div>


<script src="./chatbot.js"></script> 