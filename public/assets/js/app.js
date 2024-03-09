const userInput = document.getElementById("user-input");
const sendButton = document.getElementById("send-button");

const sendChatMessage = async () => {
  const userMessage = userInput.value;
  appendUserMessage(userMessage);

  try {
    const response = await axios.post(
      "/send-chat-message",
      { message: userMessage }
    );

    const botResponse = response.data.botResponse;
    appendBotMessage(botResponse);
    userInput.value = "";
   scrollToBottom();
  } catch (error) {
    console.error("Errore:", error);
  }

  userInput.value = "";
};

const appendUserMessage = (message) => {
  const chatBoard = document.querySelector(".chat__conversation-board");
  const messageContainer = document.createElement("div");
  messageContainer.classList.add("chat__conversation-board__message-container", "reversed");

  const personDiv = document.createElement("div");
  personDiv.classList.add("chat__conversation-board__message__person");

  const avatarDiv = document.createElement("div");
  avatarDiv.classList.add("chat__conversation-board__message__person__avatar");
  const avatarImg = document.createElement("img");
  avatarImg.src = "https://randomuser.me/api/portraits/men/9.jpg";
  avatarImg.alt = "Dennis Mikle";
  avatarDiv.appendChild(avatarImg);

  const nicknameSpan = document.createElement("span");
  nicknameSpan.classList.add("chat__conversation-board__message__person__nickname");
  nicknameSpan.innerText = "Tu";
  personDiv.appendChild(avatarDiv);
  personDiv.appendChild(nicknameSpan);

  const contextDiv = document.createElement("div");
  contextDiv.classList.add("chat__conversation-board__message__context");
  const bubbleDiv = document.createElement("div");
  bubbleDiv.classList.add("chat__conversation-board__message__bubble");
  const textSpan = document.createElement("span");
  textSpan.innerText = message;
  bubbleDiv.appendChild(textSpan);
  contextDiv.appendChild(bubbleDiv);

  messageContainer.appendChild(personDiv);
  messageContainer.appendChild(contextDiv);

  chatBoard.appendChild(messageContainer);
};

const appendBotMessage = (message) => {
  const chatBoard = document.querySelector(".chat__conversation-board");
  const messageContainer = document.createElement("div");
  messageContainer.classList.add("chat__conversation-board__message-container");

  const personDiv = document.createElement("div");
  personDiv.classList.add("chat__conversation-board__message__person");

  const avatarDiv = document.createElement("div");
  avatarDiv.classList.add("chat__conversation-board__message__person__avatar");
  const avatarImg = document.createElement("img");
  avatarImg.src = "https://futureoflife.org/wp-content/uploads/2015/11/artificial_intelligence_benefits_risk.jpg";
  avatarImg.alt = "Monika Figi";
  avatarDiv.appendChild(avatarImg);

  const nicknameSpan = document.createElement("span");
  nicknameSpan.classList.add("chat__conversation-board__message__person__nickname");
  nicknameSpan.innerText = "Levap";
  personDiv.appendChild(avatarDiv);
  personDiv.appendChild(nicknameSpan);

  const contextDiv = document.createElement("div");
  contextDiv.classList.add("chat__conversation-board__message__context");
  const bubbleDiv = document.createElement("div");
  bubbleDiv.classList.add("chat__conversation-board__message__bubble");
  const textSpan = document.createElement("span");
  textSpan.innerText = message;
  bubbleDiv.appendChild(textSpan);
  contextDiv.appendChild(bubbleDiv);

  messageContainer.appendChild(personDiv);
  messageContainer.appendChild(contextDiv);

  chatBoard.appendChild(messageContainer);
};

const sendMessage = () => {
  sendChatMessage();
};



sendButton.addEventListener("click", sendMessage);

userInput.addEventListener("keyup", (event) => {
  if (event.key === "Enter") {
    sendChatMessage();
  }
});

const scrollToBottom = () => {
  const chatPanel = document.querySelector(".chat__conversation-board");
  chatPanel.scrollTop = chatPanel.scrollHeight;
};
